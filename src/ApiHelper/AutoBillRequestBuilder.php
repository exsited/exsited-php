<?php


namespace Api\ApiHelper;


use Api\AppService\AutoBillApiException;
use Api\ApiHelper\Communicator\AutoBillApiDataResolver;

class AutoBillRequestBuilder
{

    public function customRequest($apiUrl, $requestMethod, $params = []){
        $apiDataResolver = new AutoBillApiDataResolver();
        switch ($requestMethod){
            case AutoBillApiSchemeHelper::GET:
                $requestToApiData = $apiDataResolver->getGetParamsData($apiUrl);
                break;
            case AutoBillApiSchemeHelper::POST:
                $requestToApiData = $apiDataResolver->getPostParamsData($apiUrl);
                break;
            case AutoBillApiSchemeHelper::DELETE:
                $requestToApiData = $apiDataResolver->getDeleteParamsData($apiUrl);
                break;
            case AutoBillApiSchemeHelper::PUT:
                $requestToApiData = $apiDataResolver->getPutParamsData($apiUrl);
                break;
            case AutoBillApiSchemeHelper::PATCH:
                $requestToApiData = $apiDataResolver->getPatchParamsData($apiUrl);
                break;
            default:
                throw new AutoBillApiException("Please specify a valid request method type. e.g: get / post / delete");
        }
        $requestToApiData->setParamArray($params);
        return $apiDataResolver->requestToAPI($this->authCredentialData, $requestToApiData);
    }


    public function callResource($apiResource, $requestMethod, $id = null, $params = []){
        $path = "api/v2/".$apiResource;

        if ($id != null) {
            $path = $path.'/'.$id;
            if ($requestMethod == AutoBillApiSchemeHelper::PATCH) {
                $path = $path.'/information';
            }
        }
        try {
            return  $this->customRequest($path, $requestMethod, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


}