<?php

declare(strict_types=1);

use App\Service\Discipline\DisciplineService;
use App\Service\Grade\GradeService;

use Psr\Container\ContainerInterface;

$container['discipline_service'] = static fn (
    ContainerInterface $container
): DisciplineService => new DisciplineService(
    $container->get('discipline_repository')
);

$container['grade_service'] = static fn (
    ContainerInterface $container
): GradeService => new GradeService(
    $container->get('grade_repository')
);

