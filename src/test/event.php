<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Event\EventData;
use Api\ApiHelper\Config\ConfigManager;

class EventManager
{
    private $eventService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->eventService = new EventData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->eventService->readAll('v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetails()
    {
        $uuId="71118384-ca12-401e-8b44-bc2d37230383";
        try {
            $response = $this->eventService->readDetails($uuId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testRemove()
    {
        $uuId="71118384-ca12-401e-8b44-bc2d37230383";
        try {
            $response = $this->eventService->remove($uuId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



}

$eventManager = new EventManager();
//$eventManager->testReadAll();
//$eventManager->testReadDetails();
 $eventManager->testRemove();