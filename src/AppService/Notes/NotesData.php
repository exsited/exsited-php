<?php


namespace Api\AppService\Notes;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;
use Api\ApiHelper\SdkVersionManager;


class NotesData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function readAccountAllNotes($accountId,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountId, [], "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createAccountNotes($filePath, $note= null, $accountId,$apiVersion = null)
    {

        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        if ($note) {
            $data['note'] = $note;
        }

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::POST, $accountId, $data, "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addItemFile($filePath, $noteUuid, $itemId,$apiVersion = null)
    {
        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        $attribute="notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::POST, $itemId, $data, $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readItemNotesDetails($itemId,$noteUuid,$apiVersion = null)
    {

        $attribute = "notes/$noteUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::GET, $itemId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readItemNoteAllFiles($itemId,$noteUuid,$apiVersion = null)
    {

        $attribute = "notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::GET, $itemId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readItemNoteFileDetails($itemId,$noteUuid,$fileUuid,$apiVersion = null)
    {

        $attribute = "notes/$noteUuid/files/$fileUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::GET, $itemId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readDetails($noteUuid,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResource(ApiResource::NOTES, AutoBillApiSchemeHelper::GET, $noteUuid,[],$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createOrderNotes($filePath, $note = null, $orderId,$apiVersion = null)
    {
        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        if ($note) {
            $data['note'] = $note;
        }

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST, $orderId, $data, "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readOrderAllNotes($orderId,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $orderId, [], "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addOrderFile($filePath, $noteUuid, $orderId,$apiVersion = null)
    {
        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        $attribute="notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST, $orderId, $data, $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readOrderNotesDetails($orderId,$noteUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $orderId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readOrderNoteAllFiles($orderId,$noteUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $orderId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readOrderNoteFileDetails($orderId,$noteUuid,$fileUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid/files/$fileUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $orderId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createInvoiceNotes($filePath, $note = null , $invoiceId,$apiVersion = null)
    {
        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        if ($note) {
            $data['note'] = $note;
        }

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::POST, $invoiceId, $data, "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readInvoiceAllNotes($invoiceId,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET, $invoiceId, [], "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addInvoiceFile($filePath, $noteUuid, $invoiceId,$apiVersion = null)
    {
        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        $attribute="notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::POST,$invoiceId, $data, $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readInvoiceNotesDetails($invoiceId,$noteUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET, $invoiceId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addAccountFile($filePath, $noteUuid, $accountId, $apiVersion = null)
    {
        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        $attribute="notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::POST,$accountId, $data, $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readAccountNotesDetails($accountId,$noteUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readAccountNoteAllFiles($accountId,$noteUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readAccountNoteFileDetails($accountId,$noteUuid,$fileUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid/files/$fileUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createPaymentNotes($filePath, $note = null, $paymentId,$apiVersion = null)
    {
        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        if ($note) {
            $data['note'] = $note;
        }

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PAYMENTS, AutoBillApiSchemeHelper::POST, $paymentId, $data, "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPaymentAllNotes($paymentId,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PAYMENTS, AutoBillApiSchemeHelper::GET, $paymentId, [], "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addPaymentFile($filePath, $noteUuid, $paymentId,$apiVersion = null)
    {
        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        $attribute="notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PAYMENTS, AutoBillApiSchemeHelper::POST,$paymentId, $data, $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPaymentNotesDetails($paymentId,$noteUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PAYMENTS, AutoBillApiSchemeHelper::GET, $paymentId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPaymentNoteAllFiles($paymentId,$noteUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PAYMENTS, AutoBillApiSchemeHelper::GET,$paymentId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPaymentNoteFileDetails($paymentId,$noteUuid ,$fileUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid/files/$fileUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PAYMENTS, AutoBillApiSchemeHelper::GET, $paymentId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createPurchaseOrderNotes($filePath, $note = null, $purchaseOrderId,$apiVersion = null)
    {
        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        if ($note) {
            $data['note'] = $note;
        }

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::POST, $purchaseOrderId, $data, "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPurchaseOrderAllNotes($purchaseOrderId,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $purchaseOrderId, [], "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addPurchaseOrderFile($filePath, $noteUuid, $purchaseOrderId,$apiVersion = null)
    {
        $data = [];

        if (!empty($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        $attribute="notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::POST,$purchaseOrderId, $data, $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPurchaseOrderNotesDetails($purchaseOrderId,$noteUuid,$apiVersion = null)
    {

        $attribute = "notes/$noteUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $purchaseOrderId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPurchaseOrderNoteAllFiles($purchaseOrderId,$noteUuid,$apiVersion = null)
    {

        $attribute = "notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET,$purchaseOrderId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPurchaseOrderNoteFileDetails($purchaseOrderId, $noteUuid, $fileUuid,$apiVersion = null)
    {

        $attribute = "notes/$noteUuid/files/$fileUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $purchaseOrderId, [], $attribute,$apiVersion);

        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createItemNotes($filePath, $note = null, $itemId,$apiVersion = null) {
        $data = [];
        if ($filePath) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        if ($note) {
            $data['note'] = $note;
        }

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM,AutoBillApiSchemeHelper::POST,$itemId,$data,"notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readItemAllNotes($itemId,$apiVersion = null) {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM,AutoBillApiSchemeHelper::GET,$itemId,[],"notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createPurchaseInvoiceNotes($filePath, $note = null, $purchaseInvoiceId, $apiVersion = null)
    {
        $data = [];

        if ($filePath) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        if ($note) {
            $data['note'] = $note;
        }

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_INVOICE, AutoBillApiSchemeHelper::POST, $purchaseInvoiceId, $data, "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPurchaseInvoiceAllNotes($purchaseInvoiceId,$apiVersion = null)
    {
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_INVOICE, AutoBillApiSchemeHelper::GET, $purchaseInvoiceId, [], "notes",$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addPurchaseInvoiceFile($filePath, $noteUuid, $purchaseInvoiceId,$apiVersion = null)
    {
        $data = [];

        if ($filePath) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        $attribute="notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_INVOICE, AutoBillApiSchemeHelper::POST,$purchaseInvoiceId, $data, $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readPurchaseInvoiceNotesDetails($purchaseInvoiceId,$noteUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_INVOICE, AutoBillApiSchemeHelper::GET, $purchaseInvoiceId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPurchaseInvoiceNoteAllFiles($purchaseInvoiceId,$noteUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid/files";

        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_INVOICE, AutoBillApiSchemeHelper::GET,$purchaseInvoiceId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readPurchaseInvoiceNoteFileDetails($purchaseInvoiceId,$noteUuid,$fileUuid,$apiVersion = null)
    {
        $attribute = "notes/$noteUuid/files/$fileUuid";
        try {
            $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
            $apiVersion = $apiVersion ?? SdkVersionManager::getApiVersion();
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_INVOICE, AutoBillApiSchemeHelper::GET, $purchaseInvoiceId, [], $attribute,$apiVersion);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


}
