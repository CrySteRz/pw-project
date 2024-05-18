<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$baseDir = __DIR__ . '/../../';
$dotenv = Dotenv\Dotenv::createImmutable($baseDir);
$envFile = $baseDir . '.env';

if (file_exists($envFile)) {
    $dotenv->load();
}
$settings = require __DIR__ . '/Settings.php';
$app = new \Slim\App($settings);


$corsOptions = array(
    "allowMethods" => array("POST, GET, PUT, DELETE, OPTIONS, PATCH"),
    );
$app->add(new \CorsSlim\CorsSlim($corsOptions));


$container = $app->getContainer();

require_once __DIR__ . '/Dependencies.php';
require_once __DIR__ . '/Services.php';
require_once __DIR__ . '/Repositories.php';
(require_once __DIR__ . '/Routes.php')($app);