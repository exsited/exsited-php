<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Workflow\WorkflowData;
use Api\ApiHelper\Config\ConfigManager;

class WorkflowManager
{
    private $workflowService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }

        $apiConfig = new ApiConfig($authCredentialData);
        $this->workflowService = new WorkflowData($apiConfig);
    }

    public function testGetWorkflowDetails()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";

        try {
            $response = $this->workflowService->getWorkflowDetails($componentUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateComponentWithWorkflow()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $params = [
            "Jobs" => [
                "parents" => [
                    [
                        "type" => "account",
                        "id" => "7TIB9E"
                    ]
                ],
                "attributes" => [
                    [
                        "name" => "Job_Title",
                        "value" => "Accountant"
                    ]
                ],
                "workflow_data" => [
                    [
                        "workflow_version_uuid" => "c790c8c3-feca-416e-9d51-a57e2c50f35a",
                        "data" => [
                            [
                                "state_name" => "On Hold",
                                "milestones" => [
                                    [
                                        "id" => "1764045554483",
                                        "start_date" => "",
                                        "end_date" => "",
                                        "name" => "Milestone 1",
                                        "display_name" => "Milestone 1",
                                        "description" => "This is a test milestone",
                                        "assignees" => [
                                            [
                                                "name" => "Administrator",
                                                "email" => "admin@autobill",
                                                "type" => "OPERATOR"
                                            ]
                                        ],
                                        "alerts" => []
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->workflowService->createComponentWithWorkflow($componentUuid, $params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetComponentWithWorkflow()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $componentId = "0LR1G6";

        try {
            $response = $this->workflowService->getComponentWithWorkflow($componentUuid, $componentId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddMilestone()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $componentId = "008139";
        $params = [
            "workflow_data" => [
                [
                    "workflow_version_uuid" => "c790c8c3-feca-416e-9d51-a57e2c50f35a",
                    "data" => [
                        [
                            "state_name" => "On Hold",
                            "milestones" => [
                                [
                                    "id" => "1764",
                                    "start_date" => "30-10-2025",
                                    "end_date" => "05-11-2025",
                                    "name" => "New Added Milestone",
                                    "display_name" => "New Added Milestone",
                                    "description" => "This is a test milestone",
                                    "assignees" => [
                                        [
                                            "name" => "Administrator",
                                            "email" => "admin@autobill",
                                            "type" => "OPERATOR"
                                        ]
                                    ],
                                    "alerts" => []
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->workflowService->addMilestone($componentUuid, $componentId, $params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetMilestones()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $componentRecordId = "0LR1G6";
        $workflowVersionUuid = "c790c8c3-feca-416e-9d51-a57e2c50f35a";

        try {
            $response = $this->workflowService->getMilestones($componentUuid, $componentRecordId, $workflowVersionUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetMilestoneDetails()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $componentId = "0LR1G6";
        $workflowVersionUuid = "c790c8c3-feca-416e-9d51-a57e2c50f35a";
        $milestoneUuid = "milestone-uuid-here";

        try {
            $response = $this->workflowService->getMilestoneDetails($componentUuid, $componentId, $workflowVersionUuid, $milestoneUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateAlertResponsibility()
    {
        $params = [
            "name" => "Plumber",
            "display_name" => "Plumber",
            "add_description" => "true",
            "description" => "Test Description"
        ];

        try {
            $response = $this->workflowService->createAlertResponsibility($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetAlertResponsibilities()
    {
        try {
            $response = $this->workflowService->getAlertResponsibilities();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetAlertResponsibilityDetails()
    {
        $alertResponsibilityUuid = "f1110387-d3fe-4f94-aad2-534012a0fcb9";

        try {
            $response = $this->workflowService->getAlertResponsibilityDetails($alertResponsibilityUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetWorkflowDefinition()
    {
        $workflowVersionUuid = "c790c8c3-feca-416e-9d51-a57e2c50f35a";

        try {
            $response = $this->workflowService->getWorkflowDefinition($workflowVersionUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$workflowManager = new WorkflowManager(1);

//$workflowManager->testGetWorkflowDetails();
//$workflowManager->testCreateComponentWithWorkflow();
$workflowManager->testGetComponentWithWorkflow();
//$workflowManager->testAddMilestone();
//$workflowManager->testGetMilestones();
//$workflowManager->testGetMilestoneDetails();
//$workflowManager->testCreateAlertResponsibility();
//$workflowManager->testGetAlertResponsibilities();
//$workflowManager->testGetAlertResponsibilityDetails();
//$workflowManager->testGetWorkflowDefinition();
