<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\CustomFeature\CustomFeatureData;
use Api\ApiHelper\Config\ConfigManager;

class CustomFeatureManager
{
    private $customFeatureService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->customFeatureService = new CustomFeatureData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->customFeatureService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        try {
            $customFeatureId = '81cc1717-7f1f-408d-b25f-dd00873444a5';
            $response = $this->customFeatureService->readDetails($customFeatureId, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreate()
    {
        $params = [
            'component' => [
                'name' => 'Test Custom ComponentD',
                'display_name' => 'Test Custom ComponentD',
                'description' => 'this is custom component description',
                'use_in' => 'Account',
                'custom_component_name' => 'Test Custom ComponentC',
                'relation' => 'ONE_TO_ONE',
                'configuration' => [
                    'settings' => [
                        'form_layout' => 'TWO_COLS',
                        'custom_form' => 'Default for Custom Component'
                    ],
                    'column_1' => [
                        'attributes' => [
                            [
                                'type' => 'LABEL',
                                'name' => 'Profile'
                            ],
                            [
                                'type' => 'ATTRIBUTE',
                                'name' => 'Name',
                                'required' => 'true',
                                'show_in_list_view' => 'true',
                                'display_condition' => '',
                                'validation_condition' => '',
                                'validation_message' => '',
                                'default_value' => '',
                                'required_condition' => ''
                            ],
                            [
                                'type' => 'ATTRIBUTE',
                                'name' => 'Email',
                                'required' => 'false',
                                'show_in_list_view' => 'false',
                                'display_condition' => '',
                                'validation_condition' => '',
                                'validation_message' => '',
                                'default_value' => '',
                                'required_condition' => ''
                            ],
                            [
                                'type' => 'ATTRIBUTE',
                                'name' => 'Phone',
                                'required' => 'false',
                                'show_in_list_view' => 'false',
                                'display_condition' => '',
                                'validation_condition' => '',
                                'validation_message' => '',
                                'default_value' => '',
                                'required_condition' => ''
                            ]
                        ]
                    ],
                    'column_2' => [
                        'attributes' => [
                            [
                                'type' => 'LABEL',
                                'name' => 'Company Details'
                            ],
                            [
                                'type' => 'ATTRIBUTE',
                                'name' => 'Designation',
                                'required' => 'true',
                                'show_in_list_view' => 'true',
                                'display_condition' => '',
                                'validation_condition' => '',
                                'validation_message' => '',
                                'default_value' => '',
                                'required_condition' => ''
                            ],
                            [
                                'type' => 'ATTRIBUTE',
                                'name' => 'Salary',
                                'required' => 'false',
                                'show_in_list_view' => 'false',
                                'display_condition' => '',
                                'validation_condition' => '',
                                'validation_message' => '',
                                'default_value' => '',
                                'required_condition' => ''
                            ],
                            [
                                'type' => 'LABEL',
                                'name' => 'Team Details'
                            ],
                            [
                                'type' => 'ATTRIBUTE',
                                'name' => 'Team Name',
                                'required' => 'true',
                                'show_in_list_view' => 'true',
                                'display_condition' => '',
                                'validation_condition' => '',
                                'validation_message' => '',
                                'default_value' => '',
                                'required_condition' => ''
                            ],
                            [
                                'type' => 'ATTRIBUTE',
                                'name' => 'Reporting Manager',
                                'required' => 'false',
                                'show_in_list_view' => 'false',
                                'display_condition' => '',
                                'validation_condition' => '',
                                'validation_message' => '',
                                'default_value' => '',
                                'required_condition' => ''
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->customFeatureService->create($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate()
    {
        $customFeatureId = '0bd984d4-5488-4293-bb2b-618f5f0928a8';

        $params = [
            'component' => [
                'name' => 'Test Component',
                'display_name' => 'Test Component',
                'description' => 'Updating Component',
                'use_in' => 'Account',
                'use_in_custom_component_name' => 'Test Component',
                'relation' => 'ONE_TO_ONE',
                'children' => ['account', 'saleOrder']
            ]
        ];

        try {
            $response = $this->customFeatureService->update($customFeatureId, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateCustomForm()
    {
        $customFeatureId = '0bd984d4-5488-4293-bb2b-618f5f0928a8';

        $params = [
            'configuration' => [
                'settings' => [
                    'form_layout' => 'TWO_COLS'
                ],
                'column_1' => [
                    'attributes' => [
                        [
                            'type' => 'ATTRIBUTE',
                            'name' => 'Quote_Title',
                            'display_name' => 'Quote Title',
                            'data_type' => 'String'
                        ]
                    ]
                ],
                'column_2' => [
                    'attributes' => [
                        [
                            'type' => 'LABEL',
                            'name' => 'Label'
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->customFeatureService->createCustomForm($customFeatureId, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $customFeatureId = '5ee8e707-bf6a-433b-b492-3ed9039ad9c8';

        try {
            $response = $this->customFeatureService->delete($customFeatureId, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}


$customFeatureManager = new CustomFeatureManager();
//$customFeatureManager->testReadAll();
//$customFeatureManager->testReadDetails();
//$customFeatureManager->testCreate();
//$customFeatureManager->testUpdate();
//$customFeatureManager->testCreateCustomForm();
//$customFeatureManager->testDelete();
