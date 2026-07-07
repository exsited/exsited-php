<?php

namespace Api\AppService\Alert;

use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

class AlertData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function readAll($queryParams = null, $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? 'v2';

            $queryString = '';
            if ($queryParams && is_array($queryParams)) {
                $queryString = '?' . http_build_query($queryParams);
            }

            $path = "api/{$apiVersion}/" . ApiResource::ALERT;
            if ($queryString) {
                $path .= $queryString;
            }

            return $requestBuilder->customRequest($path, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readByAccount($accountId, $queryParams = null, $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? 'v2';

            $queryString = '';
            if ($queryParams && is_array($queryParams)) {
                $queryString = '?' . http_build_query($queryParams);
            }

            $path = "api/{$apiVersion}/" . ApiResource::ALERT . "/account/{$accountId}";
            if ($queryString) {
                $path .= $queryString;
            }

            return $requestBuilder->customRequest($path, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readByLabour($labourId, $queryParams = null, $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? 'v2';

            $queryString = '';
            if ($queryParams && is_array($queryParams)) {
                $queryString = '?' . http_build_query($queryParams);
            }

            $path = "api/{$apiVersion}/" . ApiResource::ALERT . "/labour/{$labourId}";
            if ($queryString) {
                $path .= $queryString;
            }

            return $requestBuilder->customRequest($path, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readByEmployee($employeeId, $queryParams = null, $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? 'v2';

            $queryString = '';
            if ($queryParams && is_array($queryParams)) {
                $queryString = '?' . http_build_query($queryParams);
            }

            $path = "api/{$apiVersion}/" . ApiResource::ALERT . "/employee/{$employeeId}";
            if ($queryString) {
                $path .= $queryString;
            }

            return $requestBuilder->customRequest($path, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
}
