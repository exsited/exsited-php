<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\PurchaseInvoice\PurchaseInvoiceData;
use Api\ApiHelper\Config\ConfigManager;

class PurchaseInvoiceManager
{
    private $purchaseInvoiceService;

    public function __construct($index = 0)
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig($index);
        $apiConfig = new ApiConfig($authCredentialData);
        $this->purchaseInvoiceService = new PurchaseInvoiceData($apiConfig);
    }
    public function testReadAll(){
        try {
            $response = $this->purchaseInvoiceService->readAll('v3');
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
//$purchaseInvoiceManager->testReadAll();
//$purchaseInvoiceManager->testReadDetails();
//$purchaseInvoiceManager->testReadAccountPurchaseInvoices();
//$purchaseInvoiceManager->testReadLinesDetails();
//$purchaseInvoiceManager->testCancel();
//$purchaseInvoiceManager->testReactivate();
//$purchaseInvoiceManager->testDelete();