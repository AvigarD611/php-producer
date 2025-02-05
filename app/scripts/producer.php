<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Dto\EventMessageDTO;
use App\Services\RabbitMQService;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// Get config
$config = require __DIR__ . '/../config/config.php';
$rabbitMQ = new RabbitMQService($config['rabbitmq']);

// Hardcoded data
$event = new EventMessageDTO(
    "1ef7014d-f418-68a4-bb1f-0242ac120004",
    "user.wallet_deactivated",
    "e36b69f9aac9fffd8fab1a7109f1c107",
    [
        "user_id" => "66df04dc72c0d90d26bf618f",
        "wallet_id" => "bd9e393b9fcb602e4a95d357fbba9b4b",
    ]
);

// Publish message
$rabbitMQ->publish($event->toJson());

echo "Message sent successfully with hardcoded data:\n";
echo json_encode($event, JSON_PRETTY_PRINT) . PHP_EOL;

$rabbitMQ->close();
