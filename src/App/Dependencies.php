<?php

declare(strict_types=1);
use Psr\Container\ContainerInterface;

$container['db'] = static function (ContainerInterface $container): PDO {
    $host = "localhost";
	$path = "sqlite:./database.db";
	$db = new PDO($path);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
};

$container['notFoundHandler'] = static function ($container) {
    return function ($request, $response) use ($container) {
        $response = $response->withStatus(404);
        $response->getBody()->write('Not Found');
        return $response->withHeader('Content-Type', 'text/html');
    };
};
