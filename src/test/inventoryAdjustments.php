<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\InventoryAdjustments\InventoryAdjustmentsData;
use Api\ApiHelper\Config\ConfigManager;

class InventoryAdjustmentsManager
{
    private $InventoryAdjustmentsService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->InventoryAdjustmentsService = new InventoryAdjustmentsData($apiConfig);
    }

    public function testReadAllInventoryAdjustments()
    {
        try {
            $queryParams = [
                'records' => 200,
                'limit' => 10,
                'offset' => 2,
            ];
            $response = $this->InventoryAdjustmentsService->readAllInventoryAdjustments('v2', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

    $InventoryAdjustmentsManager = new InventoryAdjustmentsManager();

    $InventoryAdjustmentsManager->testReadAllInventoryAdjustments();