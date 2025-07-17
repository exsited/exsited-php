<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\PurchaseRefund\PurchaseRefundData;
use Api\ApiHelper\Config\ConfigManager;

class PurchaseRefundManager
{
    private $purchaseRefundService;

    public function __construct($index = 0)
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig($index);
        $apiConfig = new ApiConfig($authCredentialData);
        $this->purchaseRefundService = new PurchaseRefundData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->purchaseRefundService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetails()
    {
        $id = "PRF-0001";
        try {
            $response = $this->purchaseRefundService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountPurchaseRefunds()
    {
        $accountId = "3YV4FY";
        try {
            $response = $this->purchaseRefundService->readAccountPurchaseRefunds($accountId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id = "PRF-0002";
        try {
            $response = $this->purchaseRefundService->delete($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
$purchaseRefundManager = new PurchaseRefundManager();
//$purchaseRefundManager->testReadAll();
//$purchaseRefundManager->testReadDetails();
$purchaseRefundManager->testReadAccountPurchaseRefunds();
//$purchaseRefundManager->testDelete();