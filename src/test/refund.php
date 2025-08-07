<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Refund\RefundData;
use Api\ApiHelper\Config\ConfigManager;

class refundManager
{
    private $refundService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->refundService = new refundData($apiConfig);
    }

    public function testReadDetails()
    {
        $id = 'REF-91685347';
        try {
            $response = $this->refundService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreate()
    {
        $creditNotesId = 'CRN-IE1DSN-0008';
        $params = [
            "refund" => [
                "date" => "2024-12-23",
                "amount" => "10.00",
                "reference" => "REF-123",
                "note" => "This is a refund note",
                "payment_method" => "ref_cash",
                "payment_processor" => "Cash"
            ]
        ];

        try {
            $response = $this->refundService->create($creditNotesId,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountRefunds()
    {
        $accountId = 'IE1DSN';
        try {
            $response = $this->refundService->readAccountRefunds($accountId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id = 'REF-71386630';
        try {
            $response = $this->refundService->delete($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



}

$refundManager = new refundManager();
//$refundManager->testReadDetails();
//$refundManager->testCreate();
//$refundManager->testReadAccountRefunds();
$refundManager->testDelete();