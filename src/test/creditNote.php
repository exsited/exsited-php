<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\CreditNote\CreditNoteData;
use Api\ApiHelper\Config\ConfigManager;

class CreditNoteManager
{
    private $creditNoteService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
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
            $queryParams = '?order_by=created_on&direction=desc&limit=2';
            $response = $this->creditNoteService->readAllCreditNoteApplications('v3', $queryParams);
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

    public function testReadAllCreditNotes()
    {
        try {
            $queryParams = [
                'records' => 10,
                'limit' => 15,
                'offset' => 0,
            ];
            $response = $this->creditNoteService->readAllCreditNotes('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$creditNoteManager = new CreditNoteManager();
//$creditNoteManager->testRead();
$creditNoteManager->testReadAllCreditNoteApplications();
//$creditNoteManager->testReadCreditNoteApplicationsDetails();
//$creditNoteManager->testReadInvoiceCreditNoteApplications();
$creditNoteManager->testReadAllCreditNotes();
