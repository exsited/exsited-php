<?php

namespace Api\AppService\Workflow;

use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

class WorkflowData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function getWorkflowDetails($componentUuid, $apiVersion = 'v2')
    {
        $attribute = "component/$componentUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::WORKFLOW,
                AutoBillApiSchemeHelper::GET,
                '',
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createComponentWithWorkflow($componentUuid, $params, $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::POST,
                $componentUuid,
                $params,
                null,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getComponentWithWorkflow($componentUuid, $componentId, $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::GET,
                $componentUuid,
                [],
                $componentId,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addMilestone($componentUuid, $componentId, $params, $apiVersion = 'v2')
    {
        $attribute = "component/$componentUuid/$componentId/milestone";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::WORKFLOW,
                AutoBillApiSchemeHelper::POST,
                '',
                $params,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function updateMilestone($componentUuid, $componentId, $params, $apiVersion = 'v2')
    {
        $attribute = "component/$componentUuid/$componentId/milestone/";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::WORKFLOW,
                AutoBillApiSchemeHelper::PATCH,
                '',
                $params,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getMilestones($componentUuid, $componentId, $queryParams = null, $apiVersion = 'v2')
    {
        $attribute = "component/$componentUuid/$componentId/milestone";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::WORKFLOW,
                AutoBillApiSchemeHelper::GET,
                '',
                [],
                $attribute,
                $apiVersion,
                $queryParams
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getMilestoneDetails($componentUuid, $componentId, $milestoneUuid, $apiVersion = 'v2')
    {
        $attribute = "component/$componentUuid/$componentId/milestone/$milestoneUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::WORKFLOW,
                AutoBillApiSchemeHelper::GET,
                '',
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createAlertResponsibility($params, $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::ALERT_RESPONSIBILITY,
                AutoBillApiSchemeHelper::POST,
                null,
                $params,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getAlertResponsibilities($apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::ALERT_RESPONSIBILITY,
                AutoBillApiSchemeHelper::GET,
                null,
                [],
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getAlertResponsibilityDetails($alertResponsibilityUuid, $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::ALERT_RESPONSIBILITY,
                AutoBillApiSchemeHelper::GET,
                $alertResponsibilityUuid,
                [],
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getWorkflowDefinition($workflowVersionUuid, $apiVersion = 'v2')
    {
        $attribute = "$workflowVersionUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::WORKFLOW,
                AutoBillApiSchemeHelper::GET,
                '',
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
}
