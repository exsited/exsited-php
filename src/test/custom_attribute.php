<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\CustomAttribute\CustomAttributeData;
use Api\ApiHelper\Config\ConfigManager;

class CustomAttributeManager
{
    private $customAttributeService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }

        $apiConfig = new ApiConfig($authCredentialData);
        $this->customAttributeService = new CustomAttributeData($apiConfig);
    }

    /**
     * Test GET /custom-attributes
     * Retrieves all custom attributes
     */
    public function testListAll()
    {
        try {
            echo "\n=== Testing List All Custom Attributes ===\n";
            $response = $this->customAttributeService->listAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Test GET /custom-attributes/{ca_uuid}
     * Retrieves a specific custom attribute by UUID
     */
    public function testDetails($customAttributeUUID)
    {
        try {
            echo "\n=== Testing Get Custom Attribute Details ===\n";
            echo "UUID: {$customAttributeUUID}\n";
            $response = $this->customAttributeService->details($customAttributeUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Test POST /custom-attributes
     * Creates a new custom attribute
     */
    public function testCreate()
    {
        try {
            echo "\n=== Testing Create Custom Attribute ===\n";

            $params = [
                "custom_attribute" => [
                    "name" => "test_custom_attr_" . time(),
                    "display_name" => "Test Custom Attribute",
                    "description" => "Created via SDK test",
                    "type" => "STRING",
                    "max_length" => "255",
                    "use_in" => [
                        [
                            "resource" => "account",
                            "required" => "false",
                            "unique" => "false",
                            "enabled" => "true",
                            "associated_account_groups" => [],
                            "associated_item_groups" => [],
                            "associated_user_groups" => []
                        ]
                    ],
                    "options" => [],
                    "encrypt_data" => "false"
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->customAttributeService->create($params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Test POST /custom-attributes - Radio Button Type
     * Creates a custom attribute with radio button options
     */
    public function testCreateRadioButton()
    {
        try {
            echo "\n=== Testing Create Radio Button Custom Attribute ===\n";

            $params = [
                "custom_attribute" => [
                    "name" => "test_radio_attr_" . time(),
                    "display_name" => "Test Radio Button",
                    "description" => "Radio button test via SDK",
                    "type" => "RADIO_BUTTON",
                    "use_in" => [
                        [
                            "resource" => "account",
                            "required" => "false",
                            "unique" => "false",
                            "enabled" => "true",
                            "associated_account_groups" => [],
                            "associated_item_groups" => [],
                            "associated_user_groups" => []
                        ]
                    ],
                    "options" => ["Option A", "Option B", "Option C", "Option D"],
                    "encrypt_data" => "false"
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->customAttributeService->create($params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Test PATCH /custom-attributes/{ca_uuid}
     * Updates an existing custom attribute
     */
    public function testUpdate($customAttributeUUID)
    {
        try {
            echo "\n=== Testing Update Custom Attribute ===\n";
            echo "UUID: {$customAttributeUUID}\n";

            $params = [
                "custom_attribute" => [
                    "display_name" => "Updated Display Name",
                    "description" => "Updated via SDK test on " . date('Y-m-d H:i:s')
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->customAttributeService->update($customAttributeUUID, $params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Test PATCH /custom-attributes/{ca_uuid}
     * Updates options for a custom attribute (Radio Button/Dropdown)
     */
    public function testUpdateOptions($customAttributeUUID)
    {
        try {
            echo "\n=== Testing Update Custom Attribute Options ===\n";
            echo "UUID: {$customAttributeUUID}\n";

            $params = [
                "custom_attribute" => [
                    "options" => [
                        ["display_order" => 0, "name" => "Updated Option 1"],
                        ["display_order" => 1, "name" => "Updated Option 2"],
                        ["display_order" => 2, "name" => "New Option 3"]
                    ]
                ]
            ];

            echo "Request Data:\n";
            echo '<pre>' . json_encode($params, JSON_PRETTY_PRINT) . '</pre>';

            $response = $this->customAttributeService->update($customAttributeUUID, $params);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Test DELETE /custom-attributes/{ca_uuid}
     * Deletes a custom attribute
     */
    public function testDelete($customAttributeUUID)
    {
        try {
            echo "\n=== Testing Delete Custom Attribute ===\n";
            echo "UUID: {$customAttributeUUID}\n";

            $response = $this->customAttributeService->delete($customAttributeUUID);
            echo "\nResponse:\n";
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';

            if (empty($response) || (isset($response['status']) && $response['status'] == 204)) {
                echo "\n✓ Custom attribute deleted successfully (204 No Content)\n";
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Complete CRUD test workflow
     */
    public function testCompleteWorkflow()
    {
        try {
            echo "\n========================================\n";
            echo "=== COMPLETE CRUD WORKFLOW TEST ===\n";
            echo "========================================\n";

            // 1. List all existing attributes
            echo "\n1. Listing all existing custom attributes...\n";
            $listResponse = $this->customAttributeService->listAll();
            $existingCount = isset($listResponse['custom_attributes']) ? count($listResponse['custom_attributes']) : 0;
            echo "Found {$existingCount} existing custom attributes\n";

            // 2. Create new attribute
            echo "\n2. Creating new custom attribute...\n";
            $createParams = [
                "custom_attribute" => [
                    "name" => "workflow_test_" . time(),
                    "display_name" => "Workflow Test Attribute",
                    "description" => "Created for complete workflow test",
                    "type" => "NUMBER",
                    "min_value" => "0",
                    "max_value" => "999999",
                    "use_in" => [
                        [
                            "resource" => "account",
                            "required" => "false",
                            "unique" => "false",
                            "enabled" => "true"
                        ]
                    ],
                    "encrypt_data" => "false"
                ]
            ];
            $createResponse = $this->customAttributeService->create($createParams);

            // Extract UUID from response
            $createdUUID = null;
            if (isset($createResponse['custom_attribute']['uuid'])) {
                $createdUUID = $createResponse['custom_attribute']['uuid'];
            }

            if (!$createdUUID) {
                throw new Exception("Failed to extract UUID from create response");
            }
            echo "✓ Created custom attribute with UUID: {$createdUUID}\n";

            // 3. Get details
            echo "\n3. Retrieving details of created attribute...\n";
            $detailsResponse = $this->customAttributeService->details($createdUUID);
            echo "✓ Retrieved details successfully\n";

            // 4. Update attribute
            echo "\n4. Updating custom attribute...\n";
            $updateParams = [
                "custom_attribute" => [
                    "description" => "Updated in workflow test at " . date('Y-m-d H:i:s')
                ]
            ];
            $updateResponse = $this->customAttributeService->update($createdUUID, $updateParams);
            echo "✓ Updated successfully\n";

            // 5. Delete attribute
            echo "\n5. Deleting custom attribute...\n";
            $deleteResponse = $this->customAttributeService->delete($createdUUID);
            echo "✓ Deleted successfully\n";

            // 6. Verify deletion
            echo "\n6. Verifying deletion...\n";
            try {
                $verifyResponse = $this->customAttributeService->details($createdUUID);
                echo "⚠ Warning: Attribute still exists after deletion\n";
            } catch (Exception $e) {
                echo "✓ Confirmed: Attribute no longer exists (expected error)\n";
            }

            echo "\n========================================\n";
            echo "=== WORKFLOW TEST COMPLETED ===\n";
            echo "========================================\n";

        } catch (Exception $e) {
            echo "\n❌ Workflow Test Failed: " . $e->getMessage() . "\n";
        }
    }
}

// Example Usage
// Uncomment the lines below to run tests

$manager = new CustomAttributeManager();

// Test individual operations:
// $manager->testListAll();
// $manager->testDetails('your-uuid-here');
// $manager->testCreate();
// $manager->testCreateRadioButton();
// $manager->testUpdate('your-uuid-here');
// $manager->testUpdateOptions('your-uuid-here');
// $manager->testDelete('your-uuid-here');

// Test complete CRUD workflow:
// $manager->testCompleteWorkflow();

echo "\n\n=== Custom Attribute Test File ===\n";
echo "Uncomment the test methods you want to run.\n";
echo "Available tests:\n";
echo "  - testListAll(): List all custom attributes\n";
echo "  - testDetails(\$uuid): Get details of specific attribute\n";
echo "  - testCreate(): Create new string type attribute\n";
echo "  - testCreateRadioButton(): Create radio button attribute\n";
echo "  - testUpdate(\$uuid): Update attribute details\n";
echo "  - testUpdateOptions(\$uuid): Update attribute options\n";
echo "  - testDelete(\$uuid): Delete attribute\n";
echo "  - testCompleteWorkflow(): Run full CRUD test\n\n";
