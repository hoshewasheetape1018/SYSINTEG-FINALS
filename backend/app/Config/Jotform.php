<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Jotform extends BaseConfig
{
    public string $apiKey = '';
    public string $formId = '263211686457058';
    public string $apiUrl = 'https://api.jotform.com';

    /** @var array<string, string> Logical field name => Jotform question ID */
    public array $fieldMap = [];

    public function __construct()
    {
        parent::__construct();

        // Local/Docker installs use .env. The deployment workflow creates the
        // ignored runtime file below because the production host deliberately
        // preserves its existing .env file between FTP deployments.
        $runtimeApiKey = '';
        $runtimeSecretsFile = __DIR__ . '/JotformSecrets.php';
        if (is_file($runtimeSecretsFile)) {
            $runtimeSecrets = require $runtimeSecretsFile;
            if (is_array($runtimeSecrets)) {
                $runtimeApiKey = trim((string) ($runtimeSecrets['apiKey'] ?? ''));
            }
        }

        $environmentApiKey = trim((string) env('JOTFORM_API_KEY', ''));
        $this->apiKey = $environmentApiKey !== '' ? $environmentApiKey : $runtimeApiKey;
        $configuredFormId = trim((string) env('JOTFORM_FORM_ID', $this->formId));
        if ($configuredFormId !== '') {
            $this->formId = $configuredFormId;
        }
        $this->apiUrl = rtrim(trim((string) env('JOTFORM_API_URL', $this->apiUrl)), '/');

        $configuredMap = trim((string) env('JOTFORM_FIELD_MAP', ''));
        if ($configuredMap !== '') {
            $decoded = json_decode($configuredMap, true);
            if (is_array($decoded)) {
                $this->fieldMap = array_map('strval', $decoded);
            }
        }
    }
}
