<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Labour\LabourData;
use Api\ApiHelper\Config\ConfigManager;

class LabourOrdersManager
{
    private $labourService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->labourService = new LabourData($apiConfig);
    }

    public function testReadLabourOrders()
    {
        $labourUUID = '0c488a93-52dc-4b00-8069-0ac6361bc7ae'; // Replace with actual labour UUID
        try {
            $queryParams = '?limit=1&offset=0';
            $response = $this->labourService->readOrders($labourUUID, 'v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$manager = new LabourOrdersManager();

echo "<h2>Test: Read Labour Orders</h2>";
$manager->testReadLabourOrders();
