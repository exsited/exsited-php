<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\ExternalDatabase\ExternalDatabaseData;
use Api\ApiHelper\Config\ConfigManager;

class ExternalDatabaseManager
{
    private $externalDatabaseService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->externalDatabaseService = new ExternalDatabaseData($apiConfig);
    }


    public function testReadAll()
    {
        try {
            $response = $this->externalDatabaseService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testReadDetails()
    {
        $database_name = 'industry';

        // Optional
        $queryParams = '?limit=5&offset=5';

        try {
            // Test with pagination
            $response = $this->externalDatabaseService->readDetails($database_name, 'v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testReadTable()
    {
        $database_name = 'industry';
        $table_name = 'Sheet1';

        try {
            $response = $this->externalDatabaseService->readTable($database_name, $table_name, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testSearch()
    {
        $database_name = 'Operators List';

        $params = [
            "table_name" => "Sheet1",
            "limit" => 10,
            "offset" => 0,
//            "selected_fields" => ["Id"],
//            "conditions" => [
//                [
//                    "field" => "Id",
//                    "operator" => "=",
//                    "value" => "",
//                    "logical_operator" => "OR"
//                ]
//            ]
        ];

        try {
            $response = $this->externalDatabaseService->search($database_name, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}



$externalDatabaseManager = new ExternalDatabaseManager(0);

//$externalDatabaseManager->testReadAll();
//$externalDatabaseManager->testReadDetails();
//$externalDatabaseManager->testReadTable();
//$externalDatabaseManager->testSearch();
