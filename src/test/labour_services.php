<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Labour\LabourData;
use Api\AppService\LabourProfile\LabourProfileData;
use Api\AppService\LabourAvailability\LabourAvailabilityData;
use Api\ApiHelper\Config\ConfigManager;

class LabourServicesManager
{
    private $labourService;
    private $labourProfileService;
    private $labourAvailabilityService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }

        $apiConfig = new ApiConfig($authCredentialData);
        $this->labourService = new LabourData($apiConfig);
        $this->labourProfileService = new LabourProfileData($apiConfig);
        $this->labourAvailabilityService = new LabourAvailabilityData($apiConfig);
    }

    public function testLabourListAll()
    {
        try {
            echo "\n=== Testing List All Labours ===\n";
            $response = $this->labourService->listAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourDetails($labourUUID)
    {
        try {
            echo "\n=== Testing Get Labour Details ===\n";
            echo "UUID: {$labourUUID}\n";
            $response = $this->labourService->details($labourUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourCreate()
    {
        try {
            echo "\n=== Testing Create Labour ===\n";

            $params = [
                "labour" => [
                    "name" => "Test Labour " . time(),
                    "display_name" => "Test Labour Display",
                    "description" => "Created via SDK test",
                    "image_name" => "",
                    "email_address" => "testlabour@example.com",
                    "use_custom_availability" => true,
                    "labour_profile" => "Helper",
                    "custom_form_template" => "Default for Labour",
                    "labour_custom_availability" => [
                        [
                            "start_time" => "10:00:00",
                            "end_time" => "16:00:00",
                            "available" => "true",
                            "preferred_day" => "Monday"
                        ],
                        [
                            "start_time" => "10:00:00",
                            "end_time" => "16:00:00",
                            "available" => "true",
                            "preferred_day" => "Tuesday"
                        ]
                    ]
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->labourService->create($params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourUpdate($labourUUID)
    {
        try {
            echo "\n=== Testing Update Labour ===\n";
            echo "UUID: {$labourUUID}\n";

            $params = [
                "labour" => [
                    "name" => "Updated Labour",
                    "display_name" => "Updated Labour Display",
                    "description" => "Updated via SDK test on " . date('Y-m-d H:i:s')
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->labourService->update($labourUUID, $params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourDelete($labourUUID)
    {
        try {
            echo "\n=== Testing Delete Labour ===\n";
            echo "UUID: {$labourUUID}\n";

            $response = $this->labourService->delete($labourUUID);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';

            if (empty($response) || (isset($response['status']) && $response['status'] == 204)) {
                echo "\n✓ Labour deleted successfully (204 No Content)\n";
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourAvailableForBooking($queryParams = null)
    {
        try {
            echo "\n=== Testing Get Available Labours for Booking ===\n";
            if ($queryParams) {
                echo "Query Parameters:\n";
                echo '<pre>' . json_encode($queryParams, JSON_PRETTY_PRINT) . '</pre>';
            }

            $response = $this->labourService->availableForBooking($queryParams);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourProfileListAll()
    {
        try {
            echo "\n=== Testing List All Labour Profiles ===\n";
            $response = $this->labourProfileService->listAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourProfileDetails($profileUUID)
    {
        try {
            echo "\n=== Testing Get Labour Profile Details ===\n";
            echo "UUID: {$profileUUID}\n";
            $response = $this->labourProfileService->details($profileUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourProfileCreate()
    {
        try {
            echo "\n=== Testing Create Labour Profile ===\n";

            $params = [
                "labour_profile" => [
                    "name" => "Test Profile " . time(),
                    "display_name" => "Test Profile Display",
                    "description" => "Created via SDK test",
                    "image_name" => "",
                    "custom_form_template" => "Default for Labour",
                    "labour_profile_availability" => [
                        [
                            "start_time" => "09:00:00",
                            "end_time" => "17:00:00",
                            "available" => "true",
                            "preferred_day" => "Monday"
                        ],
                        [
                            "start_time" => "09:00:00",
                            "end_time" => "17:00:00",
                            "available" => "true",
                            "preferred_day" => "Friday"
                        ]
                    ]
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->labourProfileService->create($params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourProfileUpdate($profileUUID)
    {
        try {
            echo "\n=== Testing Update Labour Profile ===\n";
            echo "UUID: {$profileUUID}\n";

            $params = [
                "labour_profile" => [
                    "name" => "Updated Profile",
                    "display_name" => "Updated Profile Display",
                    "description" => "Updated via SDK test on " . date('Y-m-d H:i:s')
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->labourProfileService->update($profileUUID, $params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourProfileDelete($profileUUID)
    {
        try {
            echo "\n=== Testing Delete Labour Profile ===\n";
            echo "UUID: {$profileUUID}\n";

            $response = $this->labourProfileService->delete($profileUUID);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';

            if (empty($response) || (isset($response['status']) && $response['status'] == 204)) {
                echo "\n✓ Labour profile deleted successfully (204 No Content)\n";
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourAvailabilityListAll($queryParams = null)
    {
        try {
            echo "\n=== Testing List Labour Availability ===\n";
            if ($queryParams) {
                echo "Query Parameters:\n";
                echo '<pre>' . json_encode($queryParams, JSON_PRETTY_PRINT) . '</pre>';
            }

            $response = $this->labourAvailabilityService->listAll($queryParams);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testLabourAvailabilityUpdate()
    {
        try {
            echo "\n=== Testing Update Labour Availability ===\n";

            $params = [
                "labour_availability" => [
                    "labour_uuid" => "your-labour-uuid-here",
                    "availability_slots" => [
                        [
                            "start_time" => "09:00:00",
                            "end_time" => "17:00:00",
                            "date" => "2025-12-29"
                        ],
                        [
                            "start_time" => "10:00:00",
                            "end_time" => "18:00:00",
                            "date" => "2025-12-30"
                        ]
                    ]
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->labourAvailabilityService->update($params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCompleteLabourWorkflow()
    {
        try {
            echo "\n========================================\n";
            echo "=== COMPLETE LABOUR WORKFLOW TEST ===\n";
            echo "========================================\n";

            echo "\n1. Listing existing labour profiles...\n";
            $profilesResponse = $this->labourProfileService->listAll();
            $existingProfiles = isset($profilesResponse['labour_profiles']) ? count($profilesResponse['labour_profiles']) : 0;
            echo "Found {$existingProfiles} existing labour profiles\n";

            echo "\n2. Creating new labour profile...\n";
            $profileParams = [
                "labour_profile" => [
                    "name" => "Workflow Test Profile " . time(),
                    "display_name" => "Workflow Test Profile",
                    "description" => "Created for complete workflow test",
                    "custom_form_template" => "Default for Labour",
                    "labour_profile_availability" => [
                        [
                            "start_time" => "09:00:00",
                            "end_time" => "17:00:00",
                            "available" => "true",
                            "preferred_day" => "Monday"
                        ]
                    ]
                ]
            ];
            $createProfileResponse = $this->labourProfileService->create($profileParams);

            $createdProfileUUID = null;
            if (isset($createProfileResponse['labour_profile']['uuid'])) {
                $createdProfileUUID = $createProfileResponse['labour_profile']['uuid'];
            }

            if (!$createdProfileUUID) {
                throw new Exception("Failed to extract profile UUID from create response");
            }
            echo "✓ Created labour profile with UUID: {$createdProfileUUID}\n";

            echo "\n3. Creating new labour...\n";
            $labourParams = [
                "labour" => [
                    "name" => "Workflow Test Labour " . time(),
                    "display_name" => "Workflow Test Labour",
                    "description" => "Created for workflow test",
                    "email_address" => "workflow@test.com",
                    "use_custom_availability" => false,
                    "labour_profile" => $profileParams['labour_profile']['name'],
                    "custom_form_template" => "Default for Labour"
                ]
            ];
            $createLabourResponse = $this->labourService->create($labourParams);

            $createdLabourUUID = null;
            if (isset($createLabourResponse['labour']['labour']['uuid'])) {
                $createdLabourUUID = $createLabourResponse['labour']['labour']['uuid'];
            } elseif (isset($createLabourResponse['labour']['uuid'])) {
                $createdLabourUUID = $createLabourResponse['labour']['uuid'];
            }

            if (!$createdLabourUUID) {
                throw new Exception("Failed to extract labour UUID from create response");
            }
            echo "✓ Created labour with UUID: {$createdLabourUUID}\n";

            echo "\n4. Updating labour...\n";
            $updateLabourParams = [
                "labour" => [
                    "description" => "Updated in workflow test at " . date('Y-m-d H:i:s')
                ]
            ];
            $this->labourService->update($createdLabourUUID, $updateLabourParams);
            echo "✓ Updated labour successfully\n";

            echo "\n5. Updating labour profile...\n";
            $updateProfileParams = [
                "labour_profile" => [
                    "description" => "Updated in workflow test at " . date('Y-m-d H:i:s')
                ]
            ];
            $this->labourProfileService->update($createdProfileUUID, $updateProfileParams);
            echo "✓ Updated profile successfully\n";

            echo "\n6. Deleting labour...\n";
            $this->labourService->delete($createdLabourUUID);
            echo "✓ Deleted labour successfully\n";

            echo "\n7. Deleting labour profile...\n";
            $this->labourProfileService->delete($createdProfileUUID);
            echo "✓ Deleted profile successfully\n";

            echo "\n========================================\n";
            echo "=== WORKFLOW TEST COMPLETED ===\n";
            echo "========================================\n";

        } catch (Exception $e) {
            echo "\n❌ Workflow Test Failed: " . $e->getMessage() . "\n";
        }
    }
}

$manager = new LabourServicesManager();

echo "\n\n=== Labour & Booking Services Test File ===\n";
echo "Uncomment the test methods you want to run.\n\n";
echo "Available tests:\n";
echo "  Labour Tests:\n";
echo "    - testLabourListAll()\n";
echo "    - testLabourDetails(\$uuid)\n";
echo "    - testLabourCreate()\n";
echo "    - testLabourUpdate(\$uuid)\n";
echo "    - testLabourDelete(\$uuid)\n";
echo "    - testLabourAvailableForBooking(\$params)\n\n";
echo "  Labour Profile Tests:\n";
echo "    - testLabourProfileListAll()\n";
echo "    - testLabourProfileDetails(\$uuid)\n";
echo "    - testLabourProfileCreate()\n";
echo "    - testLabourProfileUpdate(\$uuid)\n";
echo "    - testLabourProfileDelete(\$uuid)\n\n";
echo "  Labour Availability Tests:\n";
echo "    - testLabourAvailabilityListAll(\$params)\n";
echo "    - testLabourAvailabilityUpdate()\n\n";
echo "  Complete Workflow:\n";
echo "    - testCompleteLabourWorkflow()\n\n";
