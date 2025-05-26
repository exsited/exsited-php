<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\ItemFulfillment\ItemFulfillmentData;
use Api\ApiHelper\Config\ConfigManager;

class ItemFulfilmentManager
{
    private $itemFulfillmentService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->itemFulfillmentService = new ItemFulfillmentData($apiConfig);
    }

    public function testReadAll(){
        try {
            $response = $this->itemFulfillmentService->readAll('v3');
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

}

$itemFulfillmentManager = new ItemFulfilmentManager();
//$itemFulfillmentManager->testCreateInvoiceItemFulfillment();
//$itemFulfillmentManager->testReadAll();
//$itemFulfillmentManager->testReadDetails();
//$itemFulfillmentManager->testReadInvoiceItemFulfillment();
//$itemFulfillmentManager->testReadInvoiceItemFulfillmentDetails();