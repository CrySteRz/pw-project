<?php

declare(strict_types=1);

use App\Service\Discipline\DisciplineService;
// use App\Service\Discipline;
// use App\Service\Grade;
// use App\Service\User;
use Psr\Container\ContainerInterface;

$container['discipline_service'] = static fn (
    ContainerInterface $container
): DisciplineService => new DisciplineService(
    $container->get('discipline_repository')
);
