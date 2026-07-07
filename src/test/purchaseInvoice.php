<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\PurchaseInvoice\PurchaseInvoiceData;
use Api\ApiHelper\Config\ConfigManager;

class PurchaseInvoiceManager
{
    private $purchaseInvoiceService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->purchaseInvoiceService = new PurchaseInvoiceData($apiConfig);
    }
    public function testReadAll(){
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=2';
            $response = $this->purchaseInvoiceService->readAll('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetails()
    {
        $id = 'PI-3YV4FY-0001';
        try {
            $response = $this->purchaseInvoiceService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountPurchaseInvoices()
    {
        $accountId = '3YV4FY';
        try {
            $response = $this->purchaseInvoiceService->readAccountPurchaseInvoices($accountId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreatePurchaseOrderPurchaseInvoices()
    {
        $PurchaseOrderId = '3YV4FY';
        $params = [];
        try {
            $response = $this->purchaseInvoiceService->createPurchaseOrderPurchaseInvoices($PurchaseOrderId,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadLinesDetails()
    {
        $id = 'PI-3YV4FY-0001';
        $lineUUID='e2982354-cb09-4ab9-8fcf-143f54f5a5d6';
        try {
            $response = $this->purchaseInvoiceService->readLinesDetails($id,$lineUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCancel()
    {
        $id = 'PI-3YV4FY-0001';
        try {
            $response = $this->purchaseInvoiceService->cancel($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReactivate()
    {
        $id = 'PI-3YV4FY-0001';
        try {
            $response = $this->purchaseInvoiceService->reactivate($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id = 'PI-2Q5CFG-0002';
        try {
            $response = $this->purchaseInvoiceService->delete($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




}
$purchaseInvoiceManager = new PurchaseInvoiceManager();
$purchaseInvoiceManager->testReadAll();
//$purchaseInvoiceManager->testReadDetails();
//$purchaseInvoiceManager->testReadAccountPurchaseInvoices();
//$purchaseInvoiceManager->testReadLinesDetails();
//$purchaseInvoiceManager->testCancel();
//$purchaseInvoiceManager->testReactivate();
//$purchaseInvoiceManager->testDelete();