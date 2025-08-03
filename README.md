# CakePHP Project Setup with Exsited PHP SDK

This document provides step-by-step instructions for setting up a CakePHP project and integrating it with the Exsited PHP SDK. Follow this guide to create the project, install the SDK, configure authentication, and make API calls.

## Table of Contents
1. [Prerequisites](#1-prerequisites)
2. [Project Setup](#2-project-setup)
3. [Installing the SDK](#3-installing-the-sdk)
4. [Configuration](#4-configuration)
5. [Authentication Setup](#5-authentication-setup)
6. [Making API Calls Using the SDK](#6-making-api-calls-using-the-sdk)

## 1. Prerequisites
Ensure you have the following installed:
- **PHP**: Version 7.0 or higher
- **XAMPP**: For local development and testing
- **Composer**: Dependency management
- **CakePHP**: PHP framework for the project

## 2. Project Setup

### Step 1: Create a New CakePHP Project
```bash
composer create-project --prefer-dist cakephp/app my_cakephp_project
cd my_cakephp_project
```

### Step 2: Configure Database (Optional for Testing)
- Edit `config/app.php`
- Update the `Datasources` section with your database credentials.
- Ensure XAMPP is running and the database is accessible.

## 3. Installing the SDK

### Step 1: Install the SDK Package
```bash
composer require exsitedapi/exsited-sdk:dev-main --with-all-dependencies
```

### Step 2: Verify Installation
- SDK should be located at: `vendor/apidemo/autobill-sdkdemo`

## 4. Configuration

### Step 1: Create `token.json`
In `vendor/apidemo/autobill-sdkdemo/`, create `token.json`:
```json
[
  {
    "apiUrl": "https://api-stage.exsited.com/",
    "appUrl": "https://api-stage.exsited.com/",
    "client_id": "[YOUR_CLIENT_ID]",
    "client_secret": "[YOUR_CLIENT_SECRET]",
    "access_token": "[YOUR_ACCESS_TOKEN]",
    "refresh_token": "[YOUR_REFRESH_TOKEN]",
    "redirect_uri": "https://www.google.com",
    "authTokenRenewCallback": {}
  }
]
```

### Step 2: Create `sdk-config.json`
```json
{
  "apiVersion": "v3",
  "reQuestTimeOut": 240
}
```

## 5. Authentication Setup

Update `token.json` with actual credentials:

| Key            | Value               |
|----------------|---------------------|
| `client_id`    | [YOUR_CLIENT_ID]    |
| `client_secret`| [YOUR_CLIENT_SECRET]|
| `redirect_uri` | [YOUR_REDIRECT_URI] |
| `apiUrl`       | [YOUR_API_URL]      |
| `appUrl`       | [YOUR_APP_URL]      |

## 6. Making API Calls Using the SDK

### Step 1: Create SDK Controller

`src/Controller/SdkController.php`
```php
<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Api\Component\ApiConfig;
use Api\AppService\Account\AccountData;
use Api\ApiHelper\Config\ConfigManager;

class SdkController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function getAccountData()
    {
        $this->autoRender = false;
        $configManager = new ConfigManager();
        $apiConfig = new ApiConfig($configManager->getConfig());
        $accountService = new AccountData($apiConfig);

        try {
            $response = $accountService->readAll('v3');
            $this->response = $this->response->withType('application/json')->withStringBody(json_encode(['response' => $response]));
        } catch (\Exception $e) {
            $this->response = $this->response->withType('application/json')->withStringBody(json_encode(['error' => $e->getMessage()]));
        }
    }

    public function accountCreate()
    {
        $this->autoRender = false;
        $params = ["name" => "abcde", "email_address" => "basicinformationsami123@gmail.com"];
        $configManager = new ConfigManager();
        $apiConfig = new ApiConfig($configManager->getConfig());
        $accountService = new AccountData($apiConfig);

        try {
            $response = $accountService->create($params, 'v2');
            $this->response = $this->response->withType('application/json')->withStringBody(json_encode($response, JSON_PRETTY_PRINT));
        } catch (\Exception $e) {
            $error = ['error' => $e->getMessage()];
            $this->response = $this->response->withType('application/json')->withStringBody(json_encode($error, JSON_PRETTY_PRINT));
        }
    }
}
```

### Step 2: Add Routes
In `config/routes.php`:
```php
$builder->connect('/sdk/account-data', ['controller' => 'Sdk', 'action' => 'getAccountData']);
$builder->connect('/sdk/account-create', ['controller' => 'Sdk', 'action' => 'accountCreate']);
```

### Step 3: Start the Server

**Option 1: Using XAMPP**
- Move project folder to `htdocs` directory.
- Visit: `http://localhost/my_cakephp_project/sdk/account-create`

**Option 2: Using Built-in PHP Server**
```bash
bin/cake server
```
Visit: `http://localhost:8765/sdk/account-create`

### Authentication Workflow with API Versioning
- If no version is specified, the SDK uses the version from `sdk-config.json`.
- Explicit version overrides `sdk-config.json` for specific API calls.

## Conclusion

Your CakePHP project is now configured with the Exsited PHP SDK and ready to make API calls. For issues, verify credentials and configurations.

