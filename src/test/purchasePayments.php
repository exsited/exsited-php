<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\PurchasePayments\PurchasePaymentsData;
use Api\ApiHelper\Config\ConfigManager;

class PurchasePaymentsManager
{
    private $purchasePaymentsService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->purchasePaymentsService = new PurchasePaymentsData($apiConfig);
    }

    public function testReadAllPurchasePayments()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=2';
            $response = $this->purchasePaymentsService->readAllPurchasePayments('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetailsPurchasePayments()
    {
        $id = "PPT-DQLP9B-0006";
        try {
            $response = $this->purchasePaymentsService->readDetailsPurchasePayments($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountPurchasePayments()
    {
        $accountId = "3YV4FY";
        try {
            $response = $this->purchasePaymentsService->readAccountPurchasePayments($accountId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatePurchaseInvoicePurchasePayments()
    {
        $purchaseInvoiceId = "3YV4FY";
        $params = [

        ];
        try {
            $response = $this->purchasePaymentsService->createPurchaseInvoicePurchasePayments($purchaseInvoiceId, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdatePurchasePaymentsInformation()
    {
        $PurchasePaymentId = "3YV4FY";
        $params = [

        ];
        try {
            $response = $this->purchasePaymentsService->updatePurchasePaymentsInformation($PurchasePaymentId, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdatePurchasePayments()
    {
        $PurchasePaymentId = "3YV4FY";
        $params = [

        ];
        try {
            $response = $this->purchasePaymentsService->updatePurchasePayments($PurchasePaymentId, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatePurchasePayments()
    {
        $params = [

        ];
        try {
            $response = $this->purchasePaymentsService->createPurchasePayments( $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseOrderPurchasePayments()
    {
        $orderId = "3YV4FY";
        $queryParams = '?order_by=created_on&direction=desc&limit=2';
        try {
            $response = $this->purchasePaymentsService->readPurchaseOrderPurchasePayments($orderId,'v3',$queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testPurchasePaymentsDelete()
    {
        $id = "PRF-0002";
        try {
            $response = $this->purchasePaymentsService->deletePurchasePayments($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}
$purchasePaymentsManager = new PurchasePaymentsManager(0);
//$purchasePaymentsManager->testReadAllPurchasePayments();
//$purchasePaymentsManager->testReadDetailsPurchasePayments();
//$purchasePaymentsManager->testReadAccountPurchasePayments();
$purchasePaymentsManager->testReadPurchaseOrderPurchasePayments();
//$purchasePaymentsManager->testDelete();