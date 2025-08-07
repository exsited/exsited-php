<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Item\ItemData;
use Api\ApiHelper\Config\ConfigManager;

class ItemManager
{
    private $itemService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->itemService = new ItemData($apiConfig);
    }

    public function testReadAll(){
        try {
            $response = $this->itemService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id = 'ITEM-0024';
        try {
            $response = $this->itemService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsInformation()
    {
        $id = 'ITEM-0024';
        try {
            $response = $this->itemService->readDetailsInformation($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetailsSale()
    {
        $id = 'ITEM-0024';
        try {
            $response = $this->itemService->readDetailsSale($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsPurchase()
    {
        $id = 'ITEM-0012';
        try {
            $response = $this->itemService->readDetailsPurchase($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsInventories()
    {
        $id = 'ITEM-0012';
        try {
            $response = $this->itemService->readDetailsInventories($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreate()
    {
        $params = [
            "items" => [
                "name" => "Special Item",
                "display_name" => "from SDK API",
                "description" => "description",
                "type" => "STANDARD",
                "invoice_note" => "item invoice note 222",
                "origin" => "NET_SUITE",
                "currencies" => [
                    [
                        "name" => "AUD",
                        "isUsedForSale" => "true",
                        "isDefaultForSale" => "true",
                        "isUsedForPurchase" => "true",
                        "isDefaultForPurchase" => "true"
                    ],
                ],
                "uoms" => [
                    [
                        "name" => "Gram",
                        "isBase" => "true",
                        "saleConversionRate" => "1",
                        "purchaseConversionRate" => "5",
                        "isUsedForSale" => "true",
                        "isUsedForPurchase" => "true"
                    ]
                ]
            ]
        ];

        try {
            $response = $this->itemService->create($params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate()
    {
        $id="ITEM-0037";
        $params = [
            "items" => [
                "name" => "update",
                "display_name" => "update from API",
                "description" => "update description",
                "invoice_note" => "item invoice note 222",
                "origin" => "NET_SUITE",
                "currencies" => [
                    [
                        "name" => "AUD",
                        "isUsedForSale" => "true",
                        "isDefaultForSale" => "true",
                        "isUsedForPurchase" => "true",
                        "isDefaultForPurchase" => "true"
                    ],
                    [
                        "name" => "USD",
                        "isUsedForSale" => "true",
                        "isDefaultForSale" => "false",
                        "isUsedForPurchase" => "true",
                        "isDefaultForPurchase" => "false"
                    ]
                ],
                "uoms" => [
                    [
                        "name" => "Gram",
                        "isBase" => "true",
                        "saleConversionRate" => "2",
                        "purchaseConversionRate" => "5",
                        "isUsedForSale" => "true",
                        "isUsedForPurchase" => "true"
                    ]
                ]
            ]
        ];

        try {
            $response = $this->itemService->update($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id = 'ITEM-0038';
        try {
            $response = $this->itemService->delete($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateSale()
    {
        $params = [
            "items" => [
                "uoms" => [],
                "currencies" => [
                    [
                        "name" => "AUD",
                        "isDefaultForSale" => "true",
                        "isUsedForSale" => "true"
                    ],
                    [
                        "name" => "BDT",
                        "isDefaultForSale" => "true",
                        "isUsedForSale" => "true"
                    ]
                ],
                "sale" => [
                    "isEnabled" => "true",
                    "invoice_note" => "invoice note",
                    "accounting_code" => "Sales Revenue",
                    "default_sale_currency" => "AUD",
                    "default_sale_price" => "30.00",
                    "isTaxExemptWhenSold" => "true",
                    "pricing_method" => "STANDARD",
                    "tax_configuration" => [
                        "sale_price_entered_is_inclusive_of_tax" => "true",
                        "sale_price_is_based_on" => "SPECIFIC_TAX_CODE",
                        "tax_code" => [
                            "uuid" => "E2C16096-06B5-42A8-8F2A-743D7F35F9D9",
                            "code" => "GST",
                            "rate" => "10.000000"
                        ]
                    ],
                    "charge" => [
                        "type" => "ONE_OFF"
                    ],
                    "pricing" => [
                        "type" => "PER_UNIT_PRICING",
                        "pricing_module" => [
                            [
                                "price" => "10.000000",
                                "currency" => "AUD"
                            ],
                            [
                                "price" => "10.000000",
                                "currency" => "BDT"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $id="ITEM-0039";

        try {
            $response = $this->itemService->createSale($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatePurchaseWithoutSupplier()
    {
        $params = [
            "items" => [
                "uoms" => [],
                "currencies" => [
                    [
                        "name" => "AUD",
                        "isDefaultForPurchase" => "true"
                    ]
                ],
                "purchase" => [
                    "isEnabled" => "true",
                    "rate_option" => "PER_UNIT",
                    "supplier_management_isEnabled" => "false",
                    "accounting_code" => "Cost of Goods Sold",
                    "purchase_order_note" => "Cost of Goods Sold",
                    "default_purchase_currency" => "AUD",
                    "default_purchase_price" => "5.000000",
                    "isTaxExemptWhenPurchase" => "true",
                    "pricing_profile" => "",
                    "purchase_properties" => [
                        [
                            "name" => "receive_mode",
                            "value" => "MANUAL"
                        ],
                        [
                            "name" => "receive_term",
                            "value" => "Immediately"
                        ]
                    ],
                    "tax_configuration" => [
                        "purchase_price_entered_is_inclusive_of_tax" => "true",
                        "tax_code" => [
                            "uuid" => "E2C16096-06B5-42A8-8F2A-743D7F35F9D9",
                            "code" => "GST",
                            "rate" => 10
                        ]
                    ],
                    "pricing" => [
                        "type" => "PER_UNIT_PRICING",
                        "pricing_module" => []
                    ]
                ]
            ]
        ];


        $id="ITEM-0039";

        try {
            $response = $this->itemService->createPurchaseWithoutSupplier($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatePurchaseWithSupplier()
    {
        $params = [
            "items" => [
                "uoms" => [],
                "currencies" => [
                    [
                        "name" => "AUD",
                        "isDefaultForPurchase" => "true"
                    ]
                ],
                "purchase" => [
                    "isEnabled" => "true",
                    "supplier_management_isEnabled" => "true",
                    "default_purchase_currency" => "AUD",
                    "suppliers" => [
                        [
                            "id" => "",
                            "name" => "DEFAULT",
                            "accounting_code" => "Cost of Goods Sold",
                            "purchase_order_note" => "Cost of Goods Sold",
                            "default_purchase_currency" => "AUD",
                            "default_purchase_price" => "5.000000",
                            "isTaxExemptWhenPurchase" => "true",
                            "pricing" => [
                                "type" => "PER_UNIT_PRICING",
                                "pricing_module" => [
                                    [
                                        "price" => "5.000000",
                                        "currency" => "AUD",
                                        "price_type" => "PRICE"
                                    ]
                                ]
                            ]
                        ],
                        [
                            "id" => "EQBP-0000000130", // change it
                            "name" => "supplier", // change it
                            "accounting_code" => "Cost of Goods Sold",
                            "purchase_order_note" => "Cost of Goods Sold",
                            "default_purchase_currency" => "AUD",
                            "default_purchase_price" => "66.000000",
                            "isTaxExemptWhenPurchase" => "true",
                            "pricing" => [
                                "type" => "PER_UNIT_PRICING",
                                "pricing_module" => [
                                    [
                                        "price" => "5.000000",
                                        "currency" => "AUD",
                                        "price_type" => "PRICE"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];


        $id="ITEM-0311";

        try {
            $response = $this->itemService->createPurchaseWithSupplier($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReactivate()
    {

        $id="ITEM-0035";
        try {
            $response = $this->itemService->reactivate($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeactivate()
    {
        $id="ITEM-0035";
        try {
            $response = $this->itemService->deactivate($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadWarehouseInventory()
    {
        $id="ITEM-0030";
        $warehouse="warehouse1";
        try {
            $response = $this->itemService->readWarehouseInventory($id,$warehouse);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreateInventory()
    {

        $params = [
            "item" => [
                "inventories" => [
                    "isEnabled" => "true",
                    "warehouse_isEnabled" => "true",
                    "warehouses" => [
                        [
                            "name" => "BareHouse"
                        ],
                        [
                            "name" => "Boston"
                        ]
                    ],
                    "default_warehouse" => "BareHouse",
                    "inventory_properties" => [
                        "enable_low_stock_notification" => "true",
                        "low_stock_threshold_is_based_on" => "ALL_WAREHOUSE",
                        "low_stock_threshold" => "10",
                        "enable_reordering" => "true",
                        "reordering_threshold_is_based_on" => "ALL_WAREHOUSE",
                        "quantity_available_for_sale_determination" => "QUANTITY_ON_HAND,QUANTITY_PROMISED,QUANTITY_ON_ORDER,QUANTITY_ON_RETURN",
                        "stock_required_for_sale" => "QUANTITY_AVAILABLE",
                        "use_last_purchase_price" => "true",
                        // "preferred_supplier" => "06S1S2",
                        "reordering_threshold" => "5",
                        "enable_preordering" => "false",
                        // "enable_serialization" => "true",
                        // "enable_batch_tracking" => "false",
                        "use_atp_as_quantity_available_for_webhook" => "true"
                    ]
                ]
            ]
        ];

        $id="ITEM-0040";

        try {
            $response = $this->itemService->createInventory($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();

    }    }

    public function testAddInventory()
    {

        $params = [
            "item" => [
                "inventories" => [
                    "warehouses" => [
                        [
                            "name" => "Boston",
                            "quantity" => "55.00",
                            "accounting_code" => "INVENTORY"
                        ],
                        [
                            "name" => "BareHouse",
                            "quantity" => "10.00",
                            "accounting_code" => "INVENTORY"
                        ]
                    ]
                ]
            ]
        ];

        $id="ITEM-0040";

        try {
            $response = $this->itemService->addInventory($params,$id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



}

    $itemManager= new ItemManager();
//    $itemManager->testReadAll();
//    $itemManager->testReadDetails();
//    $itemManager->testReadDetailsInformation();
//    $itemManager->testReadDetailsSale();
//    $itemManager->testReadDetailsPurchase();
//    $itemManager->testReadDetailsInventories();
//    $itemManager->testCreate();
//    $itemManager->testUpdate();
//    $itemManager->testDelete();
//    $itemManager->testCreateSale();
//    $itemManager->testCreatePurchaseWithoutSupplier();
//    $itemManager->testCreatePurchaseWithSupplier();
//    $itemManager->testReactivate();
//    $itemManager->testDeactivate();
//    $itemManager->testReadWarehouseInventory();
//    $itemManager->testCreateInventory();
//    $itemManager->testAddInventory();