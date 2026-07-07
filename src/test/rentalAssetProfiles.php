<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\RentalAssetProfiles\RentalAssetProfilesData;
use Api\ApiHelper\Config\ConfigManager;

class RentalAssetProfilesManager
{
    private $rentalAssetProfilesService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->rentalAssetProfilesService = new RentalAssetProfilesData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->rentalAssetProfilesService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $uuid = 'cc722803-5ea6-4ab8-881f-8be02e78ccec';
        try {
            $response = $this->rentalAssetProfilesService->readDetails($uuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreate()
    {
        $params = [
            'rental_asset_profile' => [
                'name' => 'Pro pure1',
                'display_name' => 'Pro pure1',
                'max_booking_limit' => '2',
                'currency' => 'AUD',
                'tax_inclusive' => false,
                'rental_asset_profile_sessions' => [
                    [
                        'name' => 'Prof Sess 1005',
                        'start_date' => '2025-11-03 00:00:00',
                        'end_date' => '2025-11-04 00:00:00',
                        'rental_asset_profile_session_prices' => [
                            [
                                'price' => '12.00',
                                'enabled_pro_rata' => false,
                                'price_type' => 'Hourly',
                                'rental_asset_profile_session_price_hours' => [
                                    [
                                        'start_time' => '17:47:00',
                                        'end_time' => '18:48:00',
                                        'price' => '10.00'
                                    ]
                                ],
                                'rental_asset_profile_session_price_peak_hourly' => [
                                    [
                                        'start_time' => '17:47:00',
                                        'end_time' => '17:48:00',
                                        'price' => null,
                                        'price_type' => 'Fixed'
                                    ]
                                ]
                            ]
                        ],
                        'rental_asset_profile_session_availability' => [
                            [
                                'preferred_day' => 'Monday',
                                'available' => true,
                                'start_time' => '17:47:00',
                                'end_time' => '18:47:00'
                            ],
                            [
                                'preferred_day' => 'Tuesday',
                                'available' => true,
                                'start_time' => '17:47:00',
                                'end_time' => '18:47:00'
                            ],
                            [
                                'preferred_day' => 'Wednesday',
                                'available' => true,
                                'start_time' => '17:47:00',
                                'end_time' => '18:47:00'
                            ],
                            [
                                'preferred_day' => 'Thursday',
                                'available' => true,
                                'start_time' => '17:47:00',
                                'end_time' => '18:47:00'
                            ],
                            [
                                'preferred_day' => 'Friday',
                                'available' => true,
                                'start_time' => '17:47:00',
                                'end_time' => '18:47:00'
                            ],
                            [
                                'preferred_day' => 'Saturday',
                                'available' => true,
                                'start_time' => '17:47:00',
                                'end_time' => '18:47:00'
                            ],
                            [
                                'preferred_day' => 'Sunday',
                                'available' => true,
                                'start_time' => '17:47:00',
                                'end_time' => '18:47:00'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->rentalAssetProfilesService->create($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate()
    {
        $uuid = 'cc722803-5ea6-4ab8-881f-8be02e78ccec';
        $params = [
            'rental_asset_profile' => [
                'name' => 'abc Patch',
                'display_name' => 'Pro Patch',
                'max_booking_limit' => '10',
                'tax_inclusive' => true
            ]
        ];

        try {
            $response = $this->rentalAssetProfilesService->update($uuid, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $uuid = 'cc722803-5ea6-4ab8-881f-8be02e78ccec';
        try {
            $response = $this->rentalAssetProfilesService->delete($uuid, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$rentalAssetProfilesManager = new RentalAssetProfilesManager();
//$rentalAssetProfilesManager->testReadAll();
// $rentalAssetProfilesManager->testReadDetails();
// $rentalAssetProfilesManager->testCreate();
// $rentalAssetProfilesManager->testUpdate();
// $rentalAssetProfilesManager->testDelete();
