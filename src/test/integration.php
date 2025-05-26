<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Integration\IntegrationData;
use Api\ApiHelper\Config\ConfigManager;

class IntegrationManager
{
    private $integrationService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->integrationService = new IntegrationData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->integrationService->readAll('v2');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreate()
    {
        $params = [
            "provider" => "XERO",
            "remote_instance_id" => "dummy-tenant-id-001",
            "remote_instance_code" => "TENANT-XYZ",
            "remote_instance_name" => "Xero Test Company",
            "remote_instance_display" => "Xero Test Company (dummy-tenant-id-001)",

            "integration_client_id" => "dummy-client-id",
            "integration_client_secret" => "dummy-client-secret",

            "integration_access_token" => "dummy-access-token",
            "integration_refresh_token" => "dummy-refresh-token",
            "token_type" => "Bearer",
            "expires_in" => "2026-01-01",

            "account_server" => "https://api.xero.com",
            "api_domain" => "https://api.xero.com",

            "supporting_fields" => json_encode([
                "region" => "US",
                "tax" => "NONE"
            ]),

            "user_name" => "test_user",
            "user_password" => "test_password",

            "require_authentication" => true,
            "state" => "development",

            "company_file" => "00000000-0000-0000-0000-000000000000",
            "company_name" => "Demo Bitmascot"
        ];


        try {
            $response = $this->integrationService->create($params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $uuid = '4cd91ef3-c995-4312-b839-a995065d5f96';
        try {
            $response = $this->integrationService->delete($uuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testEnable()
    {
        $uuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        try {
            $response = $this->integrationService->enable($uuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDisable()
    {
        $uuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        try {
            $response = $this->integrationService->disable($uuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$integrationManager = new IntegrationManager();
//$integrationManager->testReadAll();
//$integrationManager->testCreate();
//$integrationManager->testDelete();
//$integrationManager->testEnable();
//$integrationManager->testDisable();