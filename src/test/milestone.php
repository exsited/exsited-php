<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Milestone\MilestoneData;
use Api\ApiHelper\Config\ConfigManager;

class MilestoneManager
{
    private $milestoneService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->milestoneService = new MilestoneData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=10';
            $response = $this->milestoneService->readAll('v2', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadByAccount()
    {
        $accountId = 'XDTMZ1'; // Replace with actual account ID
        try {
            $queryParams = '?limit=20&offset=0';
            $response = $this->milestoneService->readByAccount($accountId, 'v2', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadByLabour()
    {
        $labourId = 'LABOUR-40498201'; // Replace with actual labour ID
        try {
            $queryParams = '?limit=20&offset=0';
            $response = $this->milestoneService->readByLabour($labourId, 'v2', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadByEmployee()
    {
        $employeeId = 'EMP-001'; // Replace with actual employee ID
        try {
            $queryParams = '?limit=20&offset=0';
            $response = $this->milestoneService->readByEmployee($employeeId, 'v2', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$milestoneManager = new MilestoneManager(0);

echo "<h2>Test: Read All Milestones</h2>";
$milestoneManager->testReadAll();

echo "<h2>Test: Read Milestones by Account</h2>";
$milestoneManager->testReadByAccount();

echo "<h2>Test: Read Milestones by Labour</h2>";
$milestoneManager->testReadByLabour();

echo "<h2>Test: Read Milestones by Employee</h2>";
$milestoneManager->testReadByEmployee();
