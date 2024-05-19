<?php

declare(strict_types=1);

use App\Repository\DisciplineRepository;
use App\Repository\GradeRepository;
use App\Repository\UserRepository;
use App\Repository\ExamRepository;
use Psr\Container\ContainerInterface;

$container['user_repository'] = static fn (
    ContainerInterface $container
): UserRepository => new UserRepository($container->get('db'));

$container['discipline_repository'] = static fn (
    ContainerInterface $container
): DisciplineRepository => new DisciplineRepository($container->get('db'));

$container['grade_repository'] = static fn (
    ContainerInterface $container
): GradeRepository => new GradeRepository($container->get('db'));

$container['exam_repository'] = static fn (
    ContainerInterface $container
): ExamRepository => new ExamRepository($container->get('db'));