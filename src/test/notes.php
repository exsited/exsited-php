<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Notes\NotesData;
use Api\ApiHelper\Config\ConfigManager;

class NotesManager
{
    private $notesService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->notesService = new NotesData($apiConfig);
    }

    public function testReadAccountAllNotes()
    {
        $accountId = "76GOU2";
        try {
            $response = $this->notesService->readAccountAllNotes($accountId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateAccountNotes()
    {
        $accountId = '76GOU2';
        $filePaths = 'C:\Users\Mehedi\Downloads\n.txt';
        $note = 'from sdk';

        try {
            $response = $this->notesService->createAccountNotes($filePaths, $note, $accountId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddItemFile()
    {
        $itemId = 'ITEM-0033';
        $filePath = 'C:\Users\Mehedi\Downloads\k.txt';
        $noteUuid="ba9c2c37-48cb-4c57-892f-def8b056522e";

        try {
            $response = $this->notesService->addItemFile($filePath, $noteUuid, $itemId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadItemNotesDetails()
    {
        $itemId = "ITEM-0033";
        $noteUuid="de317fd7-9af0-4f0b-ac28-0c4ad857ab03";

        try {
            $response = $this->notesService->readItemNotesDetails($itemId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadItemNoteAllFiles()
    {
        $itemId = "ITEM-0033";
        $noteUuid="de317fd7-9af0-4f0b-ac28-0c4ad857ab03";

        try {
            $response = $this->notesService->readItemNoteAllFiles($itemId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadItemNoteFileDetails()
    {
        $itemId = "ITEM-0033";
        $noteUuid="de317fd7-9af0-4f0b-ac28-0c4ad857ab03";
        $fileUuid = "620ed86c-0380-4326-965c-751241a725c7";

        try {
            $response = $this->notesService->readItemNoteFileDetails($itemId,$noteUuid,$fileUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $noteUuid="de317fd7-9af0-4f0b-ac28-0c4ad857ab03";
        try {
            $response = $this->notesService->readDetails($noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreateOrderNotes()
    {
        $orderId = 'ORD-76GOU2-1216';
        $filePath = 'C:\Users\Mehedi\Downloads\n.txt';
        $note = 'Order Note from sdk';

        try {
            $response = $this->notesService->createOrderNotes($filePath, $note, $orderId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadOrderAllNotes()
    {
        $orderId = "ORD-76GOU2-1216";
        try {
            $response = $this->notesService->readOrderAllNotes($orderId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddOrderFile()
    {
        $orderId = 'ORD-76GOU2-1216';
        $filePath = 'C:\Users\Mehedi\Downloads\k.txt';
        $noteUuid="28f2b52e-0fb3-4763-95af-6e1a593a8550";

        try {
            $response = $this->notesService->addOrderFile($filePath, $noteUuid, $orderId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadOrderNotesDetails()
    {
        $orderId = "ORD-76GOU2-1216";
        $noteUuid="28f2b52e-0fb3-4763-95af-6e1a593a8550";

        try {
            $response = $this->notesService->readOrderNotesDetails($orderId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadOrderNoteAllFiles()
    {
        $orderId = "ORD-76GOU2-1216";
        $noteUuid="28f2b52e-0fb3-4763-95af-6e1a593a8550";

        try {
            $response = $this->notesService->readOrderNoteAllFiles($orderId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadOrderNoteFileDetails()
    {
        $orderId = "ORD-76GOU2-1216";
        $noteUuid="28f2b52e-0fb3-4763-95af-6e1a593a8550";
        $fileUuid = "5a688443-0495-428d-a839-412f939358cd";

        try {
            $response = $this->notesService->readOrderNoteFileDetails($orderId,$noteUuid,$fileUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateInvoiceNotes()
    {
        $invoiceId = 'INV-76GOU2-5943';
        $filePaths = 'C:\Users\Mehedi\Downloads\n.txt';
        $note = 'from sdk';

        try {
            $response = $this->notesService->createInvoiceNotes($filePaths, $note, $invoiceId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadInvoiceAllNotes()
    {
        $invoiceId = 'INV-76GOU2-5943';
        try {
            $response = $this->notesService->readInvoiceAllNotes($invoiceId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddInvoiceFile()
    {
        $invoiceId = 'INV-76GOU2-5943';
        $filePath = 'C:\Users\Mehedi\Downloads\k.txt';
        $noteUuid="279a7002-92f3-4ac2-99d0-aa25a63a1da5";

        try {
            $response = $this->notesService->addInvoiceFile($filePath, $noteUuid, $invoiceId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadInvoiceNotesDetails()
    {
        $invoiceId = "INV-76GOU2-5943";
        $noteUuid="279a7002-92f3-4ac2-99d0-aa25a63a1da5";

        try {
            $response = $this->notesService->readInvoiceNotesDetails($invoiceId,$noteUuid);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddAccountFile()
    {
        $accountId = '76GOU2';
        $filePath = 'C:\Users\Mehedi\Downloads\k.txt';
        $noteUuid="120b31a9-82da-424b-939f-e8d44697c61c";

        try {
            $response = $this->notesService->addAccountFile($filePath, $noteUuid, $accountId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountNotesDetails()
    {
        $accountId = "76GOU2";
        $noteUuid="120b31a9-82da-424b-939f-e8d44697c61c";

        try {
            $response = $this->notesService->readAccountNotesDetails($accountId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountNoteAllFiles()
    {
        $accountId = "76GOU2";
        $noteUuid="120b31a9-82da-424b-939f-e8d44697c61c";

        try {
            $response = $this->notesService->readAccountNoteAllFiles($accountId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountNoteFileDetails()
    {
        $accountId = "76GOU2";
        $noteUuid="120b31a9-82da-424b-939f-e8d44697c61c";
        $fileUuid = "4a810abe-2d48-4d78-b37f-0cd508c4c6d2";

        try {
            $response = $this->notesService->readAccountNoteFileDetails($accountId,$noteUuid,$fileUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatePaymentNotes()
    {
        $paymentId = 'PMT-IE1DSN-0008';
        $filePaths = 'C:\Users\Mehedi\Downloads\n.txt';
        $note = 'from sdk payment notes';

        try {
            $response = $this->notesService->createPaymentNotes($filePaths, $note, $paymentId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPaymentAllNotes()
    {
        $paymentId = 'PMT-IE1DSN-0008';
        try {
            $response = $this->notesService->readPaymentAllNotes($paymentId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddPaymentFile()
    {
        $paymentId = 'PMT-IE1DSN-0008';
        $filePath = 'C:\Users\Mehedi\Downloads\k.txt';
        $noteUuid="b6552cd7-fa15-4171-b41b-205e077832f3";

        try {
            $response = $this->notesService->addPaymentFile($filePath, $noteUuid, $paymentId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPaymentNotesDetails()
    {
        $paymentId = 'PMT-IE1DSN-0008';
        $noteUuid="b6552cd7-fa15-4171-b41b-205e077832f3";

        try {
            $response = $this->notesService->readPaymentNotesDetails($paymentId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPaymentNoteAllFiles()
    {
        $paymentId = 'PMT-IE1DSN-0008';
        $noteUuid="b6552cd7-fa15-4171-b41b-205e077832f3";

        try {
            $response = $this->notesService->readPaymentNoteAllFiles($paymentId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPaymentNoteFileDetails()
    {
        $paymentId = 'PMT-IE1DSN-0008';
        $noteUuid="b6552cd7-fa15-4171-b41b-205e077832f3";
        $fileUuid = "cedc9329-ea8d-4d51-820b-35bbe856e761";

        try {
            $response = $this->notesService->readPaymentNoteFileDetails($paymentId,$noteUuid,$fileUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatePurchaseOrderNotes()
    {
        $purchaseOrderId = 'PO-WP6Y1K-0021';
        $filePaths = 'C:\Users\Mehedi\Downloads\n.txt';
        $note = 'from sdk purchase order notes';

        try {
            $response = $this->notesService->createPurchaseOrderNotes($filePaths, $note, $purchaseOrderId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseOrderAllNotes()
    {
        $purchaseOrderId = 'PO-WP6Y1K-0021';
        try {
            $response = $this->notesService->readPurchaseOrderAllNotes($purchaseOrderId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddPurchaseOrderFile()
    {
        $purchaseOrderId = 'PO-WP6Y1K-0021';
        $filePath = 'C:\Users\Mehedi\Downloads\k.txt';
        $noteUuid="cf67fd85-824d-4d9d-b296-053bc095156c";

        try {
            $response = $this->notesService->addPurchaseOrderFile($filePath, $noteUuid, $purchaseOrderId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseOrderNotesDetails()
    {
        $purchaseOrderId = 'PO-WP6Y1K-0021';
        $noteUuid="cf67fd85-824d-4d9d-b296-053bc095156c";

        try {
            $response = $this->notesService->readPurchaseOrderNotesDetails($purchaseOrderId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseOrderNoteAllFiles()
    {
        $purchaseOrderId = 'PO-WP6Y1K-0021';
        $noteUuid="cf67fd85-824d-4d9d-b296-053bc095156c";

        try {
            $response = $this->notesService->readPurchaseOrderNoteAllFiles($purchaseOrderId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseOrderNoteFileDetails()
    {
        $purchaseOrderId = 'PO-WP6Y1K-0021';
        $noteUuid="cf67fd85-824d-4d9d-b296-053bc095156c";
        $fileUuid = "3cb695a4-357f-48e1-b58b-31f911ddd828";

        try {
            $response = $this->notesService->readPurchaseOrderNoteFileDetails($purchaseOrderId,$noteUuid,$fileUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateItemNotes()
    {
        $itemId = 'ITEM-0033';
        $filePaths = 'C:\Users\Mehedi\Downloads\n.txt';
        $note = 'Item Notes Here';

        try {
            $response = $this->notesService->createItemNotes($filePaths, $note, $itemId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatePurchaseInvoiceNotes()
    {
        $purchaseInvoiceId = 'PI-3YV4FY-0001';
        $filePath = 'C:\Users\Mehedi\Downloads\n.txt';
        $note = 'from sdk purchase Invoice notes';

        try {
            $response = $this->notesService->createPurchaseInvoiceNotes($filePath, $note, $purchaseInvoiceId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadItemAllNotes()
    {
        $itemId = 'ITEM-0033';
        try {
            $response = $this->notesService->readItemAllNotes($itemId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseInvoiceAllNotes()
    {
        $purchaseInvoiceId = 'PI-3YV4FY-0001';
        try {
            $response = $this->notesService->readPurchaseInvoiceAllNotes($purchaseInvoiceId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddPurchaseInvoiceFile()
    {
        $purchaseInvoiceId = 'PI-3YV4FY-0001';
        $filePath = 'C:\Users\Mehedi\Downloads\k.txt';
        $noteUuid="78982609-70d1-495d-818e-2a878c01c5a9";

        try {
            $response = $this->notesService->addPurchaseInvoiceFile($filePath, $noteUuid, $purchaseInvoiceId,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseInvoiceNotesDetails()
    {
        $purchaseInvoiceId = 'PI-3YV4FY-0001';
        $noteUuid="78982609-70d1-495d-818e-2a878c01c5a9";

        try {
            $response = $this->notesService->readPurchaseInvoiceNotesDetails($purchaseInvoiceId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseInvoiceNoteAllFiles()
    {
        $purchaseInvoiceId = 'PI-3YV4FY-0001';
        $noteUuid="78982609-70d1-495d-818e-2a878c01c5a9";

        try {
            $response = $this->notesService->readPurchaseInvoiceNoteAllFiles($purchaseInvoiceId,$noteUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadPurchaseInvoiceNoteFileDetails()
    {
        $purchaseInvoiceId = 'PO-WP6Y1K-0021';
        $noteUuid="78982609-70d1-495d-818e-2a878c01c5a9";
        $fileUuid = "762d4b09-abb7-4663-b18d-e422529be591";

        try {
            $response = $this->notesService->readPurchaseInvoiceNoteFileDetails($purchaseInvoiceId,$noteUuid,$fileUuid,'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



}

$notesManager = new NotesManager();
//$notesManager->testReadDetails();
//$notesManager->testReadAccountAllNotes();
//$notesManager->testCreateAccountNotes();
//$notesManager->testAddItemFile();
//$notesManager->testReadItemNotesDetails();
//$notesManager->testReadItemNoteAllFiles();
//$notesManager->testReadItemNoteFileDetails();
//$notesManager->testCreateOrderNotes();
//$notesManager->testReadOrderAllNotes();
//$notesManager->testAddOrderFile();
//$notesManager->testReadOrderNotesDetails();
//$notesManager->testReadOrderNoteAllFiles();
//$notesManager->testReadOrderNoteFileDetails();
//$notesManager->testCreateInvoiceNotes();
//$notesManager->testReadInvoiceAllNotes();
//$notesManager->testAddInvoiceFile();
//$notesManager->testReadInvoiceNotesDetails();
//$notesManager->testAddAccountFile();
//$notesManager->testReadAccountNotesDetails();
//$notesManager->testReadAccountNoteAllFiles();
//$notesManager->testReadAccountNoteFileDetails();
//$notesManager->testCreatePaymentNotes();
//$notesManager->testReadPaymentAllNotes();
//$notesManager->testAddPaymentFile();
//$notesManager->testReadPaymentNotesDetails();
//$notesManager->testReadPaymentNoteAllFiles();
//$notesManager->testReadPaymentNoteFileDetails();
//$notesManager->testCreatePurchaseOrderNotes();
//$notesManager->testReadPurchaseOrderAllNotes();
//$notesManager->testAddPurchaseOrderFile();
//$notesManager->testReadPurchaseOrderNotesDetails();
//$notesManager->testReadPurchaseOrderNoteAllFiles();
//$notesManager->testReadPurchaseOrderNoteFileDetails();
//$notesManager->testCreateItemNotes();
//$notesManager->testReadItemAllNotes();
//$notesManager->testReadPurchaseOrderNoteFileDetails();
//$notesManager->testCreatePurchaseInvoiceNotes();
//$notesManager->testReadPurchaseInvoiceAllNotes();
//$notesManager->testAddPurchaseInvoiceFile();
//$notesManager->testReadPurchaseInvoiceNotesDetails();
//$notesManager->testReadPurchaseInvoiceNoteAllFiles();
//$notesManager->testReadPurchaseInvoiceNoteFileDetails();