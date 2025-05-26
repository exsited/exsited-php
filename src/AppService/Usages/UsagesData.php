<?php

namespace Api\AppService\Usages;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

class UsagesData
{

    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function readAll($apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::USAGES, AutoBillApiSchemeHelper::GET,null,[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readDetails($uuId,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::USAGES, AutoBillApiSchemeHelper::GET,$uuId,[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function change($uuId,$params,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::USAGES, AutoBillApiSchemeHelper::PATCH,$uuId,$params,null,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function update($uuId,$params,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::USAGES, AutoBillApiSchemeHelper::PUT,$uuId,$params,null,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function delete($uuId,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::USAGES, AutoBillApiSchemeHelper::DELETE,$uuId,[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

}



