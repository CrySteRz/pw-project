<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$baseDir = __DIR__ . '/../../';
$dotenv = Dotenv\Dotenv::createImmutable($baseDir);
$envFile = $baseDir . '.env';

if (file_exists($envFile)) {
    $dotenv->load();
}

$app = new \Slim\App();
#$app->add(new \CorsSlim\CorsSlim()); // composer require palanik/corsslim inca nu stiu daca vrem sa folosim asta

$container = $app->getContainer();

// require_once __DIR__ . '/Services.php';
// require_once __DIR__ . '/Repositories.php';
require_once __DIR__ . '/Dependencies.php';
(require_once __DIR__ . '/Routes.php')($app);

