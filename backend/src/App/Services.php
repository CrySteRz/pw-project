<?php

declare(strict_types=1);

use App\Service\DisciplineService;
use App\Service\GradeService;
use App\Service\UserService;

use Psr\Container\ContainerInterface;

$container['discipline_service'] = static fn (
    ContainerInterface $container
): DisciplineService => new DisciplineService(
    $container->get('discipline_repository'),
    $container->get('exam_repository'),
    $container->get('grade_repository')
);

$container['grade_service'] = static fn (
    ContainerInterface $container
): GradeService => new GradeService(
    $container->get('grade_repository')
);

$container['user_service'] = static fn (
    ContainerInterface $container
): UserService => new UserService(
    $container->get('user_repository')
);

