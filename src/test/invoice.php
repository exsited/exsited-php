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
            $queryParams = '?order_by=created_on&direction=desc&limit=2';
            $response = $this->invoiceService->readAll('v3', $queryParams);
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
        $accountId='Q23QW1';
        $queryParams = [
            'records' => 10,
            'limit' => 15,
            'offset' => 0,
        ]; //'?order_by=created_on&direction=desc&limit=2';

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

    public function testInvoicePdf()
    {
        $invoiceId = "INV-U894RZ-0161";

        try {
            // Binary format
            echo "<h3>Test 1: Binary Format</h3>";
            $pdfBinary = $this->invoiceService->invoicePdf($invoiceId, null, 'binary');

            if (is_string($pdfBinary)) {
                $pdfPath = "C:/Users/mehedi/Documents/{$invoiceId}.pdf";
                file_put_contents($pdfPath, $pdfBinary);
                echo "✓ PDF saved successfully at: {$pdfPath}<br>";
                echo "✓ File size: " . strlen($pdfBinary) . " bytes<br>";
                exec("start {$pdfPath}");
            }

            echo "<hr>";

            // Small delay to avoid rate limiting
            sleep(1);

            // Hexadecimal format
            echo "<h3>Test 2: Hex Format</h3>";
            $pdfHex = $this->invoiceService->invoicePdf($invoiceId, null, 'hex');

            if (is_string($pdfHex)) {
                $hexPath = "C:/Users/mehedi/Documents/{$invoiceId}.hex";
                file_put_contents($hexPath, $pdfHex);
                echo "✓ Hex file saved successfully at: {$hexPath}<br>";
                echo "✓ Hex string length: " . strlen($pdfHex) . " characters<br><br>";
                exec("start {$hexPath}");
            }

            echo "<hr>";

            sleep(1);

            // Base64 format
            echo "<h3>Test 3: Base64 Format</h3>";
            $pdfBase64 = $this->invoiceService->invoicePdf($invoiceId, null, 'base64');

            if (is_string($pdfBase64)) {
                $base64Path = "C:/Users/mehedi/Documents/{$invoiceId}.base64.txt";
                file_put_contents($base64Path, $pdfBase64);
                echo "✓ Base64 file saved successfully at: {$base64Path}<br>";
                echo "✓ Base64 string length: " . strlen($pdfBase64) . " characters<br><br>";
                exec("start {$base64Path}");
            }

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatInvoice()
    {
        $params = [
            "invoice" => [
                "customer_purchase_order_id" => "customer-postman-1",
                "issue_date" => "2025-01-29",
                "due_date" => "2025-01-29",
                "price_tax_inclusive" => "true",
                "account_id" => "EXAC-3A80JQUK997H-11008",
                "custom_attributes" => [],
                "lines" => [
                    [
                        "item_id" => "EXIT-M6H14161ZT9A-11006",
                        "item_quantity" => "1",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price" => "100"
                            ]
                        ],
                        "discount" => "11",
                        "discount_type" => "PERCENTAGE",
                        "item_accounting_code" => "SALES_REVENUE",
                        "item_tax_exampt_when_sold" => "false"
                    ]
                ]
            ]
        ];
        try {
            $invoice = $this->invoiceService->createInvoice($params,'v3');
            echo '<pre>' . json_encode($invoice, JSON_PRETTY_PRINT) . '</pre>';
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
//    $invoiceManager->testCreatInvoice();
//    $invoiceManager->testInvoicePdf();
//    $invoiceManager->testCreatInvoice();
