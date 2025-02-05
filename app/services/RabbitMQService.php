<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    private $connection;
    private $channel;
    private string $queue;

    public function __construct($config)
    {
        $this->queue = $config['queue'];

        if ($config['ssl']) {
            // Use SSL connection for Amazon MQ
            $sslOptions = [
                'capath' => null,
                'cafile' => __DIR__ . '/../../' . $config['ca_cert'], // Load CA certificate
            ];

            $this->connection = new AMQPSSLConnection(
                $config['host'],
                $config['port'],
                $config['user'],
                $config['password'],
                '/',
                $sslOptions
            );
        } else {
            // Use standard connection for local RabbitMQ
            $this->connection = new AMQPStreamConnection(
                $config['host'],
                $config['port'],
                $config['user'],
                $config['password']
            );
        }

        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queue, false, true, false, false);
    }

    public function publish(string $message)
    {
        $msg = new AMQPMessage($message, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
        $this->channel->basic_publish($msg, '', $this->queue);
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
