<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Account\AccountData;
use Api\ApiHelper\Config\ConfigManager;

class AccountManager
{
    private $accountService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }

        $apiConfig = new ApiConfig($authCredentialData);
        $this->accountService = new AccountData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $queryParams = '?order_by=created_on&direction=desc&limit=2';
            $response = $this->accountService->readAll(null, $queryParams);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id='GE2O2Y';
        try {
            $response = $this->accountService->readDetails($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsInformation()
    {
        $id="FKITFZ";
        try {
            $response = $this->accountService->readDetailsInformation($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreate()
    {
        $params = [
            "name" => "abcd",
            "email_address" => "basicinformationsami123@gmail.com",
        ];

        try {
            $response = $this->accountService->create($params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate()
    {
        $params = [
            "name" => "ABCD",
            "display_name" => "ABCD",
            "description" => "updated description",
            "email_address" => "bhai3@abc.com"
        ];
        $id='GE2O2Y';
        try {
            $response = $this->accountService->update($params, $id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id="GE2O2Y";
        try {
            $response = $this->accountService->delete($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreatePaymentMethod()
    {
        $params= [
            'processor_type' => 'OTHER',
            'default' => true,
            'payment_processor' => 'Cheque',
            'reference' => 'Reference-Ch'
        ];
        $id='FKITFZ';
        try {
            $response = $this->accountService->createPaymentMethod($params, $id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateCardPaymentMethod()
    {
        $params = [
            'processor_type' => 'DIRECT_CREDIT',
            'default' => true,
            'payment_processor' => 'securepay',
            'card_type' => 'Visa',
            'token' => '1738992071975167',
            'card_number' => '4242',
            'expiry_month' => '12',
            'expiry_year' => '2025',
            'reference' => 'apiSecurepay',
        ];
        $id='J51VQS';

        try {
            $response = $this->accountService->createCardPaymentMethod($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public  function testReadPaymentMethod()
    {
        $id="FKITFZ";
        try {
            $response = $this->accountService->readPaymentMethod($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function testDeletePaymentMethod()
    {
        $id = "SRK928";
        $ref = "card_1RkkT4JjDfoQRmbhSBUPIREJ";
        try {
            $response = $this->accountService->deletePaymentMethod($id, $ref,'v2');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsPaymentMethod()
    {
        $id = "FKITFZ";
        $ref = "Reference-Ch";
        try {
            $response = $this->accountService->readDetailsPaymentMethod($id, $ref,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testUpdatesPaymentMethodAllData()
    {
        $params = [
            "default" => "false",
            "use_for_specified_orders" => "true",
            "specified_orders" => [
                [
                    "order_id" => "ORD-IE1DSN-1332"
                ]
            ],
            "reference" => "uniReference"
        ];
        $id='XA6J22';
        $reference= "uniRef";
        try {
            $updatesPayment = $this->accountService->updatesPaymentMethodAllData($params, $id,$reference,'v3');
            echo '<pre>' . json_encode($updatesPayment, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadContactDetails()
    {
        $id="FKITFZ";
        try {
            $response = $this->accountService->readContactDetails($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadContactTypeDetails()
    {
        $id="FKITFZ";
        $contactType= "CONTACT_1";
        try {
            $response = $this->accountService->readContactTypeDetails($id,$contactType,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testUpdateContactTypeDetails()
    {
        $params = [
            "account" => [
                "contact" => [
                    "salutation" => "Fraulein",
                    "designation" => "CEO",
                    "first_name" => "Roza",
                    "middle_name" => "rrTabassum",
                    "email" => [
                        "address" => "abc@yopmail.com",
                        "do_not_email" => "false"
                    ],
                    "address_line_1" => "9 Yarra",
                    "address_line_2" => "10 Yarra",
                    "address_line_3" => "11 Yarra",
                    "address_line_4" => "12 Yarraaa",
                    "address_line_5" => "13 Yarra",
                    "post_code" => "3737",
                    "city" => "Abbeyard",
                    "state" => "Victoria",
                    "country" => "Australia",
                    "phone" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "546464",
                        "do_not_call" => "true"
                    ],
                    "fax" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "5464",
                        "do_not_call" => "true"
                    ],
                    "mobile" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "5464",
                        "do_not_call" => "true"
                    ],
                    "receive_billing_information" => "true"
                ]
            ]
        ];

        $id="FKITFZ";
        $contactType= "CONTACT_1";
        try {
            $response = $this->accountService->updateContactTypeDetails($params, $id,$contactType,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChangeContactTypeDetails()
    {
        $params = [
            "account" => [
                "contact" => [

                    "salutation" => "Fraulein",
                    "designation" => "CEO",
                    "first_name" => "Roza",
                    "middle_name" => "rrTabassum",
                    "email" => [
                        "address" => "abc@yopmail.com",
                        "do_not_email" => "false"
                    ],
                    "address_line_1" => "9 Yarra",
                    "address_line_2" => "10 Yarra",
                    "address_line_3" => "11 Yarra",
                    "address_line_4" => "12 Yarraaa",
                    "address_line_5" => "13 Yarra",
                    "post_code" => "3737",
                    "city" => "Abbeyard",
                    "state" => "Victoria",
                    "country" => "Australia",
                    "phone" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "546464",
                        "do_not_call" => "true"
                    ],
                    "fax" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "5464",
                        "do_not_call" => "true"
                    ],
                    "mobile" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "5464",
                        // "full" => "807060",
                        "do_not_call" => "true"
                    ],

                    "receive_billing_information" => "true"
                ]
            ]
        ];

        $id="FKITFZ";
        $contactType= "CONTACT_1";
        try {
            $updateInfo = $this->accountService->changeContactTypeDetails($params, $id,$contactType,'v3');
            echo '<pre>' . json_encode($updateInfo, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeleteContactTypeDetails()
    {

        $id="XA6J22";
        $contactType= "CONTACT_1";
        try {
            $response = $this->accountService->deleteContactTypeDetails($id,$contactType,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAllNotes()
    {
        $id="76GOU2";
        try {
            $response = $this->accountService->readAllNotes($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadNoteDetails()
    {
        $id="76GOU2";
        $noteUUID="89f1130d-216a-4a46-9037-c2826860b2e5";
        try {
            $response = $this->accountService->readNoteDetails($id,$noteUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadNoteFiles()
    {
        $id="76GOU2";
        $noteUUID="89f1130d-216a-4a46-9037-c2826860b2e5";
        try {
            $response = $this->accountService->readNoteFiles($id,$noteUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadNoteFileDetails()
    {
        $id="76GOU2";
        $noteUUID="89f1130d-216a-4a46-9037-c2826860b2e5";
        $fileUUID="d80e699e-532a-4996-93d8-e3b513e8b50f";
        try {
            $response = $this->accountService->readNoteFileDetails($id,$noteUUID,$fileUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddNote()
    {
        $id = '76GOU2';
        $filePaths = 'C:\Users\Mehedi\Downloads\n.txt';
        $note = 'from v3 sdk';

        try {
            $response = $this->accountService->addNote($filePaths, $note, $id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


//    public function testAddNote() {
//        $id = 'VHZB-0000000125';
//        $filePaths = [
//            'C:\Users\Mehedi\Downloads\k.txt',
//            'C:\Users\Mehedi\Downloads\n.txt'
//        ];
//        $note = 'last';
//
//        try {
//            $addInfo = $this->accountService->addNote($filePaths, $note, $id);
//            echo '<pre>' . json_encode($addInfo, JSON_PRETTY_PRINT) . '</pre>';
//        } catch (Exception $e) {
//            echo 'Error: ' . $e->getMessage();
//        }
//    }

    public function testAddNoteFiles()
    {
        $id = '76GOU2';
        $noteUUID='2c6724b5-37d6-4c11-96a0-6f8d155c30fd';
        $filePath = 'C:\Users\Mehedi\Downloads\n.txt';
        try {
            $response = $this->accountService->addNoteFiles($filePath, $id,$noteUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testDeleteNote()
    {
        $id="76GOU2";
        $noteUUID="89f1130d-216a-4a46-9037-c2826860b2e5";
        try {
            $response = $this->accountService->deleteNote($id,$noteUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testDeleteNoteFile()
    {
        $id="76GOU2";
        $noteUUID="89f1130d-216a-4a46-9037-c2826860b2e5";
        $fileUUID="d80e699e-532a-4996-93d8-e3b513e8b50f";
        try {
            $response = $this->accountService->deleteNoteFile($id,$noteUUID,$fileUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testReadAddresses()
    {
        $id="76GOU2";
        try {
            $response = $this->accountService->readAddresses($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAddressDetails()
    {
        $id="76GOU2";
        $addressUUID="b2945101-d278-4149-9cf4-f110a1285d97";
        try {
            $response = $this->accountService->readAddressDetails($id,$addressUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateAddresses()
    {
        $id="76GOU2";
        $params = [
                'addresses' => [
                    [
                        'address_line_1' => '9 Yarra',
                        'address_line_2' => '10 Yarra',
                        'address_line_3' => '11 Yarra',
                        'address_line_4' => '12 Yarra',
                        'address_line_5' => '13 Yarra',
                        'post_code' => '3737',
                        'city' => 'Abbeyard',
                        'state' => 'Victoria',
                        'country' => 'Australia',
                        'isDefaultBilling' => 'false',
                        'isDefaultShipping' => 'false'
                    ],
                    [
                        'address_line_1' => 'House 15',
                        'address_line_2' => 'Road 20',
                        'address_line_3' => 'Block A',
                        'address_line_4' => 'Section 8',
                        'address_line_5' => 'Road 9',
                        'post_code' => '3737',
                        'city' => 'Abbeyard',
                        'state' => 'Victoria',
                        'country' => 'Australia',
                        'isDefaultBilling' => 'false',
                        'isDefaultShipping' => 'false'
                    ]
                ]
            ];

        try {
            $response = $this->accountService->createAddresses($id,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testChangeAddress()
    {
        $id="76GOU2";
        $addressUUID="6864c809-db5d-4681-a5a1-795deff9364f";
        $params = [
            'address' => [
                'address_line_1' => 'House 15',
                'address_line_2' => 'Road 20',
                'address_line_3' => 'Block A',
                'address_line_4' => 'Section 8',
                'address_line_5' => 'Road 9',
                'post_code' => '3737',
                'city' => 'Abbeyard1',
                'state' => 'Victoria',
                'country' => 'Australia',
                'isDefaultBilling' => 'false',
                'isDefaultShipping' => 'false'
            ]
        ];

        try {
            $response = $this->accountService->changeAddresses($id, $params, $addressUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testDeleteAddress()
    {
        $id="76GOU2";
        $addressUUID="b2945101-d278-4149-9cf4-f110a1285d97";

        try {
            $response = $this->accountService->deleteAddress($id,$addressUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetImage()
    {
        $id="6MRG4C";
        try {
            $response = $this->accountService->getImage($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddImage()
    {
        $id = '6MRG4C';
        $filePath = "C:\Users\Mehedi\Downloads\img.jpg";
        try {
            $response = $this->accountService->addimage($filePath, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeleteImage()
    {
        $id = "6MRG4C";

        try {
            $response = $this->accountService->deleteImage($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadBillingPreference()
    {
        $id = "J51VQS";

        try {
            $response = $this->accountService->readBillingPreference($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadCustomObjectDetails()
    {
        $id = "2Q5CFG";
        $customObjectUUID = "6502f4c6-e3bb-49ef-9adc-8c7b9fa28941";

        try {
            $response = $this->accountService->readCustomObjectDetails($id,$customObjectUUID,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateBillingPreference()
    {
        $id = "J51VQS";
        $params = [
            "account" => [
                "billing_preferences" => [
                    "communication_profile" => "DEFAULT",
                    "invoice_mode" => "AUTOMATIC",
                    "invoice_term" => "Billing Start Date",
                    "billing_period" => "1 Month",
                    "billing_start_date" => "ORDER_START_DATE",
                    "charging_and_billing_alignment" => "true",
                    "payment_processor" => "Cheque",
                    "payment_mode" => "MANUAL",
                    "payment_term" => "Due on Receipt",
                    "payment_term_alignment" => "BILLING_DATE"
                ]
            ]
        ];
        try {
            $response = $this->accountService->updateBillingPreference($id,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function testCancel()
    {
        $id = "GWU152";
        $params = [
            "account" => [
                "effective_date" => "2024-12-17"
            ]
        ];

        try {
            $response = $this->accountService->cancel($id,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }
    public function testReactivate()
    {
        $id = "GWU152";
        $params = [
            "account" => [
                "effective_date" => "2024-12-17"
            ]
        ];

        try {
            $response = $this->accountService->reactivate($id,$params,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadCustomObject()
    {
        $id ="J51VQS";
        try {
            $response = $this->accountService->readCustomObject($id,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}


//    Test Function Call here

$credentials = [
    'apiUrl' => '',
    'appUrl' => null,
    'client_id' => '',
    'client_secret' => '',
    'access_token' => '',
    'refresh_token' => '',
    'redirect_uri' => '',
    'authTokenRenewCallback' => function ($authCredentialData)  {

    }
];
    $accountManager = new AccountManager($credentials);
    $accountManager->testReadAll();
//    $accountManager2 = new AccountManager(1);
//    $accountManager2->testReadAll();
//    $accountManager->testReadDetails();
//    $accountManager->testReadDetailsInformation();
//    $accountManager->testCreate();
//    $accountManager->testUpdate();
//    $accountManager->testDelete();
//    $accountManager->testCreatePaymentMethod();
//    $accountManager->testCreateCardPaymentMethod();
//    $accountManager->testReadPaymentMethod();
//    $accountManager->testReadDetailsPaymentMethod();
//    $accountManager->testDeletePaymentMethod();
//    $accountManager->testUpdatesPaymentMethodAllData();
//    $accountManager->testReadContactDetails();
//    $accountManager->testReadContactTypeDetails();
//    $accountManager->testUpdateContactTypeDetails();
//    $accountManager->testChangeContactTypeDetails();
//    $accountManager->testDeleteContactTypeDetails();
//    $accountManager->testReadAllNotes();
//    $accountManager->testReadNoteDetails();
//    $accountManager->testAddNote();
//    $accountManager->testAddNoteFiles();
//    $accountManager->testReadNoteFiles();
//    $accountManager->testReadNoteFileDetails();
//    $accountManager->testDeleteNote();
//    $accountManager->testDeleteNoteFile();
//    $accountManager->testReadAddresses();
//    $accountManager->testReadAddressDetails();
//    $accountManager->testCreateAddresses();
//    $accountManager->testChangeAddress();
//    $accountManager->testDeleteAddress();
//    $accountManager->testGetImage();
//    $accountManager->testAddImage();
//    $accountManager->testDeleteImage();
//    $accountManager->testReadBillingPreference();
//    $accountManager->testUpdateBillingPreference();
//    $accountManager->testCancel();
//    $accountManager->testReactivate();
//    $accountManager->testReadCustomObjectDetails();
//    $accountManager->testReadCustomObject();