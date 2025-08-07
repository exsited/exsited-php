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
            $response = $this->customComponentService->create($componentUuid,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAll()
    {
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";

        try {
            $response = $this->customComponentService->readAll($componentUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id = "Q6IHEO";
        $componentUuid = "d6da08a0-fecf-4eda-8110-89c4e5691bc7";

        try {
            $response = $this->customComponentService->readAllDetails($componentUuid,$id,'v3');
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
            $response = $this->customComponentService->createWithAttributeGroup($componentUuid,$params);
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
            $response = $this->customComponentService->readAccountAllComponent($componentUuid,$accountId,'v3');
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
            $response = $this->customComponentService->readAccountComponent($componentUuid,$accountId,$id,'v3');
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
            $response = $this->customComponentService->change($componentUuid,$id,$params);
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
            $response = $this->customComponentService->delete($componentUuid,$id);
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