<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Settings\SettingsData;
use Api\ApiHelper\Config\ConfigManager;

class SettingsManager
{
    private $settingsService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->settingsService = new SettingsData($apiConfig);
    }

    public function testGetWarehouseSettings()
    {
        try {
            echo "\n=== Testing Get Warehouse Settings ===\n";
            $uuid = "warehouse-uuid-here";
            echo "Warehouse UUID: {$uuid}\n";

            $response = $this->settingsService->getWarehouseSettings($uuid);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetVariationSettings()
    {
        try {
            echo "\n=== Testing Get Variation Settings ===\n";
            $uuid = "variation-uuid-here";
            echo "Variation UUID: {$uuid}\n";

            $response = $this->settingsService->getVariationSettings($uuid);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$settingsManager = new SettingsManager();
//$settingsManager->testGetWarehouseSettings();
//$settingsManager->testGetVariationSettings();
