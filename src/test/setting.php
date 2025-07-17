<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Setting\SettingData;
use Api\ApiHelper\Config\ConfigManager;

class SettingManager
{
    private $settingService;

    public function __construct($index = 0)
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig($index);
        $apiConfig = new ApiConfig($authCredentialData);
        $this->settingService = new SettingData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->settingService->readAll('v3');
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
            $response = $this->settingService->readItemGroups('v3');
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
            $response = $this->settingService->readAllWarehouse('v3');
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
// $settingManager->testReadShippingProfiles();
// $settingManager->testReadAllWarehouse();
// $settingManager->testReadWarehouseDetails();
// $settingManager->testReadRedemptionCodeDetails();
//$settingManager->testReadCustomAttributeDetails();