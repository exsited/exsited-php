<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Invoice\InvoiceData;
use Api\ApiHelper\Config\ConfigManager;

class InvoiceManager
{
    private $invoiceService;
    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->invoiceService = new InvoiceData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->invoiceService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id='INV-60828777';
        try {
            $response = $this->invoiceService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadOrderInvoice()
    {
        $orderId='ORD-76GOU2-1267';

        try {
            $response = $this->invoiceService->readOrderInvoice($orderId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsInformation()
    {
        $id='INV-40319013';
        try {
            $invoice = $this->invoiceService->readDetailsInformation($id);
            echo '<pre>' . json_encode($invoice, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateOrderInvoice()
    {
        $params = [
            'invoice' => [
                // 'id' => 'INV-DIPZQZ-0001', // Optional: Unique identifier for the invoice
                'invoice_note' => 'note'
            ]
        ];
        $orderID='ORD-76GOU2-1267';
        try {
            $invoice = $this->invoiceService->createOrderInvoice($params,$orderID,'v3');
            echo '<pre>' . json_encode($invoice, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountInvoices()
    {
        $accountId='76GOU2';
        $queryParams = '?order_by=created_on&direction=desc&limit=2';
        try {
            $response = $this->invoiceService->readAccountInvoices($accountId,[],'v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateAmend()
    {

        $params = [
            "invoice" => [
                "lines" => [
                    // [
                    //     "operation" => "ADD",
                    //     "value" => [
                    //         // "item_id" => "IT3M-0031",
                    //         "item_uuid" => "aaca8224-0e66-4e8a-8ba0-2441bd77df51",
                    //         // "item_name" => "item 1 update ",
                    //         "item_invoice_note" => "note updated",
                    //         "item_quantity" => "3",
                    //         "item_price" => "10.123645",
                    //         "item_discount_amount" => "0.25",
                    //     ]
                    // ],
                    // [
                    //     "operation" => "UPDATE",
                    //     "uuid" => "078FC249-C396-4409-B10C-AE0873F8B12B",
                    //     "item_order_quantity" => "2"
                    // ],
                    [
                        "operation" => "UPDATE",
                        // "item_order_quantity" => "1",
                        "item_price" => "16.00",
                        "item_discount_amount" => "15.00",
                        // "item_uuid" => "aaca8224-0e66-4e8a-8ba0-2441bd77df51",
                        "uuid" => "02e01865-3dc8-4429-8ed9-a66d9a7eb94f"
                    ]
                ],
            ]
        ];

        $id='INV-76GOU2-6081';

        try {
            $response = $this->invoiceService->createAmend($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id='INV-76GOU2-6067';

        try {
            $response = $this->invoiceService->delete($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPdf()
    {
        $id = 'INV-76GOU2-6081';
        try {
            $response = $this->invoiceService->readPdf($id);
            header('Content-Type: application/json'); // Optional: Ensures correct content type for browsers
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




}



    $invoiceManager = new InvoiceManager();
//    $invoiceManager->testReadAll();
//    $invoiceManager->testReadDetails();
//    $invoiceManager->testReadOrderInvoice();
//    $invoiceManager->testCreateOrderInvoice();
//    $invoiceManager->testReadDetailsInformation();
//    $invoiceManager->testReadAccountInvoices();
//    $invoiceManager->testCreateAmend();
//    $invoiceManager->testDelete();
//    $invoiceManager->testReadPdf();
