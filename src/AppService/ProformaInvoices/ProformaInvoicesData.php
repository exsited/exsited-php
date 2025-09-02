<?php


namespace Api\AppService\ProformaInvoices;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

Class ProformaInvoicesData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig){
        $this->apiConfig=$apiConfig;
    }


    public function readAllProformaInvoices($apiVersion = null){
        try{
            $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::PROFORMA_INVOICES, AutoBillApiSchemeHelper::GET,null,[],$apiVersion);
        } catch (AutoBillApiException $e){
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function readProformaInvoicesDetails($id,$apiVersion = null){
            try {
                $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
                $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
                return $requestBuilder->callResource(ApiResource::PROFORMA_INVOICES, AutoBillApiSchemeHelper::GET, $id,[],$apiVersion);
            } catch (AutoBillApiException $e) {
                throw new AutoBillApiException($e->getMessage());
            }
        }


    public function createProformaInvoices($id, $params ,$apiVersion = null)
    {
        try {
            $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PROFORMA_INVOICES, AutoBillApiSchemeHelper::POST, $id, $params, 'payments',$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }



}