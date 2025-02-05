<?php

/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '',
        'dbname'      => 'test',
        'charset'     => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/',
    ],
    'rabbitmq' => [
        'host'     => $_ENV['RABBITMQ_HOST'] ?? 'localhost',
        'port'     => $_ENV['RABBITMQ_PORT'] ?? 5672,
        'user'     => $_ENV['RABBITMQ_USER'] ?? 'guest',
        'password' => $_ENV['RABBITMQ_PASSWORD'] ?? 'guest',
        'queue'    => $_ENV['RABBITMQ_QUEUE'] ?? 'events_queue',
        'ssl'      => filter_var($_ENV['RABBITMQ_SSL'] ?? false, FILTER_VALIDATE_BOOLEAN),
        'ca_cert'  => $_ENV['RABBITMQ_CA_CERT'] ?? null,
    ]
]);
