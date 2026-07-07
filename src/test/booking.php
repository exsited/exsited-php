<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Booking\BookingData;
use Api\ApiHelper\Config\ConfigManager;

class BookingManager
{
    private $bookingService;

    public function __construct($indexOrCredentials = 0)
    {
        $configManager = new ConfigManager();

        if (is_array($indexOrCredentials)) {
            $authCredentialData = $configManager->getConfigWithCredentials($indexOrCredentials);
        } else {
            $authCredentialData = $configManager->getConfig($indexOrCredentials);
        }
        $apiConfig = new ApiConfig($authCredentialData);
        $this->bookingService = new BookingData($apiConfig);
    }

    public function testCreateBooking()
    {
        $payload = [
            'order' => [
                'currency' => 'AUD',
                'account_id' => 'ASMUM1SW6HB1',
                'lines' => [
                    [
                        'labour_uuid' => '1948cc88-1170-480c-adf6-f408bd77f8f5',
                        'booking_start_time' => '2025-11-01 11:00',
                        'booking_end_time' => '2025-11-01 12:00'
                    ]
                ],
                'custom_attributes' => [
                    [
                        'name' => 'milestone_uuid',
                        'value' => 'test-milestone-uuid'
                    ]
                ]
            ]
        ];

        try {
            $response = $this->bookingService->create($payload, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testChangeBooking()
    {
        $orderId = 'ORD-ASMUM1SW6H-0269'; // Replace with actual order ID
        $payload = [
            'booking' => [
                'effective_date' => '2025-11-27',
                'lines' => [
                    [
                        'op' => 'change',
                        'uuid' => 'a844280b-a295-48aa-ab73-c514235b8452',
                        'booking_start_time' => '2025-11-02 11:00',
                        'booking_end_time' => '2025-11-02 12:05'
                    ]
                ]
            ]
        ];

        try {
            $response = $this->bookingService->changeBooking($orderId, $payload, 'v3');
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$manager = new BookingManager();

echo "<h2>Test: Create Booking</h2>";
$manager->testCreateBooking();

echo "<h2>Test: Change Booking</h2>";
$manager->testChangeBooking();
