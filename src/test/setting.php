<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Setting\SettingData;
use Api\ApiHelper\Config\ConfigManager;

class SettingManager
{
    private $settingService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->settingService = new SettingData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=2';
            $response = $this->settingService->readAll('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadTaxes()
    {
        try {
            $response = $this->settingService->readTaxes('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadPaymentProcessors()
    {
        try {
            $response = $this->settingService->readPaymentProcessors('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadCurrencies()
    {
        try {
            $response = $this->settingService->readCurrencies('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadPricingLevels()
    {
        try {
            $response = $this->settingService->readPricingLevels('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDiscountProfiles()
    {
        try {
            $response = $this->settingService->readDiscountProfiles('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDiscountProfileDetails()
    {
        $discountProfileUUID="7311f69e-dcef-4382-8a76-c3005af0f101";
        try {
            $response = $this->settingService->readDiscountProfileDetails($discountProfileUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadComponents()
    {
        try {
            $response = $this->settingService->readComponents('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadCustomAttributes()
    {
        try {
            $response = $this->settingService->readCustomAttributes('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadItemGroups()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=10';
            $response = $this->settingService->readItemGroups('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateItemGroup()
    {
        $params = [
            "item_groups" => [
                "name" => "Default Group",
                "display_name" => "Default Group",
                "image" => "base64 format image",
                "description" => "Item group description",
                "accounting_code" => "IG001",
                "manager" => "Admin",
                "custom_attributes" => [
                    [
                        "name" => "item_cus",
                        "value" => "string emni"
                    ]
                ]
            ]
        ];

        try {
            $response = $this->settingService->createItemGroup($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadShippingProfiles()
    {
        try {
            $response = $this->settingService->readShippingProfile('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testReadAllWarehouse()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=2';
            $response = $this->settingService->readAllWarehouse('v3', $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadWarehouseDetails()
    {
        $uuId="563dee23-c60e-41c9-8874-ebb76ecde3ab";
        try {
            $response = $this->settingService->readWarehouseDetails($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadRedemptionCodeDetails()
    {
        $redemptionCode = "'75519842";
        try {
            $response = $this->settingService->readRedemptionCodeDetails($redemptionCode,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateVariations()
    {
        $params = [
            "variations" => [
                "name" => "new var",
                "display_name" => "new var",
                "description" => "Bryan Adams - (Everything I Do) I Do It For You",
                "options" => [
                    "Nobab",
                    "Regular",
                    "Premium"
                ]
            ]
        ];

        try {
            $response = $this->settingService->createVariations($params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testChangeVariations()
    {
        $uuId="3a880d69-b9ae-43e0-b348-a5a835fd244b";
        $params = [
            "variations" => [
                "name" => "Change var",
                "display_name" => "Change var",
                "description" => "Bryan Adams",
                "options" => [
                    [
                        "name" => "1",
                        "order" => 0
                    ]
                ]
            ]
        ];


        try {
            $response = $this->settingService->changeVariations($params,$uuId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function testReadVariations()
    {
        try {
            $response = $this->settingService->readVariations('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function testReadCustomAttributeDetails()
    {
        $customAttributeUUID = "8d4ef132-f919-416d-a37a-75be8a76cf37";
        try {
            $response = $this->settingService->readCustomAttributeDetails($customAttributeUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadVariationById()
    {
        $variationUUID = "e40573a2-9cd0-49ce-bdce-3ec6f493dc2d";
        try {
            $response = $this->settingService->readVariationById($variationUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateAccountFieldSettings()
    {
        $params = [
            'field_settings' => [
                'account' => [
                    'fields' => [
                        [
                            'name' => 'accountingCode',
                            'enabled' => 'true',
                            'required' => 'true'
                        ],
                        [
                            'name' => 'paymentTermAlignment',
                            'enabled' => 'true',
                            'default' => 'Invoice Date'
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->settingService->updateAccountFieldSettings($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateItemFieldSettings()
    {
        $params = [
            'field_settings' => [
                'item' => [
                    'fields' => [
                        [
                            'name' => 'paymentProcessor',
                            'enabled' => 'true'
                        ],
                        [
                            'name' => 'paymentMode',
                            'enabled' => 'true'
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->settingService->updateItemFieldSettings($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateDateAndTimeSettings()
    {
        $params = [
            'general_settings' => [
                'date_and_time' => [
                    'time_zone' => 'Australia/Sydney',
                    'date_format' => 'yy/MM/dd',
                    'time_format' => 'HH:mm',
                    'first_day_of_week' => 'friday'
                ]
            ]
        ];

        try {
            $response = $this->settingService->updateDateAndTimeSettings($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateAccountGeneralSettings()
    {
        $params = [
            'general_settings' => [
                'account' => [
                    'account_grouping' => [
                        'enabled' => 'true'
                    ],
                    'creation_of_subsidiary_account' => [
                        'enabled' => 'true',
                        'default_subsidiary_account' => ''
                    ],
                    'enable_workflow_approval_for_account' => 'true',
                    'require_name_to_be_unique' => 'false',
                    'require_email_address_for_account' => 'false',
                    'require_email_address_for_account_to_be_unique' => 'false',
                    'require_email_address_for_contact_to_be_unique' => 'true',
                    'billing_contact' => [
                        'enabled' => 'true',
                        'type' => 'Contact 1',
                        'display_name' => 'Billing Contact from x',
                        'require_email_address_for_billing_contact' => 'true'
                    ],
                    'shipping_contact' => [
                        'enabled' => 'true',
                        'type' => 'Contact 2',
                        'display_name' => 'Shipping Contact x',
                        'require_email_address_for_shipping_contact' => 'true'
                    ],
                    'additional_contact_1' => [
                        'enabled' => 'true',
                        'type' => 'Contact 3',
                        'display_name' => 'Additional Contact payload',
                        'require_email_address_for_additional_contact_1' => 'true'
                    ],
                    'additional_contact_2' => [
                        'enabled' => 'true',
                        'type' => 'Contact 4',
                        'display_name' => 'Additional Contact 2wo',
                        'require_email_address_for_additional_contact_2' => 'true'
                    ],
                    'additional_contact_3' => [
                        'enabled' => 'true',
                        'display_name' => 'Additional Contact three test',
                        'require_email_address_for_additional_contact_3' => 'true'
                    ]
                ]
            ]
        ];

        try {
            $response = $this->settingService->updateAccountGeneralSettings($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateItemGeneralSettings()
    {
        $params = [
            'general_settings' => [
                'item' => [
                    'enable_variation_based_item' => 'true',
                    'enable_gift_certificate_based_item' => 'true',
                    'enable_bundle_item' => 'true',
                    'enable_direct_cost_item' => 'true',
                    'enable_fixed_asset_item' => 'true',
                    'enable_family_cost_item' => 'true',
                    'enable_variation' => 'true',
                    'item_management' => [
                        'enabled' => 'true',
                        'default_manager' => 'Administrator'
                    ],
                    'use_volume_pricing' => [
                        'enabled' => 'false',
                        'all_units_fixed_pricing' => 'true',
                        'incremental_fixed_pricing' => 'true',
                        'all_units_per_unit_pricing' => 'true',
                        'incremental_per_unit_pricing' => 'true'
                    ],
                    'enable_pricing_profile' => 'true',
                    'enable_workflow_approval_for_item' => 'true',
                    'enable_sales' => 'true',
                    'available_charge_types' => [
                        'one_off' => 'true',
                        'recurring' => 'true',
                        'metered' => 'true'
                    ],
                    'use_on_sale_price' => 'true',
                    'use_shipping_profile' => 'true',
                    'use_pricing_level' => 'true',
                    'use_scheduling_of_future_pricing' => 'true',
                    'charging_period_can_vary_from_billing_period' => 'true',
                    'charging_start_date_can_vary_from_billing_start_date' => 'true',
                    'pricing_period_can_vary_from_charging_period' => [
                        'enabled' => 'true',
                        'default_pricing_period' => '1 Day'
                    ],
                    'available_pricing_methods' => [
                        'standard' => 'true',
                        'discount_based' => 'true',
                        'markup_based' => 'true'
                    ],
                    'enable_purchase' => 'true',
                    'enable_supplier_management' => 'true',
                    'enable_inventory_management' => 'true',
                    'enable_warehouse_management' => 'true',
                    'inventory_adjustment_rules' => [
                        'quantity_available_for_sale_determination' => [
                            'QUANTITY_ON_HAND',
                            'QUANTITY_PROMISED',
                            'QUANTITY_ON_ORDER',
                            'QUANTITY_ON_RETURN',
                            'QUANTITY_ON_PURCHASE_RETURN'
                        ],
                        'quantity_available_for_sale' => 'Quantity available'
                    ],
                    'pre_order' => [
                        'enabled' => 'true',
                        'period' => 'MONTHLY',
                        'number_of_period' => '8'
                    ],
                    'enable_serialization' => 'true',
                    'enable_batch_tracking' => 'true',
                    'enable_inventory_costing' => 'true',
                    'enable_back_order' => 'true'
                ]
            ]
        ];

        try {
            $response = $this->settingService->updateItemGeneralSettings($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadCustomLogicScripts()
    {
        try {
            $response = $this->settingService->readCustomLogicScripts('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadCustomLogicScriptDetails()
    {
        $scriptId = "45072a2e-9294-4c55-85a3-3b375a8c628f";
        try {
            $response = $this->settingService->readCustomLogicScriptDetails($scriptId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadApiActionScript()
    {
        $queryParams = [
            'autoBillScriptUuid' => '27bdca19-4764-40c9-b5b5-fee7f406c239',
            'componentUuid' => '90af8c6c-3f70-4e7a-a4d0-6e9995956969',
            'accountId' => '7TIB9E',
            'componentWorkflowCount' => true,
            'quoteWorkflowCount' => true
        ];
        try {
            $response = $this->settingService->readApiActionScript($queryParams,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadApiActionScriptAdminWorkflowCountAll()
    {
        $queryParams = [
            'autoBillScriptUuid' => '27bdca19-4764-40c9-b5b5-fee7f406c239',
            'componentUuid' => '90af8c6c-3f70-4e7a-a4d0-6e9995956969',
            'componentWorkflowCount' => true,
            'quoteWorkflowCount' => true,
            'dueInvoiceCount' => true
        ];
        try {
            $response = $this->settingService->readApiActionScriptAdminWorkflowCountAll($queryParams,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}
 $settingManager = new SettingManager();
// $settingManager->testReadAll();
// $settingManager->testReadTaxes();
// $settingManager->testReadPaymentProcessors();
// $settingManager->testReadCurrencies();
// $settingManager->testReadPricingLevels();
// $settingManager->testCreateVariations();
// $settingManager->testChangeVariations();
// $settingManager->testReadVariations();
// $settingManager->testReadDiscountProfiles();
// $settingManager->testReadDiscountProfileDetails();
// $settingManager->testReadComponents();
// $settingManager->testReadCustomAttributes();
// $settingManager->testReadItemGroups();
// $settingManager->testCreateItemGroup();
// $settingManager->testReadShippingProfiles();
// $settingManager->testReadAllWarehouse();
// $settingManager->testReadWarehouseDetails();
// $settingManager->testReadRedemptionCodeDetails();
//$settingManager->testReadCustomAttributeDetails();
//$settingManager->testReadVariationById();
// $settingManager->testReadCustomAttributeDetails();
// $settingManager->testUpdateAccountFieldSettings();
// $settingManager->testUpdateItemFieldSettings();
// $settingManager->testUpdateDateAndTimeSettings();
// $settingManager->testUpdateAccountGeneralSettings();
//$settingManager->testUpdateItemGeneralSettings();
// $settingManager->testReadCustomLogicScripts();
// $settingManager->testReadCustomLogicScriptDetails();
// $settingManager->testReadApiActionScript();
// $settingManager->testReadApiActionScriptAdminWorkflowCountAll();