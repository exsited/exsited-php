<?php


namespace Api\AppService\Account;
use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
//use Api\AppService\Model\Account;
//use Api\AppService\Model\Billing_preferences;
use Api\Component\ApiConfig;

class AccountData
{

    private $apiConfig;
//    const GET_ACCOUNT_API = "api/v1/";

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function readAll(){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

}
