<?php

namespace Api\AppService\Labour;

use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

class LabourData
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
                ApiResource::LABOURS,
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

    public function details($labourUUID, $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::LABOURS,
                AutoBillApiSchemeHelper::GET,
                $labourUUID,
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
                ApiResource::LABOURS,
                AutoBillApiSchemeHelper::POST,
                null,
                $params,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function update($labourUUID, $params = [], $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::LABOURS,
                AutoBillApiSchemeHelper::PATCH,
                $labourUUID,
                $params,
                null,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function delete($labourUUID, $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::LABOURS,
                AutoBillApiSchemeHelper::DELETE,
                $labourUUID,
                [],
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function availableForBooking($queryParams = null, $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $path = "api/{$apiVersion}/" . ApiResource::LABOURS . "/available-for-booking";
            if ($queryParams && is_array($queryParams)) {
                $path .= '?' . http_build_query($queryParams);
            }
            return $requestBuilder->customRequest($path, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readOrders($labourUUID, $apiVersion = null, $queryParams = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            $attribute = "$labourUUID/orders";
            return $requestBuilder->callResourceAttribute(ApiResource::LABOURS, AutoBillApiSchemeHelper::GET, null, [], $attribute, $apiVersion, $queryParams);
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
