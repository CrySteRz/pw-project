<?php

declare(strict_types=1);
use Psr\Container\ContainerInterface;

$container['db'] = static function (ContainerInterface $container): PDO {
    $host = "localhost";
	$name = "sqlite:./database.db";
	$db = new PDO($name);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
};

// $container['notFoundHandler'] = static function () {
//     return static function ($request, $response): void {
//         throw new \App\Exception\NotFound('Route Not Found.', 404);
//     };
// };