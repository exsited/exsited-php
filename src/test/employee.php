<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Employee\EmployeeData;
use Api\ApiHelper\Config\ConfigManager;

class EmployeeManager
{
    private $employeeService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }

        $apiConfig = new ApiConfig($authCredentialData);
        $this->employeeService = new EmployeeData($apiConfig);
    }

    public function testReadAllEmployee()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=10';
            $response = $this->employeeService->readAllEmployee(null, $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsEmployee()
    {
        $id = '9cbf912c-62fa-43d7-b66c-6781c076b344';
        try {
            $response = $this->employeeService->readDetailsEmployee($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateEmployee()
    {
        $params = [
            "name" => "John Doe",
            "display_name" => "John Doe - Senior Developer",
            "description" => "Senior software developer with 5 years experience",
            "email_address" => "john.doe@company.com",
            "custom_form_template" => "Default for Employee",
            "note" => "New hire starting next month",
            "custom_attributes" => []
        ];

        try {
            $response = $this->employeeService->createEmployee($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateEmployee()
    {
        $params = [
            "code" => "EMP001",
            "name" => "John Doe 2",
            "display_name" => "John Doe - Senior Developer",
            "description" => "Senior software developer with 5 years experience",
            "email_address" => "john.doe@company.com",
            "custom_form_template" => "Default for Employee",
            "note" => "New hire starting next month",
            "custom_attributes" => []
        ];
        $id = 'f3a798f9-e702-4633-828c-66ee4aa1b3ae';
        try {
            $response = $this->employeeService->updateEmployee($params, $id, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeleteEmployee()
    {
        $id = "bccb9cdd-5e74-49c0-a7cf-27c8ecbf048c";
        try {
            $response = $this->employeeService->deleteEmployee($id, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}


//    Test Function Call here

    $employeeManager = new EmployeeManager(0);
    $employeeManager->testReadAllEmployee();
//    $employeeManager->testReadDetailsEmployee();
//    $employeeManager->testCreateEmployee();
//    $employeeManager->testUpdateEmployee();
//    $employeeManager->testDeleteEmployee();
