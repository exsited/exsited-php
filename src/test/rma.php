<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Rma\RmaData;
use Api\ApiHelper\Config\ConfigManager;

class RmaManager
{
    private $rmaService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->rmaService = new RmaData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->rmaService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id="RMA-77488099";
        try {
            $response = $this->rmaService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadInvoiceRmaReceiveAll()
    {
        $invoiceId="INV-WP6Y1K-5939";
        $id="RMA-63833430";
        try {
            $response = $this->rmaService->readInvoiceRmaReceiveAll($id,$invoiceId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadInvoiceAllRma()
    {
        $invoiceId="INV-WP6Y1K-5939";
        try {
            $response = $this->rmaService->readInvoiceAllRma($invoiceId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreateInvoiceRma()
    {
        $invoiceId="INV-WP6Y1K-5939";
        $params = [
            "return_merchandise_authorisations" => [
                // "id" => "", // if not given, system will generate this id
                "date" => "2024-12-23",
                "note" => "rma #1, for uuid:e38792f7-80f9-4e9f-93a5-3a388bb6765a",
                "returns" => [
                    [
                        "rma_quantity" => "1",
                        "item_uuid" => "c1efb881-b90d-4733-989b-fbb4dd34c7d4",
                        "uuid" => "e38792f7-80f9-4e9f-93a5-3a388bb6765a"
                    ],
                ]
            ]
        ];

        try {
            $response = $this->rmaService->createInvoiceRma($invoiceId,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadInvoiceRmaDetails()
    {
        $invoiceId="INV-WP6Y1K-5939";
        $id="RMA-56815545";
        try {
            $response = $this->rmaService->readInvoiceRmaDetails($invoiceId,$id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateInvoiceRmaReceive()
    {
        $invoiceId="INV-WP6Y1K-5939";
        $id="RMA-79766821";
        $params = [
            "receive_return_merchandise_authorisations" => [
                "receive_returns" => [
                    [
                        "rma_receive_quantity" => "1",
                        "uuid" => "06d61145-a886-4e79-8661-d3fdd15e5f0b"
                    ]
                ]
            ]
        ];

        try {
            $response = $this->rmaService->createInvoiceRmaReceive($id,$invoiceId,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




}


$rmaManager= new RmaManager();
//$rmaManager->testReadAll();
//$rmaManager->testReadDetails();
//$rmaManager->testReadInvoiceRmaReceiveAll();
//$rmaManager->testReadInvoiceAllRma();
//$rmaManager->testCreateInvoiceRma();
//$rmaManager->testReadInvoiceRmaDetails();
//$rmaManager->testCreateInvoiceRmaReceive();