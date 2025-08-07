<?php

namespace Api\AppService\Integration;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;


class IntegrationData
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
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION_CONNECTIONS, AutoBillApiSchemeHelper::GET, null,[],null, $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function create($params, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST,null,$params,null,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function delete($uuid,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::DELETE,$uuid,[],null,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function enable($uuid,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST,$uuid,null, "enable" ,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function disable($uuid,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST,$uuid,null,"disable",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function read($uuid, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION_CONNECTIONS, AutoBillApiSchemeHelper::GET, $uuid, null,null, $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPartner($integrationUuid, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::GET, $integrationUuid, null,'partner-function', $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPartnerDetails($integrationUuid, $partnerUuid, $apiVersion = null)
    {
        $attribute = "partner-function/$partnerUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::GET, $integrationUuid, null, $attribute, $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readAutomation($integrationUuid, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::GET, $integrationUuid, null,'automation/', $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readAutomationDetails($integrationUuid, $automationUuid, $apiVersion = null)
    {
        $attribute = "automation/$automationUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::GET, $integrationUuid, null, $attribute, $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createPartnerFunction($integrationUuid, $params, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST, $integrationUuid, $params, 'partner-function', $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function updateConfiguration($uuid, $params, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::PATCH,$uuid,$params,'configuration',$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function updatePartnerDetails($integrationUuid, $partnerUuid, $params, $apiVersion = null)
    {
        $attribute = "partner-function/$partnerUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::PATCH, $integrationUuid, $params, $attribute, $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function deletePartnerDetails($integrationUuid, $partnerUuid, $apiVersion = null)
    {
        $attribute = "partner-function/$partnerUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::DELETE, $integrationUuid, null, $attribute, $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function checkConnection($integrationUuid, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST, $integrationUuid, null,'check-connection', $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function automationDisable($integrationUuid, $automationUuid, $apiVersion = null)
    {
        $attribute = "automation/$automationUuid/disable";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST, $integrationUuid, null, $attribute, $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function automationEnable($integrationUuid, $automationUuid, $apiVersion = null)
    {
        $attribute = "automation/$automationUuid/enable";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST, $integrationUuid, null, $attribute, $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addAutomation($integrationUuid, $params, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST, $integrationUuid, $params,'automation', $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function updateAutomation($integrationUuid, $automationUuid, $params, $apiVersion = null)
    {
        $attribute = "automation/$automationUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::PATCH, $integrationUuid, $params,$attribute, $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function deleteAutomation($automationUuid, $apiVersion = null)
    {
        $attWithId = "automation/$automationUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::DELETE, $attWithId, null,null, $apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function partnerFunctionDisable($integrationUuid, $partnerFunctionUuid, $apiVersion = null)
    {
        $attribute = "partner-function/$partnerFunctionUuid/disable";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST, $integrationUuid, null, $attribute, $apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function partnerFunctionEnable($integrationUuid, $partnerFunctionUuid, $apiVersion = null)
    {
        $attribute = "partner-function/$partnerFunctionUuid/enable";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST, $integrationUuid, null, $attribute, $apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readIntegrationConfiguration($integrationUuid, $apiVersion = null)
    {
        $attribute = "configuration";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::INTEGRATION,
                AutoBillApiSchemeHelper::GET,
                $integrationUuid,
                null,
                $attribute,
                $apiVersion
            );
        }
        catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getIntegrationCurrencies($integrationUuid, $apiVersion = null)
    {
        $attribute = "integration/$integrationUuid/currency";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::GET, $integrationUuid, null, $attribute, $apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function disableIntegrationCurrency($integrationUuid, $currencyName, $apiVersion = null)
    {
        $attribute = "currency/$currencyName/disable";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST, $integrationUuid, null, $attribute, $apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function enableIntegrationCurrency($integrationUuid, $currencyName, $apiVersion = null)
    {
        $attribute = "currency/$currencyName/enable";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INTEGRATION, AutoBillApiSchemeHelper::POST, $integrationUuid, null, $attribute, $apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function syncCurrencies($integrationUuid, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion     = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::INTEGRATION,
                AutoBillApiSchemeHelper::POST,
                $integrationUuid,
                null,
                'sync-currencies',
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function syncAccountingCodes($integrationUuid, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion     = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::INTEGRATION,
                AutoBillApiSchemeHelper::POST,
                $integrationUuid,
                null,
                'sync-accounting-codes',
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function syncTaxes($integrationUuid, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion     = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::INTEGRATION,
                AutoBillApiSchemeHelper::POST,
                $integrationUuid,
                null,
                'sync-taxes',
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function linkItems($integrationUuid, $params = [], $apiVersion = null)
    {
        $attribute = 'link-items';
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::INTEGRATION,
                AutoBillApiSchemeHelper::POST,
                $integrationUuid,
                $params,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function unlinkItems($integrationUuid, $params = [], $apiVersion = null)
    {
        $attribute = 'unlink-items';
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::INTEGRATION,
                AutoBillApiSchemeHelper::POST,
                $integrationUuid,
                $params,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

}