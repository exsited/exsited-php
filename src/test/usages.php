<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Usages\UsagesData;
use Api\ApiHelper\Config\ConfigManager;

class UsagesManager
{
    private $usagesService;

    public function __construct($index = 0)
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig($index);
        $apiConfig = new ApiConfig($authCredentialData);
        $this->usagesService = new UsagesData($apiConfig);
    }

    public function testReadAll(){
        try {
            $response = $this->usagesService->readAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails(){
        try {
            $uuId="4b2331e2-e8e4-4249-bb7a-2273a8cdaa34";
            $response = $this->usagesService->readDetails($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChange(){
        try {
            $uuId="ff7de081-81aa-41f8-91e8-ab93239e25d1";
            $params = [
                "usage" => [
                    "quantity" => "100",
                    "start_time" => "2024-11-04 00:00:00",
                    "end_time" => "2024-11-08 19:58:25"
                ]
            ];

            $response = $this->usagesService->change($uuId,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate(){
        try {
            $uuId="ff7de081-81aa-41f8-91e8-ab93239e25d1";
            $params = [
                "usage" => [
                    "quantity" => "50",
                    "start_time" => "2024-11-04 00:00:00",
                    "end_time" => "2024-11-07 19:58:25"
                ]
            ];

            $response = $this->usagesService->update($uuId,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete(){
        try {
            $uuId="4b2331e2-e8e4-4249-bb7a-2273a8cdaa34";
            $response = $this->usagesService->delete($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$usagesManager = new UsagesManager();
//$usagesManager->testReadAll();
//$usagesManager->testReadDetails();
//$usagesManager->testChange();
//$usagesManager->testUpdate();
//$usagesManager->testDelete();
