<?php

namespace Api\AppService\ExternalDatabase;

use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;


class ExternalDatabaseData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }


    public function readAll($apiVersion = null, $queryParams = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::EXTERNAL_DATABASE, AutoBillApiSchemeHelper::GET, null, [], $apiVersion, $queryParams);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function readDetails($database_name, $apiVersion = null, $queryParams = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            $encodedDatabaseName = rawurlencode($database_name);
            return $requestBuilder->callResource(ApiResource::EXTERNAL_DATABASE, AutoBillApiSchemeHelper::GET, $encodedDatabaseName, [], $apiVersion, $queryParams);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function readTable($database_name, $table_name, $apiVersion = null, $queryParams = null)
    {
        try {
            $encodedDatabaseName = rawurlencode($database_name);
            $encodedTableName = rawurlencode($table_name);
            $path = "$encodedDatabaseName/table/$encodedTableName";
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::EXTERNAL_DATABASE, AutoBillApiSchemeHelper::GET, $path, [], $apiVersion, $queryParams);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function search($database_name, $params, $apiVersion = null)
    {
        try {
            $encodedDatabaseName = rawurlencode($database_name);
            $path = "$encodedDatabaseName/search";
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::EXTERNAL_DATABASE, AutoBillApiSchemeHelper::POST, $path, $params, $apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
}
