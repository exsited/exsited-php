<?php
require '../../vendor/autoload.php';

use Api\AppService\ProformaInvoices\ProformaInvoicesData;
use Api\Component\ApiConfig;
use Api\ApiHelper\Config\ConfigManager;

class ProformaInvoicesManager
{
    private $proformaInvoicesService;
    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->proformaInvoicesService = new ProformaInvoicesData($apiConfig);
    }

    public function testReadAllProformaInvoices()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=2';
            $response = $this->proformaInvoicesService->readAllProformaInvoices('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testReadProformaInvoicesDetails()
    {
        $id = 'INV-32299569';
        try {
            $response = $this->proformaInvoicesService->readProformaInvoicesDetails($id, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testCreateProformaInvoicesPayment()
    {
        $params = [
            "payment" => [
                // "id" => "PMT-123", // Optional
                "date" => "2025-09-02",
                "note" => "Notes",
                "payment_note" => "payment note",
                "payment_applied" => [
                    [
                        "processor" => "Cash",
                        "amount" => "100",
                        "reference" => "abcd"
                    ]
                ]
            ]
        ];
        $id = 'INV-32299569';
        try {
            $invoice = $this->proformaInvoicesService->createProformaInvoicesPayment($id, $params, 'v2');
            echo '<pre>' . json_encode($invoice, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


}


$invoiceManager = new ProformaInvoicesManager(2);
//$invoiceManager->testReadAllProformaInvoices();
//$invoiceManager->testReadProformaInvoicesDetails();
$invoiceManager->testCreateProformaInvoicePayment();