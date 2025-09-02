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
            $response = $this->proformaInvoicesService->readAllProformaInvoices('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testReadProformaInvoicesDetails()
    {
        $id='INV-60828777';
        try {
            $response = $this->proformaInvoicesService->readProformaInvoicesDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testCreateProformaInvoices()
    {
        $params = [
            'invoice' => [
                // 'id' => 'INV-DIPZQZ-0001', // Optional: Unique identifier for the invoice
                'invoice_note' => 'note'
            ]
        ];
        $id='INV-76GOU2-1267';
        try {
            $invoice = $this->proformaInvoicesService->createProformaInvoices($id, $params,'v3');
            echo '<pre>' . json_encode($invoice, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


}


    $invoiceManager = new ProformaInvoicesManager(1);

    $invoiceManager->testReadAllProformaInvoices();
