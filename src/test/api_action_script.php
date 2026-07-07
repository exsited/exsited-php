<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\ApiActionScript\ApiActionScriptData;
use Api\ApiHelper\Config\ConfigManager;

class ApiActionScriptManager
{
    private $scriptService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->scriptService = new ApiActionScriptData($apiConfig);
    }

    public function testExecuteScript()
    {
        $scriptUUID = 'your-script-uuid-here'; // Replace with actual script UUID
        $payload = [
            'data' => [
                'order_id' => 'ORD-AADVVI-0474',
                'item_info' => [
                    'effective_date' => '2026-01-15',
                    'lines' => [
                        [
                            'op' => 'add',
                            'item_accounting_code' => 'Sales Revenue',
                            'item_name' => 'Item 0980',
                            'item_invoice_note' => 'note',
                            'item_quantity' => '2',
                            'item_price' => '389'
                        ],
                        [
                            'op' => 'remove',
                            'uuid' => 'c647ab0c-8bb3-486b-97e9-0b0f1bc06343'
                        ],
                        [
                            'op' => 'change',
                            'uuid' => '32e6102f-55f6-4f08-ad73-0f13f3b5cb78',
                            'item_order_quantity' => '8'
                        ]
                    ]
                ],
                'order_info' => [
                    'description' => 'Hello worlds',
                    'custom_attributes' => [
                        [
                            'name' => 'Job_ID',
                            'value' => 'trump'
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->scriptService->execute($scriptUUID, $payload, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$manager = new ApiActionScriptManager();

echo "<h2>Test: Execute API Action Script</h2>";
$manager->testExecuteScript();
