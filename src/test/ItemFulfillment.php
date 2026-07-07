<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\ItemFulfillment\ItemFulfillmentData;
use Api\ApiHelper\Config\ConfigManager;

class ItemFulfilmentManager
{
    private $itemFulfillmentService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->itemFulfillmentService = new ItemFulfillmentData($apiConfig);
    }

    public function testReadAll(){
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=2';
            $response = $this->itemFulfillmentService->readAll('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails(){
        $id="FF-86285608";
        try {
            $response = $this->itemFulfillmentService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadInvoiceItemFulfillment(){
        $invoiceId="INV-WP6Y1K-5939";
        try {
            $response = $this->itemFulfillmentService->readInvoiceItemFulfillment($invoiceId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadInvoiceItemFulfillmentDetails(){
        $invoiceId="INV-WP6Y1K-5939";
        $id="FF-86285608";
        try {
            $response = $this->itemFulfillmentService->readInvoiceItemFulfillmentDetails($invoiceId,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function testCreateInvoiceItemFulfillment()
    {
        $params = [
            "item_fulfillments" => [
                "status" => "PICKED",
                "date" => "2024-12-22",
                "note" => "fulfillments #1, for uuid: free mix",
                "fulfillments" => [
                    [
                        "item_uuid" => "c2042ee2-24cc-4956-8e98-1335ffc4e09a",
                        "fulfillment_quantity" => 1,
                        "uuid" => "73f5df3c-d6a9-44ee-a6f3-335aa9d1550b"
                    ]
                ]
            ]
        ];

        $invoiceId="INV-IE1DSN-6084";

        try {
            $response = $this->itemFulfillmentService->createInvoiceItemFulfillment($params,$invoiceId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate()
    {
        $params = [
            "item_fulfillment" => [
                "date" => "2026-01-05",
                "id" => "FF-20232656",
                "tracking_number" => "TR-02506654",
                "note" => "fulfillment_note",
                "fulfillments" => [
                    [
                        "item_uuid" => "fb360044-0fcc-480b-90fb-086c346ef690",
                        "fulfillment_quantity" => "8",
                        "uuid" => "fa2c0cba-935e-4ac1-8f2b-a55aac42a74a"
                    ]
                ]
            ]
        ];

        $id = "FF-20232656";

        try {
            $response = $this->itemFulfillmentService->update($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$itemFulfillmentManager = new ItemFulfilmentManager();
//$itemFulfillmentManager->testCreateInvoiceItemFulfillment();
//$itemFulfillmentManager->testReadAll();
//$itemFulfillmentManager->testReadDetails();
//$itemFulfillmentManager->testReadInvoiceItemFulfillment();
//$itemFulfillmentManager->testReadInvoiceItemFulfillmentDetails();
//$itemFulfillmentManager->testUpdate();