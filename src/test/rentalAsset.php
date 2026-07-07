<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\RentalAsset\RentalAssetData;
use Api\ApiHelper\Config\ConfigManager;

class RentalAssetManager
{
    private $rentalAssetService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->rentalAssetService = new RentalAssetData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=10';
            $response = $this->rentalAssetService->readAll('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id = '1cf85b75-1bf9-4862-a120-9cfa8eb85371';
        try {
            $response = $this->rentalAssetService->readDetails($id, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreate()
    {
        $params = [
            "rental_asset" => [
                "code" => "patch_delete_a7",
                "name" => "RENtal aa",
                "display_name" => "Asset Five",
                "rental_asset_profile" => "Pro pure1",
                "use_custom_availability" => true,
                "rental_asset_custom_availability" => [
                    [
                        "preferred_day" => "Monday",
                        "available" => true,
                        "start_time" => "03:18:00",
                        "end_time" => "04:18:00"
                    ],
                    [
                        "preferred_day" => "Tuesday",
                        "available" => true,
                        "start_time" => "03:18:00",
                        "end_time" => "04:18:00"
                    ],
                    [
                        "preferred_day" => "Wednesday",
                        "available" => true,
                        "start_time" => "03:18:00",
                        "end_time" => "04:18:00"
                    ],
                    [
                        "preferred_day" => "Thursday",
                        "available" => false,
                        "start_time" => "03:18:00",
                        "end_time" => "04:18:00"
                    ],
                    [
                        "preferred_day" => "Friday",
                        "available" => false,
                        "start_time" => "03:18:00",
                        "end_time" => "04:18:00"
                    ],
                    [
                        "preferred_day" => "Saturday",
                        "available" => false,
                        "start_time" => "03:18:00",
                        "end_time" => "04:18:00"
                    ],
                    [
                        "preferred_day" => "Sunday",
                        "available" => false,
                        "start_time" => "03:18:00",
                        "end_time" => "04:18:00"
                    ]
                ],
                "custom_form_template" => "Default for Rental Asset"
            ]
        ];

        try {
            $response = $this->rentalAssetService->create($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate()
    {
        $uuid = '1cf85b75-1bf9-4862-a120-9cfa8eb85371';
        $params = [
            "rental_asset" => [
                "code" => "patch_delete_a7",
                "name" => "RENtal deltet patch",
                "rental_asset_custom_availability" => [
                    [
                        "operation" => "UPDATE",
                        "uuid" => "97e93853-02e3-4c75-9c97-5b6dac765171",
                        "available" => "true",
                        "preferred_day" => "Sunday"
                    ],
                    [
                        "operation" => "DELETE",
                        "uuid" => "87cb5949-4e8c-48e0-8974-aedda6c0bf3c"
                    ]
                ]
            ]
        ];

        try {
            $response = $this->rentalAssetService->update($params, $uuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $uuid = '1cf85b75-1bf9-4862-a120-9cfa8eb85371';
        try {
            $response = $this->rentalAssetService->delete($uuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testListAvailability()
    {
        try {
            $queryParams = [
                'order_by' => 'created_on',
                'direction' => 'desc',
                'limit' => 10
            ];
            $response = $this->rentalAssetService->listAvailability($queryParams, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateAvailability()
    {
        $params = [
            "rental_assets" => [
                [
                    "id" => "patch_delete_a2",
                    "schedule_list" => [
                        [
                            "preferred_day" => "monday",
                            "start_time" => "09:00",
                            "end_time" => "17:00",
                            "available" => true
                        ],
                        [
                            "preferred_day" => "tuesday",
                            "start_time" => "09:00",
                            "end_time" => "17:00",
                            "available" => true
                        ]
                    ],
                    "available_list" => [
                        [
                            "preferred_date" => "2025-02-15",
                            "start_time" => "09:00",
                            "end_time" => "17:00",
                            "available" => true
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->rentalAssetService->updateAvailability($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}


$rentalAssetManager = new RentalAssetManager(0);
//$rentalAssetManager->testReadAll();
//$rentalAssetManager->testReadDetails();
//$rentalAssetManager->testCreate();
//$rentalAssetManager->testUpdate();
//$rentalAssetManager->testDelete();
//$rentalAssetManager->testListAvailability();
$rentalAssetManager->testUpdateAvailability();
