<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Workflow\WorkflowData;
use Api\ApiHelper\Config\ConfigManager;

class WorkflowMilestoneManager
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

    public function testGetWorkflowDetails($componentUuid)
    {
        try {
            echo "\n=== Testing Get Workflow Details ===\n";
            echo "Component UUID: {$componentUuid}\n";
            $response = $this->workflowService->getWorkflowDetails($componentUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateComponentWithWorkflow($componentUuid)
    {
        try {
            echo "\n=== Testing Create Custom Component with Milestone ===\n";
            echo "Component UUID: {$componentUuid}\n";

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
                            "value" => "Test Job " . time()
                        ]
                    ]
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->workflowService->createComponentWithWorkflow($componentUuid, $params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetComponentWithWorkflow($componentUuid, $componentId)
    {
        try {
            echo "\n=== Testing Get Custom Component Details with Workflow ===\n";
            echo "Component UUID: {$componentUuid}\n";
            echo "Component ID: {$componentId}\n";
            $response = $this->workflowService->getComponentWithWorkflow($componentUuid, $componentId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddMilestone($componentUuid, $componentId)
    {
        try {
            echo "\n=== Testing Add Single Milestone ===\n";
            echo "Component UUID: {$componentUuid}\n";
            echo "Component ID: {$componentId}\n";

            $params = [
                "workflow_data" => [
                    [
                        "workflow_uuid" => "e7989e7d-1f85-4d1b-bd7d-95659a6c028a",
                        "data" => [
                            [
                                "state_name" => "On Hold",
                                "milestones" => [
                                    [
                                        "start_date" => date('d-m-Y'),
                                        "end_date" => date('d-m-Y', strtotime('+7 days')),
                                        "name" => "Test Milestone " . time(),
                                        "description" => "Created via SDK test",
                                        "assignees" => [
                                            [
                                                "name" => "Administrator",
                                                "email" => "admin@autobill",
                                                "type" => "OPERATOR"
                                            ]
                                        ],
                                        "alerts" => [
                                            [
                                                "name" => "Test Alert",
                                                "display_name" => "Test Alert",
                                                "description" => "Test alert description",
                                                "time_interval" => [
                                                    "trigger" => "after",
                                                    "trigger_value" => 5,
                                                    "trigger_unit" => "hour"
                                                ],
                                                "notification_option" => "In-app Notification",
                                                "email_html" => "",
                                                "selected_operators" => []
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->workflowService->addMilestone($componentUuid, $componentId, $params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateMilestone($componentUuid, $componentId, $milestoneUuid)
    {
        try {
            echo "\n=== Testing Update Milestone ===\n";
            echo "Component UUID: {$componentUuid}\n";
            echo "Component ID: {$componentId}\n";
            echo "Milestone UUID: {$milestoneUuid}\n";

            $params = [
                "workflow_data" => [
                    [
                        "data" => [
                            [
                                "state_name" => "On Hold",
                                "milestones" => [
                                    [
                                        "uuid" => $milestoneUuid,
                                        "name" => "Updated Milestone " . time(),
                                        "description" => "Updated via SDK test on " . date('Y-m-d H:i:s')
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->workflowService->updateMilestone($componentUuid, $componentId, $params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetAllMilestones($componentUuid, $componentId, $queryParams = null)
    {
        try {
            echo "\n=== Testing Get All Milestones ===\n";
            echo "Component UUID: {$componentUuid}\n";
            echo "Component ID: {$componentId}\n";
            if ($queryParams) {
                echo "Query Parameters:\n";
                echo '<pre>' . json_encode($queryParams, JSON_PRETTY_PRINT) . '</pre>';
            }

            $response = $this->workflowService->getMilestones($componentUuid, $componentId, $queryParams);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetMilestoneDetails($componentUuid, $componentId, $milestoneUuid)
    {
        try {
            echo "\n=== Testing Get Single Milestone Details ===\n";
            echo "Component UUID: {$componentUuid}\n";
            echo "Component ID: {$componentId}\n";
            echo "Milestone UUID: {$milestoneUuid}\n";

            $response = $this->workflowService->getMilestoneDetails($componentUuid, $componentId, $milestoneUuid);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateAlertResponsibility()
    {
        try {
            echo "\n=== Testing Create Alert Responsibility ===\n";

            $params = [
                "name" => "Test Role " . time(),
                "display_name" => "Test Role Display",
                "add_description" => "true",
                "description" => "Created via SDK test"
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->workflowService->createAlertResponsibility($params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetAlertResponsibilities()
    {
        try {
            echo "\n=== Testing Get All Alert Responsibilities ===\n";
            $response = $this->workflowService->getAlertResponsibilities();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetAlertResponsibilityDetails($alertResponsibilityUuid)
    {
        try {
            echo "\n=== Testing Get Alert Responsibility Details ===\n";
            echo "Alert Responsibility UUID: {$alertResponsibilityUuid}\n";
            $response = $this->workflowService->getAlertResponsibilityDetails($alertResponsibilityUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetWorkflowDefinition($workflowVersionUuid)
    {
        try {
            echo "\n=== Testing Get Workflow Definition ===\n";
            echo "Workflow Version UUID: {$workflowVersionUuid}\n";
            $response = $this->workflowService->getWorkflowDefinition($workflowVersionUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCompleteWorkflow()
    {
        try {
            echo "\n========================================\n";
            echo "=== COMPLETE WORKFLOW TEST ===\n";
            echo "========================================\n";

            $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";

            echo "\n1. Creating custom component with workflow...\n";
            $createParams = [
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
                            "value" => "Workflow Test Job " . time()
                        ]
                    ]
                ]
            ];
            $createResponse = $this->workflowService->createComponentWithWorkflow($componentUuid, $createParams);

            $componentId = null;
            if (isset($createResponse['Jobs']['id'])) {
                $componentId = $createResponse['Jobs']['id'];
            }

            if (!$componentId) {
                throw new Exception("Failed to extract component ID from create response");
            }
            echo "✓ Created component with ID: {$componentId}\n";

            echo "\n2. Getting component details with workflow...\n";
            $this->workflowService->getComponentWithWorkflow($componentUuid, $componentId);
            echo "✓ Retrieved component details\n";

            echo "\n3. Adding milestone...\n";
            $milestoneParams = [
                "workflow_data" => [
                    [
                        "workflow_uuid" => "e7989e7d-1f85-4d1b-bd7d-95659a6c028a",
                        "data" => [
                            [
                                "state_name" => "On Hold",
                                "milestones" => [
                                    [
                                        "start_date" => date('d-m-Y'),
                                        "end_date" => date('d-m-Y', strtotime('+7 days')),
                                        "name" => "Complete Workflow Test Milestone",
                                        "description" => "Created for complete workflow test",
                                        "assignees" => []
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
            $milestoneResponse = $this->workflowService->addMilestone($componentUuid, $componentId, $milestoneParams);

            $milestoneUuid = null;
            if (isset($milestoneResponse['all_milestones'][0]['milestones'][0]['uuid'])) {
                $milestoneUuid = $milestoneResponse['all_milestones'][0]['milestones'][0]['uuid'];
            }

            if (!$milestoneUuid) {
                throw new Exception("Failed to extract milestone UUID from create response");
            }
            echo "✓ Created milestone with UUID: {$milestoneUuid}\n";

            echo "\n4. Updating milestone...\n";
            $updateParams = [
                "workflow_data" => [
                    [
                        "data" => [
                            [
                                "state_name" => "On Hold",
                                "milestones" => [
                                    [
                                        "uuid" => $milestoneUuid,
                                        "description" => "Updated in complete workflow test"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
            $this->workflowService->updateMilestone($componentUuid, $componentId, $updateParams);
            echo "✓ Updated milestone successfully\n";

            echo "\n5. Getting all milestones...\n";
            $this->workflowService->getMilestones($componentUuid, $componentId, ['limit' => 10]);
            echo "✓ Retrieved milestones list\n";

            echo "\n6. Getting milestone details...\n";
            $this->workflowService->getMilestoneDetails($componentUuid, $componentId, $milestoneUuid);
            echo "✓ Retrieved milestone details\n";

            echo "\n========================================\n";
            echo "=== WORKFLOW TEST COMPLETED ===\n";
            echo "========================================\n";

        } catch (Exception $e) {
            echo "\n❌ Workflow Test Failed: " . $e->getMessage() . "\n";
        }
    }
}

$manager = new WorkflowMilestoneManager();

echo "\n\n=== Workflow & Milestone Services Test File ===\n";
echo "Uncomment the test methods you want to run.\n\n";
echo "Available tests:\n";
echo "  Workflow Tests:\n";
echo "    - testGetWorkflowDetails(\$componentUuid)\n";
echo "    - testCreateComponentWithWorkflow(\$componentUuid)\n";
echo "    - testGetComponentWithWorkflow(\$componentUuid, \$componentId)\n";
echo "    - testGetWorkflowDefinition(\$workflowVersionUuid)\n\n";
echo "  Milestone Tests:\n";
echo "    - testAddMilestone(\$componentUuid, \$componentId)\n";
echo "    - testUpdateMilestone(\$componentUuid, \$componentId, \$milestoneUuid)\n";
echo "    - testGetAllMilestones(\$componentUuid, \$componentId, \$params)\n";
echo "    - testGetMilestoneDetails(\$componentUuid, \$componentId, \$milestoneUuid)\n\n";
echo "  Alert Responsibility Tests:\n";
echo "    - testCreateAlertResponsibility()\n";
echo "    - testGetAlertResponsibilities()\n";
echo "    - testGetAlertResponsibilityDetails(\$alertResponsibilityUuid)\n\n";
echo "  Complete Workflow:\n";
echo "    - testCompleteWorkflow()\n\n";
