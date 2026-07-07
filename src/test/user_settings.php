<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\UserSettings\UserSettingsData;
use Api\ApiHelper\Config\ConfigManager;

class UserSettingsManager
{
    private $userSettingsService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->userSettingsService = new UserSettingsData($apiConfig);
    }

    public function testReadUserSettings()
    {
        $userUuid = '30f2088e-6f2f-4e51-b349-5247c618119f';
        try {
            $response = $this->userSettingsService->readUserSettings($userUuid, 'v2');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$userSettingsManager = new UserSettingsManager(0);
//$userSettingsManager->testReadUserSettings();
