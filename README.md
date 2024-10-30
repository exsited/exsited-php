This document provides instructions for setting up a CakePHP project and integrating it with the Existed PHP SDK. Follow this guide to create the project, install the SDK, configure authentication, and make API calls.


## Table of Contents

1. [Prerequisites](https://webalive.atlassian.net/wiki/spaces/~712020e92ae4b6110e4b46a69521e45f32df3b/pages/edit-v2/842268704?draftShareId=751a7ab7-545e-489e-a59b-d2d76eee52ea#1.-Prerequisites)

2. [Project Setup](https://webalive.atlassian.net/wiki/spaces/~712020e92ae4b6110e4b46a69521e45f32df3b/pages/edit-v2/842268704?draftShareId=751a7ab7-545e-489e-a59b-d2d76eee52ea#2.-Project-Setup)

3. [Installing the SDK](https://webalive.atlassian.net/wiki/spaces/~712020e92ae4b6110e4b46a69521e45f32df3b/pages/edit-v2/842268704?draftShareId=751a7ab7-545e-489e-a59b-d2d76eee52ea#3.-Installing-the-SDK)

4. [Configuration](https://webalive.atlassian.net/wiki/spaces/~712020e92ae4b6110e4b46a69521e45f32df3b/pages/edit-v2/842268704?draftShareId=751a7ab7-545e-489e-a59b-d2d76eee52ea#4.-Configuration)

5. [Authentication Setup](https://webalive.atlassian.net/wiki/spaces/~712020e92ae4b6110e4b46a69521e45f32df3b/pages/edit-v2/842268704?draftShareId=751a7ab7-545e-489e-a59b-d2d76eee52ea#5.-Authentication-Setup)

6. [Making API Calls Using the SDK](https://webalive.atlassian.net/wiki/spaces/~712020e92ae4b6110e4b46a69521e45f32df3b/pages/edit-v2/842268704?draftShareId=751a7ab7-545e-489e-a59b-d2d76eee52ea#Step-4%3A-Testing-the-API-Call)


## 1. Prerequisites

To begin, ensure that you have the following installed:

- **PHP**: Version 7.0 or higher

- **XAMPP**: For local development and testing

- **Composer**: For managing dependencies

- **CakePHP**: For creating a new CakePHP project


## 2. Project Setup

### Step 1: Create a New CakePHP Project

1. Open your terminal or command prompt.

2. Run the following command to create a new CakePHP project: composer create-project --prefer-dist cakephp/app my\_cakephp\_project

3. Navigate to the project directory: cd my\_cakephp\_project


### Step 2: Configure Database (NA for Tester)

1. Open the config/app.php file in your IDE.

2. Update the Datasources section with your database credentials.

3. Ensure XAMPP is running, and your database is accessible.


## 3. Installing the SDK

### Step 1: Install the SDK Package

To integrate the SDK, install it via Composer:  composer require exsitedapi/exsited-sdk:dev-main

The SDK will be installed in the vendor directory of your CakePHP project.


### Step 2: Verify Installation

After installation, check that the SDK files are present in the vendor/apidemo/autobill-sdkdemo directory.


## 4. Configuration

Before calling the SDK, configure the required credentials and API settings.


### Step 1: Open SDK Project Directory

1. Navigate to the root directory of the SDK (located at vendor/apidemo/autobill-sdkdemo).

2. In the root directory of the SDK, create a file named token.json.


### Step 2: Update token.json File with Credentials

Fill in the token.json file with the provided credentials. If you have not received these details, please contact your designated client representative.


#### Example token.json:

    {
      "apiUrl": "https:\/\/api-stage.exsited.com\/",
      "appUrl": "https:\/\/api-stage.exsited.com\/",
      "client_id": "YzFhNzZjX2QrMzgvZDRkMmErNzU2ZSsyYi8vK2A1MzMrL2MzMzJhNTZiY2FkKzcuMi8rLmAzYS8=",
      "client_secret": "ZDJiODdkYGUsNjRgYWEvYTksYThlZSwzMDE4LDg2MDEsMjAxYS8yYThgMmI4LDgvMzAsZWI3M2A=",
      "access_token": "LCZZWilXKVUhLWInLSVaOTAhLSkpZSEoKlUpISwrKVUhLFpZVlgkJixZKyZaIS0kJCwhKyckV1c=",
      "refresh_token": "Dwk8PQw6DDgEOjELOwoIM2MECg8OOAQLOw87BDkLCQ8ECQcHCQk7BzwOBzw9BBAHBw8EOhAKCwg=",
      "redirect_uri": "https:\/\/www.google.com","authTokenRenewCallback": {}
    }


## 5. Authentication Setup

### Step 1: Set Up token.json

Update token.json in the SDK root directory with your credentials.


### Credentials Table

| Key            | Value                   |
| -------------- | ----------------------- |
| client\_id     | \[YOUR\_CLIENT\_ID]     |
| client\_secret | \[YOUR\_CLIENT\_SECRET] |
| redirect\_uri  | \[YOUR\_REDIRECT\_URI]  |
| apiUrl         | \[YOUR\_API\_URL]       |
| appUrl         | \[YOUR\_APP\_URL]       |

Replace the keys in token.json with the actual credentials provided to you.


## 6. Making API Calls Using the SDK

Now that the SDK is configured, you can use it to make API calls in your CakePHP project.


### Step 1: Create an SDK Controller

1. In your CakePHP project, navigate to src/Controller.

2. Create a new file named SdkController.php.


### Step 2: Configure the SDK in the Controller

Below is an example of how to call the SDK’s methods from a CakePHP controller.

    <?php
    namespace App\Controller;

    use Cake\Controller\Controller;
    use Cake\Controller\Component\RequestHandlerComponent;
    use Api\Component\ApiConfig;
    use Api\AppService\Account\AccountData;
    use Api\ApiHelper\Config\ConfigManager;

    class SdkController extends Controller
    {
        public function initialize(): void
        {
            parent::initialize();
            $this->loadComponent('RequestHandler'); // Load RequestHandler to handle JSON responses
        }

        public function getAccountData()
        {
            $this->autoRender = false; // Disable view rendering

            // Instantiate your configuration and API services
            $configManager = new ConfigManager();
            $authCredentialData = $configManager->getConfig();
            $apiConfig = new ApiConfig($authCredentialData);
            $accountService = new AccountData($apiConfig);

            try {
                // Call the readAll method
                $response = $accountService->readAll();

                // Set the response to JSON format
                $this->response = $this->response->withType('application/json')
                                                 ->withStringBody(json_encode(['response' => $response]));
            } catch (\Exception $e) {
                // Handle any exceptions
                $this->response = $this->response->withType('application/json')
                                                 ->withStringBody(json_encode(['error' => $e->getMessage()]));
            }
        }

        public function accountCreate()
        {
            $this->autoRender = false; // Disable view rendering

            $params = [
                "name" => "abcde",
                "email_address" => "basicinformationsami123@gmail.com",
            ];

            // Instantiate your configuration and API services
            $configManager = new ConfigManager();
            $authCredentialData = $configManager->getConfig();
            $apiConfig = new ApiConfig($authCredentialData);
            $accountService = new AccountData($apiConfig);

            try {
                // Call the create method on the AccountData service
                $response = $accountService->create($params);

                // Set the JSON response body
                $this->response = $this->response->withType('application/json')
                                                 ->withStringBody(json_encode($response, JSON_PRETTY_PRINT));
            } catch (\Exception $e) {
                // Handle the exception and respond with an error message
                $error = ['error' => $e->getMessage()];
                $this->response = $this->response->withType('application/json')
                                                 ->withStringBody(json_encode($error, JSON_PRETTY_PRINT));
            }
        }
    }

}


### Step 3: Create a Route for the SDK Call

In config/routes.php, add a route for the createAccount action:&#x20;

     $builder->connect('/sdk/account-data', ['controller' => 'Sdk', 'action' => 'getAccountData']);
     $builder->connect('/sdk/account-create', ['controller' => 'Sdk', 'action' => 'accountCreate']);


### Step 4: Testing the API Call

1. Start your XAMPP server.

2. Ensure the database (N/A for Tester) is running.


#### Method 1: Using XAMPP's htdocs Directory

If you want to access your CakePHP project through http\://localhost without specifying a port (e.g., if you're using XAMPP’s Apache server):

1. Move or copy your CakePHP project folder (my\_cakephp\_project) to the htdocs directory of XAMPP: C:\xampp\htdocs\my\_cakephp\_project

2. In your browser, access the application with: http\://localhost/my\_cakephp\_project/sdk/create-account


#### Method 2: Using the Built-in PHP Server

CakePHP provides a built-in command to start the server, which is ideal for local development:

1. Open a terminal or command prompt.

2. Navigate to your CakePHP project directory: cd path/to/my\_cakephp\_project

3. Run the following command to start the built-in PHP server: bin/cake server

4. By default, this will start the server at http\://localhost:8765.

5. In your browser, go to: http\://localhost:8765/sdk/create-account.

You should see a JSON response from the API, or an error message if something goes wrong\
**Note**: You can call other classes and methods from AppService in the same way as demonstrated above.

By following this guide, you should have your CakePHP project set up with the Existed PHP SDK, ready to make API calls and handle responses. If you encounter any issues, check your credentials and configuration settings.
