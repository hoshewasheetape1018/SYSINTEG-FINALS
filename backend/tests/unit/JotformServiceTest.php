<?php

namespace Tests\Unit;

use App\Libraries\JotformService;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Jotform;

class JotformServiceTest extends CIUnitTestCase
{
    public function testBuildValuesContainsCustomerProductsAndDelivery(): void
    {
        $service = new JotformService(new Jotform(), new \stdClass());
        $values = $service->buildValues(
            [
                'id' => 42,
                'address' => '1 Bloom Street',
                'city' => 'Manila',
                'region' => 'NCR',
                'postal_code' => '1000',
                'delivery_method' => 'Standard delivery',
                'phone' => '09171234567',
                'gcash_name' => 'Test Customer',
                'gcash_number' => '09171234567',
                'payment_reference' => 'GCASH-123',
                'comments' => 'Please pack carefully.',
                'total' => 700,
            ],
            ['display_name' => 'Test Customer', 'username' => 'tester', 'email' => 'tester@example.test'],
            [[
                'product_name' => 'Pocket Bloom',
                'variant' => 'Pink',
                'quantity' => 2,
                'unit_price' => 350,
                'line_total' => 700,
            ]]
        );

        $this->assertSame('42', $values['order_id']);
        $this->assertSame('Test Customer', $values['customer_name']);
        $this->assertSame('tester@example.test', $values['email']);
        $this->assertSame('1 Bloom Street, Manila, NCR, 1000', $values['delivery_address']);
        $this->assertStringContainsString('2 × Pocket Bloom (Pink)', $values['products']);
        $this->assertSame('PHP 700.00', $values['total']);
        $this->assertSame('09171234567', $values['phone']);
        $this->assertSame('Test Customer', $values['gcash_name']);
        $this->assertSame('09171234567', $values['gcash_number']);
        $this->assertSame('GCASH-123', $values['payment_reference']);
        $this->assertStringContainsString('GCash sender: Test Customer (09171234567)', $values['comments']);
        $this->assertStringContainsString('Website order #42', $values['comments']);
        $this->assertStringContainsString('Please pack carefully.', $values['comments']);
    }

    public function testSubmitMapsQuestionIdsAndReturnsSubmissionId(): void
    {
        $config = new Jotform();
        $config->apiKey = 'test-key';
        $config->formId = '123456';
        $config->apiUrl = 'https://api.jotform.test';
        $config->fieldMap = [
            'order_id' => '1', 'customer_name' => '2', 'username' => '3', 'email' => '4',
            'delivery_address' => '5', 'delivery_method' => '6', 'products' => '7', 'total' => '8',
        ];
        $http = new FakeJotformHttpClient();
        $service = new JotformService($config, $http);

        $submissionId = $service->submit(
            ['id' => 42, 'address' => '1 Bloom Street', 'city' => 'Manila', 'region' => 'NCR', 'postal_code' => '1000', 'delivery_method' => 'Standard delivery', 'total' => 350],
            ['display_name' => 'Test Customer', 'username' => 'tester', 'email' => 'tester@example.test'],
            [['product_name' => 'Pocket Bloom', 'variant' => 'Pink', 'quantity' => 1, 'unit_price' => 350, 'line_total' => 350]]
        );

        $this->assertSame('submission-99', $submissionId);
        $this->assertSame('POST', $http->method);
        $this->assertSame('https://api.jotform.test/form/123456/submissions', $http->url);
        $submission = $http->options['form_params']['submission'];
        $this->assertSame('42', $submission['1']);
        $this->assertStringContainsString('Pocket Bloom', $submission['7']);
        $this->assertSame('PHP 350.00', $submission['8']);
    }

    public function testBlumiesFormUsesExactQuestionAndCompositeFieldIds(): void
    {
        $config = new Jotform();
        $config->apiKey = 'test-key';
        $config->formId = '263211686457058';
        $config->apiUrl = 'https://api.jotform.test';
        $config->fieldMap = [];
        $http = new FakeJotformHttpClient();
        $service = new JotformService($config, $http);

        $service->submit(
            [
                'id' => 42, 'phone' => '09171234567', 'address' => '1 Bloom Street',
                'city' => 'Manila', 'region' => 'NCR', 'postal_code' => '1000',
                'delivery_method' => 'Grab (Contact us)', 'payment_reference' => 'GCASH-123',
                'gcash_name' => 'Test Customer', 'gcash_number' => '09171234567',
                'comments' => 'Leave at reception.', 'total' => 129,
            ],
            ['display_name' => 'Test Customer', 'username' => 'tester', 'email' => 'tester@example.test'],
            [['product_name' => 'Spring (Stitched)', 'variant' => '', 'quantity' => 1, 'unit_price' => 129, 'line_total' => 129]]
        );

        $submission = $http->options['form_params']['submission'];
        $this->assertSame('Test', $submission['3_first']);
        $this->assertSame('Customer', $submission['3_last']);
        $this->assertSame('tester@example.test', $submission['4']);
        $this->assertSame('09171234567', $submission['5_full']);
        $this->assertSame('1 Bloom Street', $submission['6']);
        $this->assertSame('Manila', $submission['7']);
        $this->assertSame('NCR', $submission['8']);
        $this->assertSame('1000', $submission['9']);
        $this->assertSame('GCASH-123', $submission['15']);
        $this->assertStringContainsString('Spring (Stitched)', $submission['21']);
        $this->assertStringContainsString('Leave at reception.', $submission['21']);
        $this->assertSame('Grab (Contact us)', $submission['28']);
        $this->assertArrayNotHasKey('10', $submission);
        $this->assertArrayNotHasKey('14', $submission);
    }
}

class FakeJotformHttpClient
{
    public string $method = '';
    public string $url = '';
    public array $options = [];

    public function get(string $url, array $options): FakeJotformResponse
    {
        return new FakeJotformResponse(200, json_encode(['responseCode' => 200, 'content' => []]));
    }

    public function request(string $method, string $url, array $options): FakeJotformResponse
    {
        $this->method = $method;
        $this->url = $url;
        $this->options = $options;
        return new FakeJotformResponse(200, json_encode([
            'responseCode' => 200,
            'message' => 'success',
            'content' => [['submissionID' => 'submission-99']],
        ]));
    }
}

class FakeJotformResponse
{
    public function __construct(private int $status, private string $body) {}
    public function getStatusCode(): int { return $this->status; }
    public function getBody(): string { return $this->body; }
}
