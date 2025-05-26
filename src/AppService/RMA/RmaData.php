<?php

namespace Api\AppService\Rma;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;


class RmaData
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
            return $requestBuilder->callResource(ApiResource::RMA, AutoBillApiSchemeHelper::GET,null,[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readDetails($id,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::RMA, AutoBillApiSchemeHelper::GET,$id,[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readInvoiceRmaReceiveAll($id,$invoiceId,$apiVersion = null)
    {
        $attributes="return-merchandise-authorisations/$id/receive";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET,$invoiceId,[],$attributes,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readInvoiceAllRma($invoiceId,$apiVersion = null)
    {
        $attributes="return-merchandise-authorisations";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET,$invoiceId,[],$attributes,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createInvoiceRma($invoiceId,$params,$apiVersion = null)
    {
        $attributes="return-merchandise-authorisations";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::POST,$invoiceId,$params,$attributes,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    
    public function readInvoiceRmaDetails($invoiceId,$id,$apiVersion = null)
    {
        $attributes="return-merchandise-authorisations/$id";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET,$invoiceId,[],$attributes,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createInvoiceRmaReceive($id,$invoiceId,$params,$apiVersion = null)
    {
        $attributes="return-merchandise-authorisations/$id/receive";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::POST,$invoiceId,$params,$attributes,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }



}