<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Approval\ApprovalData;
use Api\ApiHelper\Config\ConfigManager;

class ApprovalManager
{
    private $approvalService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->approvalService = new ApprovalData($apiConfig);
    }

    public function testGetSaleOrderApprovals(){
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=10';
            $response = $this->approvalService->getSaleOrderApprovals($queryParams, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetTimesheetApprovals(){
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=10';
            $response = $this->approvalService->getTimesheetApprovals($queryParams, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetAccountApprovals(){
        try {
            $accountUuid = "cdbf8850-83b4-44ae-8362-d3b362360526";
            $response = $this->approvalService->getAccountApprovals($accountUuid, null, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testApprove(){
        try {
            $params = [
                "approvals" => [
                    "entity" => "saleOrder",
                    "uuid" => "df3d346d-856b-4752-aaeb-404f1680e7b5",
                    "note" => "agreed"
                ]
            ];

            $response = $this->approvalService->approve($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReject(){
        try {
            $params = [
                "approvals" => [
                    "entity" => "saleOrder",
                    "uuid" => "8ae8f9ea-6636-4606-ab72-1aa479d18dd0",
                    "note" => "rejected"
                ]
            ];

            $response = $this->approvalService->reject($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$approvalManager = new ApprovalManager();
//$approvalManager->testGetSaleOrderApprovals();
//$approvalManager->testGetTimesheetApprovals();
$approvalManager->testGetAccountApprovals();
$approvalManager->testApprove();
$approvalManager->testReject();
