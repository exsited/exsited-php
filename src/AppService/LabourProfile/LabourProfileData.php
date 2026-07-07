<?php

namespace Api\AppService\LabourProfile;

use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

class LabourProfileData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function listAll($apiVersion = 'v3', $queryParams = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::LABOUR_PROFILES,
                AutoBillApiSchemeHelper::GET,
                null,
                [],
                $apiVersion,
                $queryParams
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function details($labourProfileUUID, $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::LABOUR_PROFILES,
                AutoBillApiSchemeHelper::GET,
                $labourProfileUUID,
                [],
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function create($params = [], $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::LABOUR_PROFILES,
                AutoBillApiSchemeHelper::POST,
                null,
                $params,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function update($labourProfileUUID, $params = [], $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::LABOUR_PROFILES,
                AutoBillApiSchemeHelper::PATCH,
                $labourProfileUUID,
                $params,
                null,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function delete($labourProfileUUID, $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::LABOUR_PROFILES,
                AutoBillApiSchemeHelper::DELETE,
                $labourProfileUUID,
                [],
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function customRequest($path, $requestMethod, $params = null, $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $fullPath = "api/{$apiVersion}/{$path}";
            return $requestBuilder->customRequest($fullPath, $requestMethod, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
}
