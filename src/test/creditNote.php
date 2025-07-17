<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\CreditNote\CreditNoteData;
use Api\ApiHelper\Config\ConfigManager;

class CreditNoteManager
{
    private $creditNoteService;

    public function __construct($index = 0)
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig($index);
        $apiConfig = new ApiConfig($authCredentialData);
        $this->creditNoteService = new CreditNoteData($apiConfig);
    }

    public function testRead()
    {
        $id = "CRN-IE1DSN-0005";
        try {
            $response = $this->creditNoteService->read($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAllCreditNoteApplications()
    {
        try {
            $response = $this->creditNoteService->readAllCreditNoteApplications('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadCreditNoteApplicationsDetails()
    {
        $creditNoteApplicationsUUID = "3ad36e3b-a230-4351-9924-8a0fa8e09e41";

        try {
            $response = $this->creditNoteService->readCreditNoteApplicationsDetails($creditNoteApplicationsUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadInvoiceCreditNoteApplications()
    {
        $invoiceId = "INV-IE1DSN-6091";
        try {
            $response = $this->creditNoteService->readInvoiceCreditNoteApplications($invoiceId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$creditNoteManager = new CreditNoteManager();
//$creditNoteManager->testRead();
//$creditNoteManager->testReadAllCreditNoteApplications();
//$creditNoteManager->testReadCreditNoteApplicationsDetails();
//$creditNoteManager->testReadInvoiceCreditNoteApplications();
