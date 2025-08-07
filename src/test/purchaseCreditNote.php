<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\PurchaseCreditNote\PurchaseCreditNoteData;
use Api\ApiHelper\Config\ConfigManager;

class PurchaseCreditNoteManager
{
    private $purchaseCreditNoteService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->purchaseCreditNoteService = new PurchaseCreditNoteData($apiConfig);
    }

    public function testRead()
    {
        $id = "27517580";
        try {
            $response = $this->purchaseCreditNoteService->read($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAllPurchaseCreditNoteApplications()
    {
        try {
            $response = $this->purchaseCreditNoteService->readAllPurchaseCreditNoteApplications('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseCreditNoteApplicationsDetails()
    {
        $purchaseCreditNoteApplicationsUUID = "e4ea4181-cc81-4667-b742-c495bfd3aba4";

        try {
            $response = $this->purchaseCreditNoteService->readPurchaseCreditNoteApplicationsDetails($purchaseCreditNoteApplicationsUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseInvoiceCreditNoteApplications()
    {
        $purchaseInvoiceId = "PI-3YV4FY-0005";
        try {
            $response = $this->purchaseCreditNoteService->readPurchaseInvoiceCreditNoteApplications($purchaseInvoiceId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$purchaseCreditNoteManager = new PurchaseCreditNoteManager();

$purchaseCreditNoteManager->testRead();
//$purchaseCreditNoteManager->testReadAllPurchaseCreditNoteApplications();
//$purchaseCreditNoteManager->testReadPurchaseCreditNoteApplicationsDetails();
//$purchaseCreditNoteManager->testReadPurchaseInvoiceCreditNoteApplications();
