<?php

namespace Api\AppService\CustomAttribute;

use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;

class CustomAttributeData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    /**
     * GET /custom-attributes
     * Retrieves all custom attributes
     *
     * @param string|null $apiVersion API version (defaults to v2 as per documentation)
     * @return mixed API response
     * @throws AutoBillApiException
     */
    public function listAll($apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::CUSTOM_ATTRIBUTES,
                AutoBillApiSchemeHelper::GET,
                null,
                [],
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    /**
     * GET /custom-attributes/{ca_uuid}
     * Retrieves a specific custom attribute by UUID
     *
     * @param string $customAttributeUUID UUID of the custom attribute
     * @param string|null $apiVersion API version (defaults to v2 as per documentation)
     * @return mixed API response
     * @throws AutoBillApiException
     */
    public function details($customAttributeUUID, $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::CUSTOM_ATTRIBUTES,
                AutoBillApiSchemeHelper::GET,
                $customAttributeUUID,
                [],
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    /**
     * POST /custom-attributes
     * Creates a new custom attribute
     *
     * @param array $params Custom attribute data
     * Example:
     * [
     *   "custom_attribute" => [
     *     "name" => "attribute_name",
     *     "display_name" => "Display Name",
     *     "description" => "Description",
     *     "type" => "STRING|NUMBER|RADIO_BUTTON|DROPDOWN|etc",
     *     "use_in" => [
     *       ["resource" => "account", "required" => "false", "unique" => "false", "enabled" => "true"]
     *     ],
     *     "options" => ["Option1", "Option2"],
     *     "encrypt_data" => "false"
     *   ]
     * ]
     * @param string|null $apiVersion API version (defaults to v2 as per documentation)
     * @return mixed API response
     * @throws AutoBillApiException
     */
    public function create($params = [], $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::CUSTOM_ATTRIBUTES,
                AutoBillApiSchemeHelper::POST,
                null,
                $params,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    /**
     * PATCH /custom-attributes/{ca_uuid}
     * Updates an existing custom attribute
     *
     * @param string $customAttributeUUID UUID of the custom attribute to update
     * @param array $params Custom attribute data to update
     * @param string|null $apiVersion API version (defaults to v2 as per documentation)
     * @return mixed API response
     * @throws AutoBillApiException
     */
    public function update($customAttributeUUID, $params = [], $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());

            // For PATCH requests on custom attributes, we need to call directly without /information suffix
            // Using callResourceAttribute to avoid the automatic /information path addition
            return $requestBuilder->callResourceAttribute(
                ApiResource::CUSTOM_ATTRIBUTES,
                AutoBillApiSchemeHelper::PATCH,
                $customAttributeUUID,
                $params,
                null,
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    /**
     * DELETE /custom-attributes/{ca_uuid}
     * Deletes a custom attribute
     *
     * @param string $customAttributeUUID UUID of the custom attribute to delete
     * @param string|null $apiVersion API version (defaults to v2 as per documentation)
     * @return mixed API response
     * @throws AutoBillApiException
     */
    public function delete($customAttributeUUID, $apiVersion = 'v2')
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            return $requestBuilder->callResource(
                ApiResource::CUSTOM_ATTRIBUTES,
                AutoBillApiSchemeHelper::DELETE,
                $customAttributeUUID,
                [],
                $apiVersion
            );
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    /**
     * Custom request for advanced custom attribute operations
     *
     * @param string $path Custom path (e.g., for query parameters)
     * @param string $requestMethod HTTP method
     * @param array|null $params Request parameters
     * @param string|null $apiVersion API version
     * @return mixed API response
     * @throws AutoBillApiException
     */
    public function customRequest($path, $requestMethod, $params = null, $apiVersion = 'v2')
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
