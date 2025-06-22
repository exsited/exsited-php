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
    public function testRead()
    {
        $uuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        try {
            $response = $this->integrationService->read($uuid,'v2');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPartner()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        try {
            $response = $this->integrationService->readPartner($integrationUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPartnerDetails()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        $partnerUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec5e';
        try {
            $response = $this->integrationService->readPartnerDetails($integrationUuid, $partnerUuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAutomation()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        try {
            $response = $this->integrationService->readAutomation($integrationUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAutomationDetails()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        $automationUuid = '922ffe4a-439f-4b1c-b671-d4387b42ec5e';
        try {
            $response = $this->integrationService->readAutomationDetails($integrationUuid, $automationUuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatePartnerFunction()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        $params = [
            "partner_function" => [
                "name" => "NAME",
                "direction" => "IMPORT", // IMPORT or EXPORT
                "description" => "Description",
                "object_name" => "customer",
                "object_mapping" => "customer_customer",
                "event_name" => "update",
                "tag" => "import_only_inventory"
            ]
        ];

        try {
            $response = $this->integrationService->createPartnerFunction($integrationUuid, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateConfiguration()
    {
        $uuid = '4cd91ef3-c995-4312-b839-a995065d5f96';
        $params = [
            "account" => [
                "export" => [
                    "enabled" => "true",
                    "default_account_receivable" => "Sales",
                    "account_receivable_mapping" => [
                        "enabled" => "true",
                        "mappings" => [
                            [
                                "source" => "Account Receivable",
                                "target" => "Other Revenue"
                            ],
                            [
                                "source" => "ACC Receivable 2",
                                "target" => "Other Revenue"
                            ]
                        ]
                    ],
                    "default_account_payable" => "Sales",
                    "account_payable_mapping" => [
                        "enabled" => "true",
                        "mappings" => [
                            [
                                "source" => "Account Payable",
                                "target" => "Other Revenue"
                            ],
                            [
                                "source" => "Acc Payable 2",
                                "target" => "Other Revenue"
                            ]
                        ]
                    ],
                    "default_tax" => null,
                    "tax_mapping" => [
                        "enabled" => "false",
                        "mappings" => []
                    ],
                    "xero_account_number_field" => "assigned_by_xero",
                    "sync_to_xero" => "true"
                ],
                "import" => [
                    "enabled" => "true",
                    "default_account_receivable" => "Account Receivable",
                    "account_receivable_mapping" => [
                        "enabled" => "true",
                        "mappings" => [
                            [
                                "source" => "Sales",
                                "target" => "ACC Receivable 2"
                            ],
                            [
                                "source" => "Other Revenue",
                                "target" => "ACC Receivable 2"
                            ]
                        ]
                    ],
                    "default_account_payable" => "Acc Payable 2",
                    "account_payable_mapping" => [
                        "enabled" => "true",
                        "mappings" => [
                            [
                                "source" => "Cleaning",
                                "target" => "Acc Payable 2"
                            ],
                            [
                                "source" => "Depreciation",
                                "target" => "Acc Payable 2"
                            ]
                        ]
                    ],
                    "default_tax" => null,
                    "tax_mapping" => [
                        "enabled" => "false",
                        "mappings" => []
                    ],
                    "xero_account_id_field" => "assigned_by_exsited"
                ]
            ]
        ];

        try {
            $response = $this->integrationService->updateConfiguration($uuid, $params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdatePartnerDetails()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        $partnerUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec5e';
        $params = [
            "partner_function" => [
                "name" => "NAME",
                "direction" => "IMPORT", // IMPORT or EXPORT
                "description" => "Description",
                "object_name" => "customer",
                "object_mapping" => "customer_customer",
                "event_name" => "update",
                "tag" => "import_only_inventory"
            ]
        ];

        try {
            $response = $this->integrationService->updatePartnerDetails($integrationUuid, $partnerUuid, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeletePartnerDetails()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        $partnerUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec5e';

        try {
            $response = $this->integrationService->deletePartnerDetails($integrationUuid, $partnerUuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCheckConnection()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        try {
            $response = $this->integrationService->checkConnection($integrationUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAutomationDisable()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        $automationUuid = '922ffe4a-439f-4b1c-b671-d4387b42ec5e';
        try {
            $response = $this->integrationService->automationDisable($integrationUuid, $automationUuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testAutomationEnable()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        $automationUuid = '922ffe4a-439f-4b1c-b671-d4387b42ec5e';
        try {
            $response = $this->integrationService->automationEnable($integrationUuid, $automationUuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddAutomation()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        $params = [
            "integration" => [
                "automation_details" => [
                    "name" => "Test auto 6",
                    "display_name" => "Test auto 1",
                    "code" => "test2",
                    "description_enabled" => "true",
                    "description" => "checking89",
                    "another_automation" => "Automation four",
                    "applies_to" => "supplier",
                    "applies_to_function" => "new",
                    "automation_type" => "timerBased",
                    "direction" => "IMPORT",
                    "check_on" => "8 hours", // customDayTime
                    // "custom_day" => "thursday",
                    // "custom_time" => "06:45:23",
                    "do_not_over_write_latest_data" => "true",
                    "ignore_threshold" => "1",
                    "perform_action" => "partner function 2",
                    "since_last_look_up" => "true",
                    "additional_criteria" => "true",
                    "property_name" => ""
                ]
            ]
        ];

        try {
            $response = $this->integrationService->addAutomation($integrationUuid, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function testUpdateAutomation()
    {
        $integrationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        $automationUuid = '922ffe4a-439f-4b1c-b671-d4387b42ec5e';
        $params = [
            "integration" => [
                "automation_details" => [
                    // "name" => "Edited auto2",
                    // "display_name" => "Automation three",
                    // "code" => "Code123",
                    // "description_enabled" => "True",
                    // "description" => "description added",
                    // "another_automation" => "",
                    // "applies_to" => "supplier",
                    // "applies_to_function" => "new",
                    // "automation_type" => "timerBased",
                    // "check_on" => "4 hours", // customDayTime
                    // // "custom_day" => "thursday",
                    // // "custom_time" => "06:45:23",
                    // "direction" => "EXPORT",
                    // "do_not_over_write_latest_data" => "true",
                    // "ignore_threshold" => "2",
                    // "perform_action" => "Partner function1",
                    // "since_last_look_up" => "true",
                    // "additional_criteria" => "true",
                    // "property_name" => ""
                ],
                "additional_criteria_details" => [
                    [
                        "group_condition" => "AND",
                        "rules" => [
                            [
                                "field_name" => "Account Number",
                                "operator" => "CONTAINS",
                                "value" => "1",
                                "condition" => "AND"
                            ]
                        ]
                    ],
                    [
                        "group_condition" => "OR",
                        "rules" => [
                            [
                                "field_name" => "Accounts Payable Tax Type",
                                "operator" => "HAS_VALUE",
                                "condition" => "OR"
                            ],
                            [
                                "field_name" => "Accounts Receivable Tax Type",
                                "operator" => "CONTAINS",
                                "value" => "@yopmail.com",
                                "condition" => "AND"
                            ]
                        ]
                    ],
                    [
                        "group_condition" => "AND",
                        "rules" => [
                            [
                                "field_name" => "Contact ID",
                                "operator" => "DOES_NOT_HAVE_VALUE",
                                "condition" => "AND"
                            ],
                            [
                                "field_name" => "Bank Account Details",
                                "operator" => "EQUALS",
                                "value" => "429",
                                "condition" => "AND"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->integrationService->updateAutomation($integrationUuid,$automationUuid, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function testDeleteAutomation()
    {
        $automationUuid = '922ffe4a-439f-4b1c-b671-d4387bc2ec59';
        try {
            $response = $this->integrationService->deleteAutomation($automationUuid,'v3');
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
//$integrationManager->testRead();
//$integrationManager->testReadPartner();
//$integrationManager->testReadPartnerDetails();
//$integrationManager->testReadAutomation();
//$integrationManager->testReadAutomationDetails();
//$integrationManager->testCreatePartnerFunction();
//$integrationManager->testUpdateConfiguration();
//$integrationManager->testUpdatePartnerDetails();
//$integrationManager->testDeletePartnerDetails();
//$integrationManager->testCheckConnection();
//$integrationManager->testAutomationDisable();
//$integrationManager->testAddAutomation();
//$integrationManager->testUpdateAutomation();
//$integrationManager->testDeleteAutomation();
//$integrationManager->testReadConfiguration();
//$integrationManager->testEnablePartnerDetails();
//$integrationManager->testDisablePartnerDetails();




