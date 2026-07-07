<?php

namespace Api\AppService\Approval;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

class ApprovalData
{

    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function getSaleOrderApprovals($queryParams = null, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            $subPath = 'saleOrder';
            if ($queryParams !== null && is_string($queryParams)) {
                $subPath .= $queryParams;
            }
            return $requestBuilder->callResourceWithSubPath(
                ApiResource::APPROVALS,
                AutoBillApiSchemeHelper::GET,
                $subPath,
                null,
                $apiVersion,
                is_array($queryParams) ? $queryParams : null
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getTimesheetApprovals($queryParams = null, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            $subPath = 'timesheet';
            if ($queryParams !== null && is_string($queryParams)) {
                $subPath .= $queryParams;
            }
            return $requestBuilder->callResourceWithSubPath(
                ApiResource::APPROVALS,
                AutoBillApiSchemeHelper::GET,
                $subPath,
                null,
                $apiVersion,
                is_array($queryParams) ? $queryParams : null
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getAccountApprovals($accountUuid, $queryParams = null, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceWithSubPath(
                ApiResource::APPROVALS,
                AutoBillApiSchemeHelper::GET,
                'account/' . $accountUuid,
                null,
                $apiVersion,
                $queryParams
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function approve($params, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceWithSubPath(
                ApiResource::APPROVALS,
                AutoBillApiSchemeHelper::POST,
                'approve',
                $params,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function reject($params, $apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceWithSubPath(
                ApiResource::APPROVALS,
                AutoBillApiSchemeHelper::POST,
                'reject',
                $params,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

}
