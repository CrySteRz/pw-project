<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

 use App\Controller\Discipline;
 use App\Controller\Grade;
 use App\Controller\User;
 use App\Middleware\{Auth, StudentAuth, TeacherAuth, AdminAuth};
 

 use OpenApi\Annotations as OA;


return static function ($app) {
    $app->get('/', '\App\Controller\DefaultController:getHelp');
    $app->post('/login', User\Login::class);
    $app->get('/openapi', '\App\Controller\DefaultController:getOpenApiDefinition');

    $app->group('/teachers', function () use ($app): void {
        $app->get('/', User\GetAllTeachers::class);
    })->add(new AdminAuth());

    $app->group('/disciplines', function () use ($app): void {
        $app->get('/', Discipline\GetAll::class);
    })->add(new Auth());

    $app->group('/disciplines', function () use ($app): void {
        $app->post('/', Discipline\Create::class);
        $app->patch('/{id}', Discipline\Update::class);
        $app->delete('/{id}', Discipline\Delete::class);
    })->add(new AdminAuth());


    $app->group('/students',function () use ($app): void {
        $app->get('/', User\GetAllStudents::class);
    })->add(new AdminAuth());

    $app->group('/students', function () use ($app): void {
        $app->get('/data', User\GetUserByEmail::class);
    })->add(new StudentAuth());
    
    $app->group('/users', function () use ($app): void {
        $app->post('/', User\Create::class);
        $app->patch('/', User\Update::class);
        $app->delete('/', User\Delete::class);
    })->add(new AdminAuth());
   
    $app->group('/grades', function () use ($app): void {
        $app->patch('/', Grade\Update::class);
        $app->post('/csv', Grade\UpdateWithCsv::class);
    })->add(new TeacherAuth());

    $app->group('/grades', function () use ($app): void {
        $app->get('/', Grade\GetAll::class);
    })->add(new Auth());

    $app->group('/disciplines', function () use ($app): void {
        $app->get('/get-types', Discipline\GetDisciplineTypes::class);
    })->add(new Auth());
    return $app;
};