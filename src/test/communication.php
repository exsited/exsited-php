<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Communication\CommunicationData;
use Api\ApiHelper\Config\ConfigManager;

class CommunicationManager
{
    private $communicationService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->communicationService = new CommunicationData($apiConfig);
    }

    public function testReadAccountEmails()
    {
        $accountId = '2561EE';
        try {
            $response = $this->communicationService->readAccountEmails($accountId, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountEmailDetails()
    {
        $accountId = '2561EE';
        $emailId = 'd79744ae-e5bf-44f5-9275-d15acf779501';
        try {
            $response = $this->communicationService->readAccountEmailDetails($accountId, $emailId, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testSendEmail()
    {
        $params = [
            'invoice' => [
                'id' => 'INV-2561EE-0001',
                'template' => 'SEND INVOICE BY EMAIL',
                'to' => 'testautobill@yopmail.com',
                'cc' => [
                    'demo.one@yopmail.com',
                    'demo.two@yopmail.com'
                ],
                'bcc' => [
                    'demo.three@yopmail.com',
                    'demo.four@yopmail.com'
                ],
                'subject' => 'Invoice sent from WebAlive',
                'body' => 'Test email body with large content. This supports AutoBill macros.'
            ]
        ];

        try {
            $response = $this->communicationService->sendEmail($params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testSendAccountEmail()
    {
        $accountId = '2561EE';

        $filePath = 'C:/Users/mehedi/Documents/test-document.docx';

        $params = [
            'to' => 'chandler99@yopmail.com',
            'cc' => 'bing@yopmail.com,bing2@yopmail.com',
            'bcc' => 'bing34@yopmail.com,bing35@yopmail.com',
            'subject' => 'subject added fgd',
            'body' => 'bodddyyyyyyy finaal 2dgdg'
        ];

        if (file_exists($filePath)) {
            $params['attachment'] = new \CURLFile($filePath, mime_content_type($filePath), basename($filePath));
        }

        try {
            $response = $this->communicationService->sendAccountEmail($accountId, $params, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$communicationManager = new CommunicationManager(0);
// $communicationManager->testReadAccountEmails();
// $communicationManager->testReadAccountEmailDetails();
// $communicationManager->testSendEmail();
$communicationManager->testSendAccountEmail();
