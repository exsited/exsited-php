<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\AccountingCodes\AccountingCodesData;
use Api\ApiHelper\Config\ConfigManager;

class AccountingCodesManager
{
    private $accountingCodesService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->accountingCodesService = new AccountingCodesData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->accountingCodesService->readAll('v2');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $uuid = 'a6061089-f0c5-428d-a5d6-8a317e01c9f6';
        try {
            $response = $this->accountingCodesService->readDetails($uuid, 'v2');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$accountingCodesManager = new AccountingCodesManager();
//$accountingCodesManager->testReadAll();
// $accountingCodesManager->testReadDetails();
