<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Order\OrderData;
use Api\ApiHelper\Config\ConfigManager;

class OrderManager
{
    private $orderService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->orderService = new OrderData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->orderService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id = 'ORD-76GOU2-1261';
        try {
            $response = $this->orderService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadInformation()
    {
        $id = 'ORD-76GOU2-1261';
        try {
            $response = $this->orderService->readInformation($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadAccountOrders()
    {
        $accountID = '76GOU2';
        try {
            $response = $this->orderService->readAccountOrders($accountID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadBillingPreferences()
    {
        $accountID = '76GOU2';
        try {
            $response = $this->orderService->readBillingPreferences($accountID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadOrderLines()
    {
        $id = 'ORD-76GOU2-1265';
        try {
            $orderInfo = $this->orderService->readOrderLines($id,'v3');
            echo '<pre>' . json_encode($orderInfo, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsOrderLine()
    {
        $id = 'ORD-76GOU2-1265';
        $chargeItemUUID="b2b4e5ba-b5d4-41da-81b7-a8d307cb80a1";
        try {
            $orderInfo = $this->orderService->readDetailsOrderLine($id,$chargeItemUUID,'v3');
            echo '<pre>' . json_encode($orderInfo, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function testCreate()
    {
        $params = [
            "account_id" => "IE1DSN",
            // "redemption_code" => "ITEM-0007",
            "lines" => [
                [
                    "item_id" => "ITEM-0012",
                    "item_order_quantity" => "10",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "150"
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->create($params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testCreateOrderWithPurchase()
    {
        $params = [
            "order" => [
                "name" => "renting2",
                "id" => "ORD_7a166f54kglfl",
                "account_id" => "LHROM9",
                "properties" => [
                    "communication_profile" => "",
                    "invoice_mode" => "AUTOMATIC",
                    "invoice_term" => "Billing Start Date",
                    "billing_period" => "1 Month",
                    "payment_processor" => "Cash",
                    "payment_mode" => "MANUAL",
                    "payment_term" => "Net 30",
                    "payment_term_alignment" => "BILLING_DATE",
                    "fulfillment_mode" => "MANUAL",
                    "fulfillment_term" => "Immediately"
                ],
                "lines" => [
                    [
                        "item_id" => "ITEM-0012",
                        "item_quantity" => "1",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price" => "5"
                            ]
                        ],
                        "purchase_order" => [
                            "create_po" => "true",
                            "po_information" => [
                                "id" => "VHZB-0000000125klmfl",
                                "name" => "Land Owner",
                                "account_id" => "LHROM9",
                                "currency" => "AUD",
                                "item_quantity" => "1",
                                "item_price_snapshot" => [
                                    "pricing_rule" => [
                                        "price" => "4"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->createOrderWithPurchase($params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCancel()
    {
        $params = [
            "order" => [
                "effective_date" => "2024-12-18"
            ]
        ];
        $id='ORD-IE1DSN-1262';
        try {
            $response = $this->orderService->cancel($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChangeInformation()
    {
        $params = [
            "order" => [
                "name" => "My Collection",
                "display_name" => "My Collection",
                "description" => "Exclusive Item",
                "manager" => "Administrator",
                "origin" => "NetSuite",
                "invoice_note" => "Invoice note",
//                "communication_preference" => [
//                    [
//                        "media" => "EMAIL",
//                        "isEnabled" => "true"
//                    ],
//                    [
//                        "media" => "POSTAL_EMAIL",
//                        "isEnabled" => "true"
//                    ],
//                    [
//                        "media" => "TEXT_MESSAGE",
//                        "isEnabled" => "true"
//                    ],
//                    [
//                        "media" => "VOICE_MAIL",
//                        "isEnabled" => "true"
//                    ]
//                ]
            ]
        ];
        $id='ORD-IE1DSN-1262';
        try {
            $response= $this->orderService->changeInformation($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testChangeBillingPreferences()
    {

        $params = [
            "order" => [
                "properties" => [
                    "communication_profile" => "AutoBill Communication Profile",
                    "invoice_mode" => "AUTOMATIC",
                    "invoice_term" => "Billing Start Date",
                    "billing_period" => "1 Month",
                    "payment_processor" => "Cash",
                    "payment_mode" => "MANUAL",
                    "payment_term" => "Net 30",
                    "payment_term_alignment" => "BILLING_DATE",
                    "fulfillment_mode" => "MANUAL",
                    "fulfillment_term" => "IMMEDIATELY"
                ]
            ]
        ];
        $id='ORD-76GOU2-1265';
        try {
            $response = $this->orderService->changeBillingPreferences($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateBillingPreferences()
    {

        $params = [
            "order" => [
                "properties" => [
                    "communication_profile" => "AutoBill Communication Profile",
                    "invoice_mode" => "AUTOMATIC",
                    "invoice_term" => "Billing Start Date",
                    "billing_period" => "1 Month",
                    "payment_processor" => "Cash",
                    "payment_mode" => "MANUAL",
                    "payment_term" => "Net 30",
                    "payment_term_alignment" => "BILLING_DATE",
                    "fulfillment_mode" => "MANUAL",
                    "fulfillment_term" => "IMMEDIATELY"
                ]
            ]
        ];
        $id='ORD-76GOU2-1265';

        try {
            $response = $this->orderService->updateBillingPreferences($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChangeOrderLineInformation()
    {
        $params = [
            "order" => [
                "line" => [
                    "item_name" => "chips",
                    "item_invoice_note" => "note",
                    "item_description" => "description",
//                    "item_custom_attributes" => [
//                        [
//                            "name" => "Mug",
//                            "value" => "plastic material"
//                        ]
//                    ]
                ]
            ]
        ];
        $id='ORD-76GOU2-1265';
        $chargeItemUUID="b2b4e5ba-b5d4-41da-81b7-a8d307cb80a1";

        try {
            $response = $this->orderService->changeOrderLineInformation($params, $id,$chargeItemUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testOrderDelete()
    {
        $id='ORD-Y1B8-000-0133';
        try {
            $response = $this->orderService->delete($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function testCreateOrderUsages()
    {
        $params = [
            'usage' => [
                'charge_item_uuid' => '1e76f204-f71d-457d-a177-c6bb42f9d5bf',
                'charging_period' => '2024-08-06-2024-09-05',
                'quantity' => '2',
                'end_time' => '2024-09-02 01:01:01',
                'type' => 'Incremental',

            ]
        ];


        try {
            $response = $this->orderService->createOrderUsages($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testReactivate()
    {
        $params = [
            "order" => [
                "effective_date" => "2024-12-18"
            ]
        ];
        $id='ORD-IE1DSN-1262';
        try {
            $response = $this->orderService->reactivate($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChange()
    {
        $params = [
            "order" => [
                "effective_date" => "2024-12-18",
                "properties" => [
                    "billing_period" => "3 Year"
                ],
                "lines" => [
                    [
                        "op" => "change",
                        "uuid" => "b2b4e5ba-b5d4-41da-81b7-a8d307cb80a1",
                        "item_order_quantity" => "3",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price" => "6.000000"
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $id='ORD-76GOU2-1265';
        try {
            $response = $this->orderService->change($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateWithFamilyType()
    {
        $params = [
            "order" => [
                "account_id" => "IE1DSN",
                "allow_contract" => "True",
                "contract_properties" => [
                    "require_customer_acceptance" => "True",
                    "requires_payment_method" => "False",
                    "initial_contract_term" => "1 Year",
                    "renew_automatically" => "True",
                    "auto_renewal_term" => "1 Week",
                    "allow_early_termination" => "True",
                    "early_termination_minimum_period" => "1 Day",
                    "apply_early_termination_charge" => "False",
                    "allow_postponement" => "True",
                    "maximum_duration_per_postponement" => "1 Day",
                    "maximum_postponement_count" => "1",
                    "allow_trial" => "True",
                    "start_contract_after_trial_ends" => "True",
                    "trial_period" => "1 day",
                    "allow_downgrade" => "True",
                    "period_before_downgrade" => "1 Day",
                    "allow_downgrade_charge" => "True",
                    "downgrade_charge_type" => "Fixed",
                    "downgrade_charge_fixed" => "1.000000",
                    "allow_upgrade" => "True"
                ],
                "lines" => [
                    [
                        "item_id" => "ITEM-0024",
                        "package_name" => "lite package",
                        "item_order_quantity" => "1",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price" => "2.000000"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->createWithFamilyType($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDowngrade()
    {
        $id = "ORD-76GOU2-1267";
        $params = [
            "effective_date" => "2024-12-19",
            "lines" => [
                [
//                    "item_id" => "ITEM-0326",
//                    "item_name" => "fitem",
                    "charge_item_uuid" => "6f7c4f5b-74d5-45bc-a29c-5756479ab9dd",
                    "package_name" => "basic package",
                    "quantity" => "10",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "1.000000"
                        ]
                    ],
                    "discount" => "10.00",
                    "discount_type" => "PERCENTAGE",
                    "shipping_cost" => "0.00",
                    "uom" => "kilogram",
                    "warehouse" => "BrandNet",
                    "is_tax_exempt_when_sold" => "false",
                    "item_price_tax" => [
                        "uuid" => "E2C16096-06B5-42A8-8F2A-743D7F35F9D9",
                        "code" => "GST",
                        "rate" => "10.000000"
                    ],
                    "accounting_code" => "Sales Revenue",
                    "item_invoice_note" => "this is an invoice note",
                    "item_description" => "One hot day, a thirsty crow flew all over the fields looking for water. For a long time, he could not find any.",
                    "item_custom_attributes" => [
                        [
                            "name" => "cus_attr_number",
                            "value" => ""
                        ],
                        [
                            "name" => "cus_attr_string",
                            "value" => ""
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->downgrade($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpgrade()
    {
        $id = "ORD-76GOU2-1267";
        $params = [
            "effective_date" => "2024-11-14",
            "effective_immediately" => true,
//            "redemption_code" => "89369323",
//            "discount_percentage" => "10",
            "billing_period"=> "1 Month",
            "note"=> "Upgrade",
            "lines" => [
                [
//                    "item_id" => "ITEM-0027",
//                    "item_name" => "recuring family item",
                    "charge_item_uuid"=> "e62b6cc0-24d4-45e7-bede-5db17d3f7bb8",
                    "package_name" => "standard package",
                    "quantity" => "10",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "10.000000"
                        ]
                    ],
                    "discount" => "9.99",
                    "shipping_cost" => "2.50",
                    "uom" => "kilogram",
                    "warehouse" => "warehouse1",
                    "is_tax_exempt_when_sold" => "false",
                    "item_price_tax" => [
                        "uuid" => "d166b28c-395b-4692-87b9-7408a01b72c0",
                        "code" => "GST",
                        "rate" => "10.000000"
                    ],
                    "accounting_code" => "Sales Revenue",
                    "item_invoice_note" => "this is an invoice note",
                    "item_description" => "One hot day, a thirsty crow flew all over the fields looking for water. For a long time, he could not find any.",
                    "item_custom_attributes" => [
                        [
                            "name" => "cus_attr_number",
                            "value" => ""
                        ],
                        [
                            "name" => "cus_attr_string",
                            "value" => ""
                        ]
                    ]
                ]
            ]
        ];


        try {
            $response = $this->orderService->upgrade($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpgradePreview()
    {
        $id = "ORD-76GOU2-1267";
        $params = [
            "effective_date" => "2024-11-14",
            "effective_immediately" => true,
//            "redemption_code" => "89369323",
//            "discount_percentage" => "10",
            "billing_period"=> "1 Month",
            "note"=> "Upgrade",
            "lines" => [
                [
//                    "item_id" => "ITEM-0027",
//                    "item_name" => "recuring family item",
                    "charge_item_uuid"=> "e62b6cc0-24d4-45e7-bede-5db17d3f7bb8",
                    "package_name" => "standard package",
                    "quantity" => "10",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "10.000000"
                        ]
                    ],
                    "discount" => "9.99",
                    "shipping_cost" => "2.50",
                    "uom" => "kilogram",
                    "warehouse" => "warehouse1",
                    "is_tax_exempt_when_sold" => "false",
                    "item_price_tax" => [
                        "uuid" => "d166b28c-395b-4692-87b9-7408a01b72c0",
                        "code" => "GST",
                        "rate" => "10.000000"
                    ],
                    "accounting_code" => "Sales Revenue",
                    "item_invoice_note" => "this is an invoice note",
                    "item_description" => "One hot day, a thirsty crow flew all over the fields looking for water. For a long time, he could not find any.",
                    "item_custom_attributes" => [
                        [
                            "name" => "cus_attr_number",
                            "value" => ""
                        ],
                        [
                            "name" => "cus_attr_string",
                            "value" => ""
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->upgradePreview($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDowngradePreview()
    {
        $id = "ORD-76GOU2-1267";
        $params = [
            "effective_date" => "2024-12-19",
            "lines" => [
                [
//                    "item_id" => "ITEM-0326",
//                    "item_name" => "fitem",
                    "charge_item_uuid" => "6f7c4f5b-74d5-45bc-a29c-5756479ab9dd",
                    "package_name" => "basic package",
                    "quantity" => "10",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "1.000000"
                        ]
                    ],
                    "discount" => "10.00",
                    "discount_type" => "PERCENTAGE",
                    "shipping_cost" => "0.00",
                    "uom" => "kilogram",
                    "warehouse" => "BrandNet",
                    "is_tax_exempt_when_sold" => "false",
                    "item_price_tax" => [
                        "uuid" => "E2C16096-06B5-42A8-8F2A-743D7F35F9D9",
                        "code" => "GST",
                        "rate" => "10.000000"
                    ],
                    "accounting_code" => "Sales Revenue",
                    "item_invoice_note" => "this is an invoice note",
                    "item_description" => "One hot day, a thirsty crow flew all over the fields looking for water. For a long time, he could not find any.",
                    "item_custom_attributes" => [
                        [
                            "name" => "cus_attr_number",
                            "value" => ""
                        ],
                        [
                            "name" => "cus_attr_string",
                            "value" => ""
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->downgradePreview($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateExpress()
    {
        $params = [
            "account" => [
                "id" => "IE1DSN",
                "order" => [
                    "lines" => [
                        [
                            "item_id" => "addon_family",
                            "item_order_quantity" => 1,
                            "discount" => "5",
                            "discount_type" => "FIXED",
                            "item_price_snapshot" => [
                                "pricing_rule" => [
                                    "price" => "36.00"
                                ]
                            ],
                            "item_price_tax" => [
                                "uuid" => "5da85c94-2c63-409b-a2ab-41094582df26",
                                "code" => "FRE",
                                "rate" => 0
                            ],
                            "package_name" => "monthly package"
                        ]
                    ],
                    "invoice" => [
                        "payment" => [
                            "payment_applied" => [
                                [
                                    "processor" => "Cash",
                                    "amount" => "36"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->createExpress($params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testChangePaymentMethod()
    {
        $params = [
            "order" => [
                "payment_methods" => "anytype"
            ]
        ];

        $id='ORD-76GOU2-1273';
        try {
            $response= $this->orderService->changePaymentMethod($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatePreorder()
    {
        $params = [
            "order" => [
                "pre_order" => "true",
                "account_id" => "J51VQS",
                "price_tax_inclusive" => "true",
                "lines" => [
                    [
                        "item_id" => "ITEM-0032",
                        "item_order_quantity" => "20",
                    ]
                ]
            ]
        ];
        try {
            $response = $this->orderService->createPreorder($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testPreOrderRelinquish()
    {
        $params = [
            "order" => [
                "effective_date" => "2024-12-18"
            ]
        ];
        $id = 'ORD-76GOU2-1272';

        try {
            $response = $this->orderService->preOrderRelinquish($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id = "ORD-76GOU2-1271";
        try {
            $response = $this->orderService->delete($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testChangePreview()
    {
        $params = [
            "order" => [
                "effective_date" => "2024-12-19",
                "properties" => [
                    "billing_period" => "1 Year"
                ],
                "lines" => [
                    [
                        "op" => "change",
                        "uuid" => "4250876d-6df3-42c0-bb76-13ae533df93a",
                        "item_order_quantity" => "3",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price" => "5.000000"
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $id='ORD-IE1DSN-1276';
        try {
            $response = $this->orderService->changePreview($params, $id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testContractAdjustmentPreview()
    {
        $id = "ORD-76GOU2-1288";
        $params = [
            "effective_date" => "2025-01-05",
            "effective_immediately" => true,
            "lines" => [
                [
                    "item_uuid"=> "963411ff-3387-4730-9c07-a3466b17dc4e",
                    "charge_item_uuid"=> "b926b462-4c8d-4353-9d42-dcba4b4f76d7",
                    "package_name" => "standard package",
                    "quantity" => "10",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "10.000000"
                        ]
                    ],
                    "discount" => "9.99",
                    "shipping_cost" => "2.50",
                    "uom" => "kilogram",
                    "warehouse" => "warehouse1",
                    "is_tax_exempt_when_sold" => "false",
                    "item_price_tax" => [
                        "uuid" => "d166b28c-395b-4692-87b9-7408a01b72c0",
                        "code" => "GST",
                        "rate" => "10.000000"
                    ],
                    "accounting_code" => "Sales Revenue",
                    "item_invoice_note" => "this is an invoice note",
                    "item_description" => "One hot day, a thirsty crow flew all over the fields looking for water. For a long time, he could not find any.",
                    "item_custom_attributes" => [
                        [
                            "name" => "cus_attr_number",
                            "value" => ""
                        ],
                        [
                            "name" => "cus_attr_string",
                            "value" => ""
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->contractAdjustmentPreview($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testContractAdjustment()
    {
        $id = "ORD-IG6S6H-0053";
        $params = [
            "effective_date" => "2025-03-11",
            "effective_immediately" => true,
            "lines" => [
                [
                    "item_uuid"=> "dc4c0d76-f6f3-443c-8636-e1ab19d5b024",
                    "charge_item_uuid"=> "7788c880-69d6-4793-9e08-9c711ea32c54",
                    "package_name" => "f2",
                    "quantity" => "1",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "10.000000"
                        ]
                    ],
                    "discount" => "9.99",
                    "shipping_cost" => "2.50",
//                    "uom" => "kilogram",
//                    "warehouse" => "warehouse1",
//                    "is_tax_exempt_when_sold" => "false",
//                    "item_price_tax" => [
//                        "uuid" => "d166b28c-395b-4692-87b9-7408a01b72c0",
//                        "code" => "GST",
//                        "rate" => "10.000000"
//                    ],
//                    "accounting_code" => "Sales Revenue",
//                    "item_invoice_note" => "this is an invoice note",
//                    "item_description" => "One hot day, a thirsty crow flew all over the fields looking for water. For a long time, he could not find any.",
//                    "item_custom_attributes" => [
//                        [
//                            "name" => "cus_attr_number",
//                            "value" => ""
//                        ],
//                        [
//                            "name" => "cus_attr_string",
//                            "value" => ""
//                        ]
//                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->contractAdjustment($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




}


$orderManager = new OrderManager();
//    $orderManager->testReadAll();
//    $orderManager->testCreateOrderUsages();
//    $orderManager->testReadInformation();
//    $orderManager->testChangeInformation();
//    $orderManager->testDelete();
//    $orderManager->testReactivate();
//    $orderManager->testChange();
//    $orderManager->testReadAccountOrders();
//    $orderManager->testReadBillingPreferences();
//    $orderManager->testReadOrderLines();
//    $orderManager->testReadDetailsOrderLine();
//    $orderManager->testChangeOrderLineInformation();
//    $orderManager->testCreateOrderWithPurchase();
//    $orderManager->testChangeBillingPreferences();
//    $orderManager->testUpdateBillingPreferences();
//    $orderManager->testReadDetails();
//    $orderManager->testCreate();
//    $orderManager->testCancel();
//    $orderManager->testCreateWithFamilyType();
//    $orderManager->testUpgrade();
//    $orderManager->testDowngrade();
//    $orderManager->testCreatePreorder();
//    $orderManager->testCreateExpress();
//    $orderManager->testUpgradePreview();
//    $orderManager->testDowngradePreview();
//    $orderManager->testChangePaymentMethod();
//    $orderManager->testPreOrderRelinquish();
//    $orderManager->testChangePreview();
//    $orderManager->testContractAdjustmentPreview();
    $orderManager->testContractAdjustment();

