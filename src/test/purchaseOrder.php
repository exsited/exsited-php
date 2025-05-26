<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\PurchaseOrder\PurchaseOrderData;
use Api\ApiHelper\Config\ConfigManager;

class PurchaseOrderManager
{
    private $purchaseOrderService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->purchaseOrderService = new PurchaseOrderData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->purchaseOrderService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetails()
    {
        $id = 'PO-1E4TEZ-0001';
        try {
            $response = $this->purchaseOrderService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetailsInformation()
    {
        $id = 'PO-1E4TEZ-0001';
        try {
            $response = $this->purchaseOrderService->readDetailsInformation($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadLines()
    {
        $id = 'PO-1E4TEZ-0001';
        try {
            $response = $this->purchaseOrderService->readLines($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadLineDetails()
    {
        $id = 'PO-1E4TEZ-0001';
        $lineUUID = '11e09c27-2aac-41ac-9ea9-33b17a0e72cc';
        try {
            $response = $this->purchaseOrderService->readLineDetails($id,$lineUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadAccountPurchaseOrders()
    {
        $accountId = 'LHROM9';
        try {
            $response = $this->purchaseOrderService->readAccountPurchaseOrders($accountId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testCreate()
    {
        $params = [
            "purchase_order" => [
                "currency" => "AUD",
                "price_tax_inclusive" => "true",
                "account_id" => "LHROM9",
                "lines" => [
                    [
                        "item_uuid" => "b4d249b7-3786-4a0a-92f4-e1316172e00e",
                        "item_quantity" => "40.000000",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price_type" => "INCREMENTAL_PER_UNIT_PRICING",
                                "price" => "2.000000"
                            ]
                        ],
                        "item_purchase_tax_configuration" => [
                            "purchase_price_is_tax_inclusive" => "true",
                            "tax_code" => [
                                "uuid" => "d166b28c-395b-4692-87b9-7408a01b72c0",
                                "code" => "GST",
                                "rate" => "10.000000"
                            ]
                        ],
                        "item_price_tax_exempt" => "false",
                        "item_price_tax" => [
                            "uuid" => "d166b28c-395b-4692-87b9-7408a01b72c0",
                            "code" => "GST",
                            "rate" => "10.000000"
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->purchaseOrderService->create($params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id = 'PO-LHROM9-0023';
        try {
            $response = $this->purchaseOrderService->delete($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCancel()
    {
        $id = 'PO-LHROM9-0024';
        try {
            $response = $this->purchaseOrderService->cancel($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChange()
    {
        $id = "PO-2Q5CFG-0029";
        $params = [
            "purchase-order" => [
                "supplier_invoice_id" => "PI-2Q5CFG-0004",
                "issue_date" => "2024-12-26",
                "due_date" => "2024-12-26",
                "expected_completion_date" => "2024-12-26",
                "purchase_order_note" => "note order hello",
//                "custom_attributes" => [
//                    [
//                        "name" => "University",
//                        "value" => "UIU"
//                    ]
//                ]
            ]
        ];
        try {
            $response = $this->purchaseOrderService->change($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReactivate()
    {
        $id = 'PO-LHROM9-0024';
        try {
            $response = $this->purchaseOrderService->reactivate($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



}

$purchaseOrderManager = new PurchaseOrderManager();
//$purchaseOrderManager->testReadAll();
//$purchaseOrderManager->testReadDetails();
//$purchaseOrderManager->testCreate();
//$purchaseOrderManager->testReadDetailsInformation();
//$purchaseOrderManager->testReadLines();
//$purchaseOrderManager->testReadLineDetails();
//$purchaseOrderManager->testReadAccountPurchaseOrders();
//$purchaseOrderManager->testDelete();
//$purchaseOrderManager->testCancel();
//$purchaseOrderManager->testReactivate();
//$purchaseOrderManager->testChange();



