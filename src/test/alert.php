<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Alert\AlertData;
use Api\ApiHelper\Config\ConfigManager;

class AlertManager
{
    private $alertService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }

        $apiConfig = new ApiConfig($authCredentialData);
        $this->alertService = new AlertData($apiConfig);
    }

    public function testReadAllAlerts()
    {
        try {
            echo "\n=== Testing: Get All Alerts (Admin) ===\n";

            $queryParams = [
                'limit' => 20,
                'offset' => 0,
                'order_by' => 'created_on',
                'direction' => 'desc'
            ];

            $response = $this->alertService->readAll($queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }

    public function testReadAlertsByAccount()
    {
        $accountId = 'KMS006';

        try {
            echo "\n=== Testing: Get Alerts by Account ({$accountId}) ===\n";

            $queryParams = [
                'limit' => 20,
                'offset' => 0,
                'order_by' => 'created_on',
                'direction' => 'desc'
            ];

            $response = $this->alertService->readByAccount($accountId, $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }

    public function testReadAlertsByLabour()
    {
        $labourId = 'LABOUR-22252846';

        try {
            echo "\n=== Testing: Get Alerts by Labour ({$labourId}) ===\n";

            $queryParams = [
                'limit' => 20,
                'offset' => 0,
                'order_by' => 'created_on',
                'direction' => 'desc'
            ];

            $response = $this->alertService->readByLabour($labourId, $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }

    public function testReadAlertsByEmployee()
    {
        $employeeId = 'EMPLOYEE-51987747';

        try {
            echo "\n=== Testing: Get Alerts by Employee ({$employeeId}) ===\n";

            $queryParams = [
                'limit' => 20,
                'offset' => 0,
                'order_by' => 'created_on',
                'direction' => 'desc'
            ];

            $response = $this->alertService->readByEmployee($employeeId, $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }

    public function runAllTests()
    {
        echo "\n========================================\n";
        echo "   ALERT API ENDPOINT TESTS\n";
        echo "========================================\n";

        $this->testReadAllAlerts();
        $this->testReadAlertsByAccount();
        $this->testReadAlertsByLabour();
        $this->testReadAlertsByEmployee();

        echo "\n========================================\n";
        echo "   ALL TESTS COMPLETED\n";
        echo "========================================\n";
    }
}
