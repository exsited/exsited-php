<?php

namespace Api\AppService\LabourAvailability;

use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

class LabourAvailabilityData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function listAll($queryParams = null, $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $path = "api/{$apiVersion}/" . ApiResource::LABOUR_AVAILABILITY;
            if ($queryParams && is_array($queryParams)) {
                $path .= '?' . http_build_query($queryParams);
            }
            return $requestBuilder->customRequest($path, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function details($availabilityUUID, $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::LABOUR_AVAILABILITY,
                AutoBillApiSchemeHelper::GET,
                $availabilityUUID,
                [],
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function update($params = [], $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $path = "api/{$apiVersion}/" . ApiResource::LABOUR_AVAILABILITY;
            return $requestBuilder->customRequest($path, AutoBillApiSchemeHelper::PATCH, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function updateByUUID($availabilityUUID, $params = [], $apiVersion = 'v3')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::LABOUR_AVAILABILITY,
                AutoBillApiSchemeHelper::PATCH,
                $availabilityUUID,
                $params,
                null,
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
