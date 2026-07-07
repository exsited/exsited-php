<?php


namespace Api\AppService\CustomComponent;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;


class CustomComponentData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function create($componentUuid,$params,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::COMPONENT, AutoBillApiSchemeHelper::POST, $componentUuid,$params,null,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readAll($componentUuid,$apiVersion = null, $queryParams = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::COMPONENT, AutoBillApiSchemeHelper::GET, $componentUuid,[],null,$apiVersion, $queryParams);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readAllDetails($componentUuid,$id,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::COMPONENT, AutoBillApiSchemeHelper::GET, $componentUuid,[],$id,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function createWithAttributeGroup($componentUuid,$params,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::COMPONENT, AutoBillApiSchemeHelper::POST, $componentUuid,$params,null,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readAccountAllComponent($componentUuid,$accountId,$apiVersion = null){

        $attribute = "component/$componentUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountId,[],$attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readAccountComponent($componentUuid,$accountId,$id,$apiVersion = null){

        $attribute = "component/$componentUuid/$id";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountId,[],$attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function change($componentUuid,$id,$params,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::COMPONENT, AutoBillApiSchemeHelper::PATCH, $componentUuid,$params,$id,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function delete($componentUuid,$id,$apiVersion = null){
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::COMPONENT, AutoBillApiSchemeHelper::DELETE, $componentUuid,[],$id,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getComponentPdf($componentUuid, $id, $apiVersion = 'v2') {
        $attribute = "$id/pdf";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::GET,
                $componentUuid,
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readAllComponentNotes($componentUuid, $id, $apiVersion = null) {
        $attribute = "$id/notes";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::GET,
                $componentUuid,
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readComponentNoteDetails($componentUuid, $id, $noteUuid, $apiVersion = null) {
        $attribute = "$id/notes/$noteUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::GET,
                $componentUuid,
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addComponentNote($componentUuid, $id, $note, $filePath = null, $apiVersion = null) {
        $attribute = "$id/notes";
        $data = [];

        if ($filePath) {
            if (!file_exists($filePath)) {
                throw new \Exception("File not found: {$filePath}");
            }
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        if ($note) {
            $data['note'] = $note;
        }

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::POST,
                $componentUuid,
                $data,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function deleteComponentNote($componentUuid, $id, $noteUuid, $apiVersion = null) {
        $attribute = "$id/notes/$noteUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::DELETE,
                $componentUuid,
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readComponentNoteFiles($componentUuid, $id, $noteUuid, $apiVersion = null) {
        $attribute = "$id/notes/$noteUuid/files";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::GET,
                $componentUuid,
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readComponentNoteFileDetails($componentUuid, $id, $noteUuid, $fileUuid, $apiVersion = null) {
        $attribute = "$id/notes/$noteUuid/files/$fileUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::GET,
                $componentUuid,
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function changeComponentStatus($componentUuid, $id, $params, $apiVersion = null) {
        $attribute = "$id/change_status";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::POST,
                $componentUuid,
                $params,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createComponentActivity($componentUuid, $id, $params, $apiVersion = null) {
        $attribute = "$id/activity";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::POST,
                $componentUuid,
                $params,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readComponentActivities($componentUuid, $id, $apiVersion = null) {
        $attribute = "$id/activity";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::GET,
                $componentUuid,
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readComponentActivityDetails($componentUuid, $id, $activityUuid, $apiVersion = null) {
        $attribute = "$id/activity/$activityUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::GET,
                $componentUuid,
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function linkDomains($componentUuid, $params, $apiVersion = 'v2') {
        $attribute = "link_domains";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::POST,
                $componentUuid,
                $params,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function updateLinkDomains($componentUuid, $params, $apiVersion = 'v3') {
        $attribute = "link_domains";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::PATCH,
                $componentUuid,
                $params,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function unlinkDomains($componentUuid, $params, $apiVersion = 'v3') {
        $attribute = "unlink_domains";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::POST,
                $componentUuid,
                $params,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function deleteCustomObjects($componentUuid, $id, $apiVersion = 'v3') {
        $attribute = "$id/custom_objects";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::DELETE,
                $componentUuid,
                [],
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function updateExpress($componentUuid, $id, $params, $apiVersion = 'v3') {
        $attribute = "$id/express";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResourceAttribute(
                ApiResource::COMPONENT,
                AutoBillApiSchemeHelper::PATCH,
                $componentUuid,
                $params,
                $attribute,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

}