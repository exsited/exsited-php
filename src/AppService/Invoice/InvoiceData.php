<?php


namespace Api\AppService\Invoice;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

Class InvoiceData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig){
        $this->apiConfig=$apiConfig;
    }

    public function readALl($apiVersion = null){
        try{
            $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET,null,[],$apiVersion);
        } catch (AutoBillApiException $e){
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetails($id,$apiVersion = null){
        try {
            $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET, $id,[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function readOrderInvoice($orderId,$apiVersion = null)
    {
        try {
            $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $orderId, [], 'invoices',$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createOrderInvoice($params ,$orderId,$apiVersion = null)
    {
        try {
            $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST, $orderId, $params, 'invoices',$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function readDetailsInformation($id,$apiVersion = null)
    {
        try {
            $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET, $id, [], 'information',$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readAccountInvoices($accountID, $params = [],$apiVersion = null)
    {
        try {
            $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountID, $params, 'invoices',$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function createAmend($params,$id,$apiVersion = null)
    {
        try {
            $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::POST, $id, $params, 'amend', $apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function delete($id,$apiVersion = null){
        try{
            $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::INVOICE, AutoBillApiSchemeHelper::DELETE,$id,[],$apiVersion);
        } catch (AutoBillApiException $e){
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPdf($id,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET, $id . '/pdf',[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


}