<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Gift\GiftData;
use Api\ApiHelper\Config\ConfigManager;

class GiftManager
{
    private $giftService;

    public function __construct($index = 0)
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig($index);
        $apiConfig = new ApiConfig($authCredentialData);
        $this->giftService = new GiftData($apiConfig);
    }
    public function testCreate()
    {
        $params = [
            "gift_certificate" => [
                "status" => "ACTIVE",
                "accounting_code" => "Gift Certificate",
                "amount" => "100",
                "currency" => "AUD",
                "expiry_date" => "2030-09-24"
            ]
        ];

        try {
            $response = $this->giftService->create($params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadAll()
    {
        try {
            $response = $this->giftService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetails()
    {
        $uuId="2addae15-f1b6-4d51-84a9-304c8adbf5ee";
        try {
            $response = $this->giftService->readDetails($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testAllocate()
    {
        $params = [
            "gift_certificate" => [
                "account" => "J51VQS"
            ]
        ];
        $uuId="2addae15-f1b6-4d51-84a9-304c8adbf5ee";

        try {
            $response = $this->giftService->allocate($params,$uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAllocations()
    {
        $uuId="2addae15-f1b6-4d51-84a9-304c8adbf5ee";

        try {
            $response = $this->giftService->readAllocations($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeallocate()
    {
        $params = [
            "gift_certificate" => [
                "account" => "J51VQS"
            ]
        ];
        $uuId="2addae15-f1b6-4d51-84a9-304c8adbf5ee";

        try {
            $response = $this->giftService->deallocate($params,$uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChange()
    {
        $params =  [
            "gift_certificate" => [
                "expiry_date" => "2026-08-11"
            ]
        ];

        $uuId="d0b29e0e-94c9-4921-9c0b-7df34a322499";

        try {
            $response = $this->giftService->change($params,$uuId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testDelete()
    {
        $uuId="99810923-87bb-40b9-821f-b23f0e6fa9b9";
        try {
            $response = $this->giftService->delete($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadTransactions()
    {
        $uuId="6dd39a31-7ef4-470e-8a29-842240804857";
        try {
            $response = $this->giftService->readTransactions($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testAmend()
    {
        $params = [
            "gift_certificate" => [
                "amount" => "100",
                "accounting_code" => "Gift Certificate"
            ]
        ];


        $uuId="6dd39a31-7ef4-470e-8a29-842240804857";

        try {
            $response = $this->giftService->amend($params,$uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDisable()
    {
        $uuId="6dd39a31-7ef4-470e-8a29-842240804857";
        try {
            $response = $this->giftService->disable($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testEnable()
    {
        $uuId="6dd39a31-7ef4-470e-8a29-842240804857";
        try {
            $response = $this->giftService->enable($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



}


$giftManager = new GiftManager();
//$giftManager->testCreate();
//$giftManager->testReadAll();
//$giftManager->testAllocate();
//$giftManager->testReadAllocations();
//$giftManager->testReadDetails();
//$giftManager->testDeallocate();
//$giftManager->testChange();
//$giftManager->testReadTransactions();
//$giftManager->testDelete();
//$giftManager->testAmend();
//$giftManager->testDisable();
//$giftManager->testEnable();