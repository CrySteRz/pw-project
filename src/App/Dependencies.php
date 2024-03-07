<?php

declare(strict_types=1);
use Psr\Container\ContainerInterface;
use App\Handler\ApiError;

$container['db'] = static function (ContainerInterface $container): PDO {
    $host = "localhost";
	$path = "sqlite:./../../db/database.db";
	$db = new PDO($path);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
};
$container['errorHandler'] = static function (): ApiError {
    return new ApiError();
};

$container['notFoundHandler'] = static function () {
    return static function ($request, $response): void {
        throw new \App\Exception\NotFound('Endpoint not found. Check your URL and try again.', 404);
    };
};