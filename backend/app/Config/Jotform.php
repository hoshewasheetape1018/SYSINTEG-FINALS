<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Jotform extends BaseConfig
{
    public string $apiKey = '';
    public string $formId = '';
    public string $apiUrl = 'https://api.jotform.com';

    /** @var array<string, string> Logical field name => Jotform question ID */
    public array $fieldMap = [];

    public function __construct()
    {
        parent::__construct();

        $this->apiKey = trim((string) env('JOTFORM_API_KEY', ''));
        $this->formId = trim((string) env('JOTFORM_FORM_ID', ''));
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
