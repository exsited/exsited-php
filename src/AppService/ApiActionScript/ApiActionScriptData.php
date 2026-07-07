<?php

namespace Api\AppService\ApiActionScript;

use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

class ApiActionScriptData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function execute($scriptUUID, $payload, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            $queryParams = ['autoBillScriptUuid' => $scriptUUID];
            return $requestBuilder->callResource(ApiResource::API_ACTION_SCRIPT, AutoBillApiSchemeHelper::PATCH, null, $payload, $apiVersion, $queryParams);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
}
