<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Timesheet\TimesheetData;
use Api\ApiHelper\Config\ConfigManager;

class TimesheetManager
{
    private $timesheetService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->timesheetService = new TimesheetData($apiConfig);
    }

    public function testReadAll(){
        try {
            $response = $this->timesheetService->readAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails(){
        try {
            $uuId = "051cc9b4-88a1-41a1-bc88-e90651f7f5a1";
            $response = $this->timesheetService->readDetails($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreate(){
        try {
            $params = [
                "timesheet" => [
                    "sale_order_item" => "727a6cd8-1b4e-4bab-90af-addf8eabacb5",
                    "start_time" => "2025-12-30 03:05",
                    "end_time" => "2025-12-30 04:00",
                    "custom_attributes" => [
                        // [
                        //     "name" => "Custom_Attribute_String",
                        //     "value" => "abc"
                        // ]
                    ]
                ]
            ];

            $response = $this->timesheetService->create($params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate(){
        try {
            $uuId = "051cc9b4-88a1-41a1-bc88-e90651f7f5a1";
            $params = [
                "timesheet" => [
                    "start_time" => "2025-12-30 03:05",
                    "end_time" => "2025-12-30 04:00",
                    "custom_attributes" => [
                        // [
                        //     "name" => "Custom_Attribute_String",
                        //     "value" => "abc"
                        // ]
                    ]
                ]
            ];

            $response = $this->timesheetService->update($uuId,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete(){
        try {
            $uuId = "504a9f2e-4f55-485d-8112-f463209fe5ea";
            $response = $this->timesheetService->delete($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$timesheetManager = new TimesheetManager();
//$timesheetManager->testReadAll();
//$timesheetManager->testReadDetails();
//$timesheetManager->testCreate();
//$timesheetManager->testUpdate();
//$timesheetManager->testDelete();

