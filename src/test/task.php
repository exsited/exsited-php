<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Task\TaskData;
use Api\ApiHelper\Config\ConfigManager;

class TaskManager
{
    private $taskService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }

        $apiConfig = new ApiConfig($authCredentialData);
        $this->taskService = new TaskData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=10';
            $response = $this->taskService->readAll('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id = 'f99296fd-6d5d-4597-9fc1-55179f828e8b';
        try {
            $response = $this->taskService->readDetails($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadChecklist()
    {
        $id = 'f99296fd-6d5d-4597-9fc1-55179f828e8b';
        try {
            $response = $this->taskService->readChecklist($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreate()
    {
        $payload = [
            'task' => [
                'code' => 'WT-005',
                'name' => 'xxxxxxxxxxxxx',
                'display_name' => 'John Doe - Senior Developer',
                'description' => 'Senior software developer with 5 years experience',
                'sort_order' => 111,
                'estimated_hours' => '02:30:00',
                'actual_hours' => '3600',
                'start_after' => '2cc50eee-4417-40d2-b1ad-cae3a0efdcf5',
                'priority' => 'MEDIUM',
                'task_status' => 'COMPLETED',
                'start_date' => '2026-03-14',
                'end_date' => '2026-03-20',
                'note' => 'New hire starting next month',
                'workflow_milestone' => '2126e0c7-249c-46a0-b473-0f83d90a3283',
                'entity' => 'customComponentObject',
                'resource_id' => '5e731afe-46b2-4b0e-8490-497287577c81',
                'parent_task' => '2cc50eee-4417-40d2-b1ad-cae3a0efdcf5',
                'checklist' => [
                    [
                        'name' => 'Checklist Item 1',
                        'display_name' => 'Checklist Display 1',
                        'description' => 'Checklist description',
                        'status' => 'COMPLETED',
                        'sort_order' => 100,
                        'custom_attributes' => [
                            ['name' => 'check_number', 'value' => '222']
                        ]
                    ],
                    [
                        'name' => 'Send email',
                        'display_name' => 'Send Email',
                        'description' => 'Notify stakeholders',
                        'sort_order' => 2,
                        'custom_attributes' => [
                            ['name' => 'check_number', 'value' => '122']
                        ]
                    ]
                ],
                'assignees' => [
                    ['type' => 'LABOUR', 'labour_code' => 'LABOUR-71787317']
                ],
                'alerts' => [
                    [
                        'name' => 'Alert 1',
                        'display_name' => 'Alert 1',
                        'description' => '',
                        'time_interval' => [
                            'trigger' => 'after',
                            'trigger_value' => 5,
                            'trigger_unit' => 'hour'
                        ],
                        'notification_option' => 'In-app Notification',
                        'email_html' => '',
                        'selected_labours' => [
                            ['labour_code' => 'LABOUR-71787317']
                        ]
                    ]
                ],
                'custom_attributes' => [
                    ['name' => 'Task_Number', 'value' => '135124773']
                ]
            ]
        ];

        try {
            $response = $this->taskService->create($payload);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateChecklist()
    {
        $id = 'f99296fd-6d5d-4597-9fc1-55179f828e8b';
        $payload = [
            'checklist' => [
                [
                    'name' => 'Review document335656',
                    'display_name' => 'Review Doc',
                    'description' => 'Review the final document',
                    'status' => 'PENDING',
                    'sort_order' => 1,
                    'custom_attributes' => [
                        ['name' => 'check_number', 'value' => '222']
                    ]
                ],
                [
                    'name' => 'Send email115651',
                    'display_name' => 'Send Email',
                    'description' => 'Notify stakeholders',
                    'custom_attributes' => [
                        ['name' => 'check_number', 'value' => '222']
                    ]
                ]
            ]
        ];

        try {
            $response = $this->taskService->createChecklist($id, $payload);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate()
    {
        $id = 'f99296fd-6d5d-4597-9fc1-55179f828e8b';
        $payload = [
            'task' => [
                'display_name' => 'John Doe - Lead Developer',
                'priority' => 'HIGH',
                'task_status' => 'IN_PROGRESS'
            ]
        ];

        try {
            $response = $this->taskService->update($id, $payload);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateChecklist()
    {
        $id = 'f99296fd-6d5d-4597-9fc1-55179f828e8b';
        $checklistId = '922a256e-62e5-4adc-86e6-3dbb5930c899';
        $payload = [
            'checklist' => [
                'status' => 'COMPLETED',
                'display_name' => 'Send Email Updated'
            ]
        ];

        try {
            $response = $this->taskService->updateChecklist($id, $checklistId, $payload);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id = 'f99296fd-6d5d-4597-9fc1-55179f828e8b';
        try {
            $response = $this->taskService->delete($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeleteChecklist()
    {
        $id = 'f99296fd-6d5d-4597-9fc1-55179f828e8b';
        $checklistId = '922a256e-62e5-4adc-86e6-3dbb5930c899';
        try {
            $response = $this->taskService->deleteChecklist($id, $checklistId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$taskManager = new TaskManager(0);

echo "<h2>Test: Read All Tasks</h2>";
$taskManager->testReadAll();

echo "<h2>Test: Read Task Details</h2>";
$taskManager->testReadDetails();

echo "<h2>Test: Read Checklist</h2>";
$taskManager->testReadChecklist();

echo "<h2>Test: Create Task</h2>";
$taskManager->testCreate();

echo "<h2>Test: Create Checklist</h2>";
$taskManager->testCreateChecklist();

echo "<h2>Test: Update Task</h2>";
$taskManager->testUpdate();

echo "<h2>Test: Update Checklist Item</h2>";
$taskManager->testUpdateChecklist();

echo "<h2>Test: Delete Checklist Item</h2>";
$taskManager->testDeleteChecklist();

echo "<h2>Test: Delete Task</h2>";
$taskManager->testDelete();
