<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\CustomComponent\CustomComponentData;
use Api\ApiHelper\Config\ConfigManager;

class CustomComponentManager
{
    private $customComponentService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->customComponentService = new CustomComponentData($apiConfig);
    }

    public function testCreate()
    {
        $params = [
            "acc_cus_com" => [
                "parents" => [
                    [
                        "type" => "account",
                        "id" => "76GOU2"
                    ]
                ]
            ]
        ];

        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";

        try {
            $response = $this->customComponentService->create($componentUuid, $params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAll()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";

        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=2';
            $response = $this->customComponentService->readAll($componentUuid, 'v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id = "H3VBFG";
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";

        try {
            $response = $this->customComponentService->readAllDetails($componentUuid, $id, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateWithAttributeGroup()
    {
        $params = [
            "acc_cus_com" => [
                "parents" => [
                    [
                        "type" => "account",
                        "id" => "76GOU2"
                    ]
                ],
                "attributes" => [
                    [
                        "name" => "ADGROUP",
                        "value" => "anything"
                    ],
                    [
                        "name" => "Card_ID",
                        "value" => "1234"
                    ]
                ],
                "attribute_groups" => [
                    [
                        "name" => "group1",
                        "attributes" => [
                            [
                                "name" => "ADGROUP",
                                "value" => "anything"
                            ],
                            [
                                "name" => "CAMPAIGN",
                                "value" => "anything"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";

        try {
            $response = $this->customComponentService->createWithAttributeGroup($componentUuid, $params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountAllComponent()
    {
        $accountId = "76GOU2";
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";

        try {
            $response = $this->customComponentService->readAccountAllComponent($componentUuid, $accountId, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountComponent()
    {
        $accountId = "76GOU2";
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "4R216I";

        try {
            $response = $this->customComponentService->readAccountComponent($componentUuid, $accountId, $id, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testChange()
    {
        $id = "Q6IHEO";
        $componentUuid = "f";
        $params = [
            "acc_cus_com" => [
                "parents" => [
                    [
                        "type" => "account",
                        "id" => "76GOU2"
                    ]
                ],
                "attributes" => [
                    [
                        "name" => "ADGROUP",
                        "value" => "change ADGRRUP Att"
                    ],
                    [
                        "name" => "Card_ID",
                        "value" => "12345"
                    ]
                ],
                "attribute_groups" => [
                    [
                        "name" => "group1",
                        "attributes" => [
                            [
                                "name" => "ADGROUP",
                                "value" => "change anything group attribute"
                            ],
                            [
                                "name" => "CAMPAIGN",
                                "value" => "change anything group attribute"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->customComponentService->change($componentUuid, $id, $params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id = "9DQXQ6";
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";

        try {
            $response = $this->customComponentService->delete($componentUuid, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetComponentPdf()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $id = "IT3T9L";

        try {
            $response = $this->customComponentService->getComponentPdf($componentUuid, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAllComponentNotes()
    {
        $componentUuid = "2dae0241-fed5-4703-bf77-34f6cbadd0f1";
        $id = "9MHIAD";

        try {
            $response = $this->customComponentService->readAllComponentNotes($componentUuid, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadComponentNoteDetails()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "Q6IHEO";
        $noteUuid = "note-uuid-here";

        try {
            $response = $this->customComponentService->readComponentNoteDetails($componentUuid, $id, $noteUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddComponentNote()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "Q6IHEO";
        $note = "This is a test note for the custom component";

        try {
            $response = $this->customComponentService->addComponentNote($componentUuid, $id, $note);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddComponentNoteWithFile()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "Q6IHEO";
        $note = "This is a test note with file attachment";
        $filePath = "/path/to/your/test/file.pdf";

        try {
            $response = $this->customComponentService->addComponentNote($componentUuid, $id, $note, $filePath);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeleteComponentNote()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "Q6IHEO";
        $noteUuid = "note-uuid-here";

        try {
            $response = $this->customComponentService->deleteComponentNote($componentUuid, $id, $noteUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadComponentNoteFiles()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "Q6IHEO";
        $noteUuid = "note-uuid-here";

        try {
            $response = $this->customComponentService->readComponentNoteFiles($componentUuid, $id, $noteUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadComponentNoteFileDetails()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "Q6IHEO";
        $noteUuid = "note-uuid-here";
        $fileUuid = "file-uuid-here";

        try {
            $response = $this->customComponentService->readComponentNoteFileDetails($componentUuid, $id, $noteUuid, $fileUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testChangeComponentStatus()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "Q6IHEO";
        $params = [
            "status" => "active",
            "reason" => "Status change test"
        ];

        try {
            $response = $this->customComponentService->changeComponentStatus($componentUuid, $id, $params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateComponentActivity()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "Q6IHEO";
        $params = [
            "activity_type" => "comment",
            "description" => "Test activity creation",
            "timestamp" => date('c')
        ];

        try {
            $response = $this->customComponentService->createComponentActivity($componentUuid, $id, $params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadComponentActivities()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "Q6IHEO";

        try {
            $response = $this->customComponentService->readComponentActivities($componentUuid, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadComponentActivityDetails()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";
        $id = "Q6IHEO";
        $activityUuid = "activity-uuid-here";

        try {
            $response = $this->customComponentService->readComponentActivityDetails($componentUuid, $id, $activityUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLinkDomains()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $params = [
            "id" => "H3VBFG",
            "domain_type" => "sale_order",
            "domains" => [
                ["domain_id" => "ORD-F42UC2-0728"],
                ["domain_id" => "ORD-MI77U4-0724"]
            ]
        ];

        try {
            $response = $this->customComponentService->linkDomains($componentUuid, $params, 'v2');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateLinkDomains()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $params = [
            "id" => "H3VBFG",
            "domain_type" => "sale_order",
            "domains" => [
                ["domain_id" => "ORD-6Q5YEN-0744"]
            ]
        ];

        try {
            $response = $this->customComponentService->updateLinkDomains($componentUuid, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUnlinkDomains()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $params = [
            "id" => "H3VBFG",
            "domain_type" => "sale_order",
            "domains" => [
                ["domain_id" => "ORD-F42UC2-0728"],
                ["domain_id" => "ORD-MI77U4-0724"]
            ]
        ];

        try {
            $response = $this->customComponentService->unlinkDomains($componentUuid, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeleteCustomObjects()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $id = "Z5MSF3";

        try {
            $response = $this->customComponentService->deleteCustomObjects($componentUuid, $id, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateExpress()
    {
        $componentUuid = "90af8c6c-3f70-4e7a-a4d0-6e9995956969";
        $id = "PV8KUJ";
        $params = [
            "Jobs" => [
                "attributes" => [
                    ["name" => "note_group_uuid", "value" => "70e022c6-3482-4d89-91b5-0f447f3308c5"],
                    ["name" => "Job_Title", "value" => "Henry's window"],
                    ["name" => "Job_Description", "value" => ""],
                    ["name" => "Assigned_Operators", "value" => "EMPLOYEE-52523409"],
                    ["name" => "Start_Date", "value" => ""],
                    ["name" => "Due_Date", "value" => ""],
                    ["name" => "Priority", "value" => ""],
                    ["name" => "Attachment", "value" => []]
                ]
            ]
        ];

        try {
            $response = $this->customComponentService->updateExpress($componentUuid, $id, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$customComponentManager = new CustomComponentManager();

//$customComponentManager->testCreate();
//$customComponentManager->testReadAll();
//$customComponentManager->testReadDetails();
//$customComponentManager->testCreateWithAttributeGroup();
//$customComponentManager->testReadAccountAllComponent();
//$customComponentManager->testReadAccountComponent();
//$customComponentManager->testChange();
//$customComponentManager->testDelete();
//$customComponentManager->testGetComponentPdf();
//$customComponentManager->testReadAllComponentNotes();
//$customComponentManager->testReadComponentNoteDetails();
//$customComponentManager->testAddComponentNote();
//$customComponentManager->testAddComponentNoteWithFile();
//$customComponentManager->testDeleteComponentNote();
//$customComponentManager->testReadComponentNoteFiles();
//$customComponentManager->testReadComponentNoteFileDetails();
//$customComponentManager->testChangeComponentStatus();
//$customComponentManager->testCreateComponentActivity();
//$customComponentManager->testReadComponentActivities();
//$customComponentManager->testReadComponentActivityDetails();
//$customComponentManager->testReadDetails();
//$customComponentManager->testCreate();
//$customComponentManager->testDelete();
//$customComponentManager->testLinkDomains();
//$customComponentManager->testUpdateLinkDomains();
//$customComponentManager->testUnlinkDomains();
//$customComponentManager->testDeleteCustomObjects();
//$customComponentManager->testUpdateExpress();
//$customComponentManager->testGetComponentPdf();
//$customComponentManager->testDeleteCustomObjects();
