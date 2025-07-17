<?php

namespace Api\ApiHelper\Config;

use Api\ApiHelper\Communicator\AutoBillApiCaller;
use Api\ApiHelper\Communicator\Data\AutoBillAuthCredentialData;
use Api\ApiHelper\SdkVersionManager;
use Dotenv\Dotenv;

class ConfigManager
{
    private $httpCommunicator;
    private static $sdkConfig = [];

    /**
     * ConfigManager constructor.
     */
    public function __construct()
    {
        $rootDir = dirname(__DIR__, 3);
        $sdkConfigPath = $rootDir . '/sdk-config.json';
        $getSdkConfigObject = file_get_contents($sdkConfigPath);
        self::$sdkConfig = json_decode($getSdkConfigObject, true);

        $apiVersion = self::$sdkConfig['apiVersion'] ?? 'v2';
        SdkVersionManager::setApiVersion($apiVersion);

        $this->httpCommunicator = AutoBillApiCaller::getInstance(self::$sdkConfig['reQuestTimeOut'] ?? 240);
    }

    public static function getSdkConfig(): array
    {
        return self::$sdkConfig;
    }


    /**
     * Loads API configuration from token.json
     * @return AutoBillAuthCredentialData
     */
    public function getConfig($index = 0)
    {
        $rootDir = dirname(__DIR__, 3);
        $publicPath = $rootDir . '/token.json';

        $getJsonObject = file_get_contents($publicPath);
        $jsonArray = json_decode($getJsonObject, true);

        if (!isset($jsonArray[$index])) {
            throw new \Exception("No config found at index $index");
        }

        $jsonObject = (object)$jsonArray[$index];

        $authCredential = new AutoBillAuthCredentialData([
            'apiUrl' => $jsonObject->apiUrl,
            'appUrl' => $jsonObject->appUrl,
            'client_id' => $jsonObject->client_id,
            'client_secret' => $jsonObject->client_secret,
            'access_token' => $jsonObject->access_token,
            'refresh_token' => $jsonObject->refresh_token,
            'redirect_uri' => $jsonObject->redirect_uri,
            'file_path' => $publicPath,
            'authTokenRenewCallback' => function ($authCredentialData) use (&$jsonArray, $index, $publicPath) {
                $jsonArray[$index] = (array) $authCredentialData;
                file_put_contents($publicPath, json_encode($jsonArray, JSON_PRETTY_PRINT));
            }
        ]);

        return $authCredential;
    }

    /**
     * Sends a POST request to fetch the access token
     * @param string $apiUrl
     * @param array $params
     * @return mixed
     */
    public function getAccessToken($apiUrl, $params = [])
    {
        return $this->httpCommunicator->POST_JSON($apiUrl, $params);
    }
}
