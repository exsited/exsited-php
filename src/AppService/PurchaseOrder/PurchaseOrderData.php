<?php

namespace Api\AppService\PurchaseOrder;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;


class PurchaseOrderData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }
    public function readAll($apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET,null,[], $apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function change($params,$id,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::PATCH, $id,$params,"information",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readDetails($id,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $id,[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readDetailsInformation($id,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $id,[],'information',$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readLines($id,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $id,[],'lines',$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readLineDetails($id,$lineUUID,$apiVersion = null){

        $attribute="lines/".$lineUUID;

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $id,[],$attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readAccountPurchaseOrders($accountId,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountId,[],ApiResource::PURCHASE_ORDER,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function create($params,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::POST, null,$params,null,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function delete($id,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::DELETE, $id,[],null,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function cancel($id,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::POST, $id,null,"cancel",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function reactivate($id,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::POST, $id,null,"reactivate",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


}