<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\NoteGroup\NoteGroupData;
use Api\ApiHelper\Config\ConfigManager;

class NoteGroupManager
{
    private $noteGroupService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->noteGroupService = new NoteGroupData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=10';
            $response = $this->noteGroupService->readAll('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $noteGroupUuid = '2d506f86-6aa1-4d65-8dfe-d60d1e318653';
        try {
            $response = $this->noteGroupService->readDetails($noteGroupUuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadUserDetails()
    {
        $noteGroupUuid = '2d506f86-6aa1-4d65-8dfe-d60d1e318653';
        $userUuid = '486a9a27-ab64-4cbe-86ae-83921dcbe82b';
        try {
            $response = $this->noteGroupService->readUserDetails($noteGroupUuid, $userUuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreate()
    {
        $params = [
            "note_group" => [
                "name" => "Winter 80",
                "display_name" => "Winter",
                "description" => "This is a sample text for winter note group",
                "note_users" => [
                    [
                        "name" => "jon doe",
                        "display_name" => "Jon Doe",
                        "email_address" => "jondoe@gmail.com"
                    ],
                    [
                        "account" => "cdbf8850-83b4-44ae-8362-d3b362360526"
                    ]
                ]
            ]
        ];

        try {
            $response = $this->noteGroupService->create($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate()
    {
        $noteGroupUuid = 'fd4121e9-66b1-4f3f-ab21-ce203ce8da38';
        $params = [
            "note_group" => [
                "name" => "Winter 36",
                "display_name" => "Winter",
                "description" => "zzzzzzThis is a sample text",
                "note_users" => [
                    [
                        "name" => "jon doe",
                        "display_name" => "maxa hala falai 55",
                        "email_address" => "zzzzzz1This@gmail.com",
                        "note_access_from_date_time" => "2026-01-27 15:52:20"
                    ]
                ]
            ]
        ];

        try {
            $response = $this->noteGroupService->update($noteGroupUuid, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $noteGroupUuid = 'fd4121e9-66b1-4f3f-ab21-ce203ce8da38';

        try {
            $response = $this->noteGroupService->delete($noteGroupUuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateReadStatus()
    {
        $params = [
            "note_read_status" => [
                "note_uuid" => "e906c3f9-af43-4e8b-9ad0-79a5fd8a5b08",
                "note_user_uuid" => "486a9a27-ab64-4cbe-86ae-83921dcbe82b",
                "read_status" => "true"
            ]
        ];

        try {
            $response = $this->noteGroupService->createReadStatus($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$noteGroupManager = new NoteGroupManager(0);

// $noteGroupManager->testReadAll();
// $noteGroupManager->testReadDetails();
// $noteGroupManager->testReadUserDetails();
// $noteGroupManager->testCreate();
// $noteGroupManager->testUpdate();
// $noteGroupManager->testDelete();
// $noteGroupManager->testCreateReadStatus();
