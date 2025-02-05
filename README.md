# 🚀 PHP-Producer (Phalcon + RabbitMQ)

This is a **Phalcon-based RabbitMQ Producer** that sends messages to RabbitMQ queues.

## 1. Clone the Repository
```sh
git clone https://github.com/AvigarD611/php-producer.git
cd php-producer
```

## 2. Install Dependencies
```sh
composer install
```

## 3. Configure Environment Variables
### 3.1. Copy the example .env file
```sh
cp .env.example .env
```

### 3.2. Open .env and update RabbitMQ credentials
```sh
RABBITMQ_HOST=your-rabbitmq-host
RABBITMQ_PORT=5671
RABBITMQ_USER=your-username
RABBITMQ_PASSWORD=your-password
```

## 4. Run the Producer
Now you should be able to run the producer - it is a script that sends a message with hardcoded data to RabbitMQ
```sh
php app/scripts/producer.php
```

## 5. View Messages in RabbitMQ UI
