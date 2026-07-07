<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Reports\ReportsData;
use Api\ApiHelper\Config\ConfigManager;

class ReportsManager
{
    private $reportsService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->reportsService = new ReportsData($apiConfig);
    }

    public function testReadAccountOverview()
    {
        try {
            $response = $this->reportsService->readAccountOverview('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadOrderOverview()
    {
        try {
            $response = $this->reportsService->readOrderOverview('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseInvoiceOverview()
    {
        try {
            $response = $this->reportsService->readPurchaseInvoiceOverview('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseOrderOverview()
    {
        try {
            $response = $this->reportsService->readPurchaseOrderOverview('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPaymentAndRefundOverview()
    {
        try {
            $response = $this->reportsService->readPaymentAndRefundOverview('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchasePaymentAndRefundOverview()
    {
        try {
            $response = $this->reportsService->readPurchasePaymentAndRefundOverview('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadInvoiceOverview()
    {
        try {
            $response = $this->reportsService->readInvoiceOverview('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$reportsManager = new ReportsManager();
//$reportsManager->testReadAccountOverview();
//$reportsManager->testReadOrderOverview();
//$reportsManager->testReadPurchaseInvoiceOverview();
//$reportsManager->testReadPurchaseOrderOverview();
//$reportsManager->testReadPaymentAndRefundOverview();
//$reportsManager->testReadPurchasePaymentAndRefundOverview();
//$reportsManager->testReadInvoiceOverview();
