<?php
namespace Api\AppService\Event;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;


class EventData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function readAll($apiVersion = null) {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::EVENT, AutoBillApiSchemeHelper::GET,null,[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetails($uuId,$apiVersion = null) {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::EVENT, AutoBillApiSchemeHelper::GET,$uuId,[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function remove($uuId,$apiVersion = null) {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::EVENT, AutoBillApiSchemeHelper::POST,$uuId,null,'remove',$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

}
