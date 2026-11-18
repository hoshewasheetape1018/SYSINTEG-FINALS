<?php

namespace App\Libraries;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\UsersModel;
use Config\Jotform;
use Config\Services;
use RuntimeException;
use Throwable;

class JotformService
{
    private const BLUMIES_FORM_ID = '263211686457058';

    /**
     * The product list and file-upload controls are deliberately not included:
     * Jotform's submission API cannot populate Product List values or upload a
     * local file. Product details are copied into question 21 instead, while
     * the receipt remains protected in the local admin area.
     */
    private const BLUMIES_FIELD_MAP = [
        'customer_name' => '3',
        'email' => '4',
        'phone' => '5',
        'street_address' => '6',
        'city' => '7',
        'region' => '8',
        'postal_code' => '9',
        'payment_reference' => '15',
        'comments' => '21',
        'delivery_method' => '28',
    ];

    private Jotform $config;
    private $http;

    public function __construct(?Jotform $config = null, $http = null)
    {
        $this->config = $config ?? config('Jotform');
        $this->http = $http ?? Services::curlrequest(['timeout' => 12, 'connect_timeout' => 5]);
    }

    public function isConfigured(): bool
    {
        return $this->config->apiKey !== '' && $this->config->formId !== '';
    }

    /**
     * Synchronize an order once. A previously synchronized order is returned
     * without creating a duplicate Jotform submission.
     *
     * @return array{status:string,submission_id:?string}
     */
    public function syncOrderById(int $orderId): array
    {
        $orders = new OrderModel();
        $order = $orders->find($orderId);
        if (!$order) {
            throw new RuntimeException('Order not found.');
        }

        if ($order['jotform_status'] === 'synced' && !empty($order['jotform_submission_id'])) {
            return ['status' => 'synced', 'submission_id' => $order['jotform_submission_id']];
        }

        if (!$this->isConfigured()) {
            $orders->update($orderId, [
                'jotform_status' => 'not_configured',
                'jotform_error' => 'Jotform API key or form ID is not configured.',
            ]);
            return ['status' => 'not_configured', 'submission_id' => null];
        }

        $userEntity = (new UsersModel())->find((int) $order['user_id']);
        if (!$userEntity) {
            throw new RuntimeException('Order customer not found.');
        }

        $user = is_array($userEntity) ? $userEntity : $userEntity->toArray();
        $items = (new OrderItemModel())->where('order_id', $orderId)->findAll();

        try {
            $submissionId = $this->submit($order, $user, $items);
            $orders->update($orderId, [
                'jotform_status' => 'synced',
                'jotform_submission_id' => $submissionId,
                'jotform_error' => null,
                'jotform_synced_at' => date('Y-m-d H:i:s'),
            ]);

            return ['status' => 'synced', 'submission_id' => $submissionId];
        } catch (Throwable $exception) {
            $message = mb_substr($exception->getMessage(), 0, 2000);
            $orders->update($orderId, [
                'jotform_status' => 'failed',
                'jotform_error' => $message,
            ]);
            log_message('error', 'Jotform synchronization failed for order {id}: {message}', [
                'id' => $orderId,
                'message' => $message,
            ]);
            throw $exception;
        }
    }

    /** @return array<string, string> */
    public function buildValues(array $order, array $user, array $items): array
    {
        $productLines = [];
        foreach ($items as $item) {
            $variant = empty($item['variant']) ? '' : ' (' . $item['variant'] . ')';
            $productLines[] = sprintf(
                '%d × %s%s @ PHP %s = PHP %s',
                (int) $item['quantity'],
                $item['product_name'],
                $variant,
                number_format((float) $item['unit_price'], 2, '.', ''),
                number_format((float) $item['line_total'], 2, '.', '')
            );
        }

        $customerComments = trim((string) ($order['comments'] ?? ''));
        $jotformComments = [
            'Website order #' . $order['id'],
            'Username: ' . $user['username'],
            '',
            'Products:',
            implode("\n", $productLines),
            '',
            'Website total: PHP ' . number_format((float) $order['total'], 2, '.', ''),
            'Proof of payment: stored securely with the website order.',
        ];
        if ($customerComments !== '') {
            $jotformComments[] = '';
            $jotformComments[] = 'Customer comments: ' . $customerComments;
        }

        return [
            'order_id' => (string) $order['id'],
            'customer_name' => (string) ($user['display_name'] ?: $user['username']),
            'username' => (string) $user['username'],
            'email' => (string) $user['email'],
            'phone' => (string) ($order['phone'] ?? ''),
            'street_address' => (string) $order['address'],
            'city' => (string) $order['city'],
            'region' => (string) $order['region'],
            'postal_code' => (string) $order['postal_code'],
            'delivery_address' => implode(', ', array_filter([
                $order['address'], $order['city'], $order['region'], $order['postal_code'],
            ])),
            'delivery_method' => (string) $order['delivery_method'],
            'products' => implode("\n", $productLines),
            'total' => 'PHP ' . number_format((float) $order['total'], 2, '.', ''),
            'payment_reference' => (string) ($order['payment_reference'] ?? ''),
            'comments' => implode("\n", $jotformComments),
        ];
    }

    public function submit(array $order, array $user, array $items): string
    {
        $values = $this->buildValues($order, $user, $items);
        $fieldMap = $this->resolveFieldMap();
        $submission = [];

        foreach ($values as $logicalName => $value) {
            if (!empty($fieldMap[$logicalName])) {
                $submission[(string) $fieldMap[$logicalName]] = $value;
            }
        }

        if ($this->config->formId === self::BLUMIES_FORM_ID) {
            [$firstName, $lastName] = $this->splitName($values['customer_name']);
            unset($submission[self::BLUMIES_FIELD_MAP['customer_name']], $submission[self::BLUMIES_FIELD_MAP['phone']]);
            $submission[self::BLUMIES_FIELD_MAP['customer_name'] . '_first'] = $firstName;
            $submission[self::BLUMIES_FIELD_MAP['customer_name'] . '_last'] = $lastName;
            $submission[self::BLUMIES_FIELD_MAP['phone'] . '_full'] = $values['phone'];
        }

        if ($submission === []) {
            throw new RuntimeException('No Jotform questions match the order fields. Configure JOTFORM_FIELD_MAP or use the documented field labels.');
        }

        $response = $this->http->request('POST', $this->endpoint('/form/' . rawurlencode($this->config->formId) . '/submissions'), [
            'query' => ['apiKey' => $this->config->apiKey],
            'headers' => ['Accept' => 'application/json'],
            'form_params' => ['submission' => $submission],
            'http_errors' => false,
        ]);

        $payload = json_decode((string) $response->getBody(), true);
        if ($response->getStatusCode() >= 300 || !is_array($payload) || (int) ($payload['responseCode'] ?? 0) !== 200) {
            $message = is_array($payload) ? ($payload['message'] ?? 'Unknown Jotform error') : 'Invalid Jotform response';
            throw new RuntimeException('Jotform rejected the submission: ' . $message);
        }

        $content = $payload['content'] ?? [];
        $first = is_array($content) && array_is_list($content) ? ($content[0] ?? []) : $content;
        $submissionId = $first['submissionID'] ?? $first['submissionId'] ?? $first['id'] ?? null;

        return $submissionId === null ? 'submitted-' . date('YmdHis') : (string) $submissionId;
    }

    /** @return array<string, string> */
    private function resolveFieldMap(): array
    {
        if ($this->config->formId === self::BLUMIES_FORM_ID) {
            return array_replace(self::BLUMIES_FIELD_MAP, $this->config->fieldMap);
        }

        $map = $this->config->fieldMap;
        $questions = $this->getQuestions();
        $aliases = [
            'order_id' => ['order id', 'order number', 'order no'],
            'customer_name' => ['customer name', 'full name', 'name'],
            'username' => ['username', 'user name'],
            'email' => ['email', 'email address'],
            'phone' => ['phone', 'phone number'],
            'street_address' => ['street address', 'address line 1'],
            'city' => ['city'],
            'region' => ['region', 'state', 'province'],
            'postal_code' => ['postal code', 'zip code', 'postal zip code'],
            'delivery_address' => ['delivery address', 'shipping address', 'address'],
            'delivery_method' => ['delivery method', 'shipping method'],
            'products' => ['products', 'order items', 'items'],
            'total' => ['total', 'order total', 'total amount'],
            'payment_reference' => ['payment reference number', 'payment reference', 'reference number'],
            'comments' => ['comments or suggestions', 'comments', 'notes'],
        ];

        foreach ($questions as $question) {
            $qid = (string) ($question['qid'] ?? '');
            if ($qid === '') {
                continue;
            }
            $candidates = [$this->normalize((string) ($question['name'] ?? '')), $this->normalize((string) ($question['text'] ?? ''))];
            foreach ($aliases as $logicalName => $names) {
                if (!empty($map[$logicalName])) {
                    continue;
                }
                $normalizedAliases = array_map([$this, 'normalize'], $names);
                if (array_intersect($candidates, $normalizedAliases)) {
                    $map[$logicalName] = $qid;
                }
            }
        }

        return $map;
    }

    /** @return list<array<string, mixed>> */
    private function getQuestions(): array
    {
        $response = $this->http->get($this->endpoint('/form/' . rawurlencode($this->config->formId) . '/questions'), [
            'query' => ['apiKey' => $this->config->apiKey],
            'headers' => ['Accept' => 'application/json'],
            'http_errors' => false,
        ]);
        $payload = json_decode((string) $response->getBody(), true);

        if ($response->getStatusCode() >= 300 || !is_array($payload) || (int) ($payload['responseCode'] ?? 0) !== 200) {
            throw new RuntimeException('Unable to read Jotform questions. Check the API key, form ID, and API region URL.');
        }

        return array_values(array_filter($payload['content'] ?? [], 'is_array'));
    }

    private function normalize(string $value): string
    {
        $value = preg_replace('/(?<!^)[A-Z]/', ' $0', $value) ?? $value;
        return trim(preg_replace('/[^a-z0-9]+/', ' ', strtolower($value)) ?? '');
    }

    /** @return array{0:string,1:string} */
    private function splitName(string $fullName): array
    {
        $parts = preg_split('/\s+/', trim($fullName)) ?: [];
        if (count($parts) < 2) {
            return [$parts[0] ?? 'Customer', '-'];
        }

        $lastName = array_pop($parts);
        return [implode(' ', $parts), $lastName];
    }

    private function endpoint(string $path): string
    {
        return $this->config->apiUrl . $path;
    }
}
