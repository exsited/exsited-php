<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Payment\PaymentData;
use Api\ApiHelper\Config\ConfigManager;

class PaymentManager
{
    private $paymentService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->paymentService = new PaymentData($apiConfig);
    }

   public function testReadAll(){
       try {
           $payments = $this->paymentService->readAll('v3');
           echo '<pre>' . json_encode($payments, JSON_PRETTY_PRINT) . '</pre>';
       } catch (Exception $e) {
           echo 'Error: ' . $e->getMessage();
       }
   }

    public function testReadDetails()
    {
        $id = '1CZNNKXSMAKALYIMIJHKI8GXUAB';
        try {
            $response = $this->paymentService->readDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountPaymentDetails()
    {
        $accountId = 'IE1DSN';
        try {
            $response = $this->paymentService->readAccountPaymentDetails($accountId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadOrderPaymentDetails()
    {
        $orderId = 'ORD-IE1DSN-1277';
        try {
            $response = $this->paymentService->readOrderPaymentDetails($orderId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadInvoicePaymentDetails()
    {
        $invoiceId = 'INV-IE1DSN-6084';
        try {
            $response = $this->paymentService->readInvoicePaymentDetails($invoiceId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateSinglePayment()
    {
        $invoiceId="INV-J51VQS-6087";
        $params = [
            "payment" => [
//                "id" => "PMT-1236", // system will generate one if not passed
                "date" => "2024-12-23",
                "note" => "payments/note",
                "payment_applied" => [
                    [
                        //    "method" => "cash123",
                        // OR
                        "processor" => "Cash",
                        "amount" => "5.00",
                        "reference" => "abc"
                    ]
                ],
                // "credit_applied" => [
                //     [
                //         "id" => "CRN-006dkd",
                //         "amount" => "1.00"
                //     ]
                // ],
                // "gift_certificates" => [
                //     [
                //         "code" => "GC-0030",
                //         "applied" => "1"
                //     ]
                // ],
                // "custom_attributes" => [
                //     [
                //         "name" => "custom attribute",
                //         "value" => "buy chips"
                //     ]
                // ]
            ]
        ];


        try {
            $response = $this->paymentService->createSinglePayment($invoiceId,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id = 'PMT-76GOU2-0002';
        try {
            $response = $this->paymentService->delete($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




}

    $paymentManager= new PaymentManager();
//    $paymentManager->testReadAll();
//    $paymentManager->testReadDetails();
//    $paymentManager->testReadAccountPaymentDetails();
//    $paymentManager->testReadOrderPaymentDetails();
//    $paymentManager->testReadInvoicePaymentDetails();
//    $paymentManager->testCreateSinglePayment();
//    $paymentManager->testDelete();