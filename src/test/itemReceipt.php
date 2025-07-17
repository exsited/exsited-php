<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\ItemReceipt\ItemReceiptData;
use Api\ApiHelper\Config\ConfigManager;

class ItemReceiptManager
{
    private $itemReceiptService;

    public function __construct($index = 0)
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig($index);
        $apiConfig = new ApiConfig($authCredentialData);
        $this->itemReceiptService = new ItemReceiptData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->itemReceiptService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id = "IR-86178744";
        try {
            $response = $this->itemReceiptService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseOrderItemReceipt()
    {
        $purchaseOrderId = "PO-WP6Y1K-0020";
        try {
            $response = $this->itemReceiptService->readPurchaseOrderItemReceipt($purchaseOrderId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



}

$itemReceiptManager = new ItemReceiptManager();
//$itemReceiptManager->testReadAll();
//$itemReceiptManager->testReadDetails();
$itemReceiptManager->testReadPurchaseOrderItemReceipt();

