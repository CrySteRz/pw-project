<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

 use App\Controller\Discipline;
 use App\Controller\Grade;
 use App\Controller\User;
 use App\Middleware\{Auth, StudentAuth, TeacherAuth, AdminAuth}; // Le folosesti de aici pentru ce ai nevoie all of them work Auth e middleware general si restul sunt pentru roluri
 

 use OpenApi\Annotations as OA;


return static function ($app) {
    $app->get('/', '\App\Controller\DefaultController:getHelp');
    $app->post('/login', User\Login::class);
    $app->get('/openapi', '\App\Controller\DefaultController:getOpenApiDefinition');

    $app->group('/admin', function () use ($app): void {
        $app->get('/students', User\GetAllStudents::class);
        $app->get('/teachers', User\GetAllTeachers::class);
        $app->get('/disciplines', Discipline\GetAll::class);
        $app->get('/grades', Grade\GetAll::class);
    });
    // ->add(new AdminAuth());

    $app->group('/disciplines', function () use ($app): void {
        $app->post('/', Discipline\Create::class);
        $app->patch('/{id}', Discipline\Update::class);
        $app->delete('/{id}', Discipline\Delete::class);
    });
    // ->add(new AdminAuth());

    $app->group('/teachers', function () use ($app): void {
        $app->patch('/{id}', Grade\Update::class);
    });
    // ->add(new TeacherAuth());

    $app->group('/students', function () use ($app): void {
        $app->get('/data', User\GetUserByEmail::class);
        $app->get('/disciplines', User\getDisciplinesByUserEmail::class);
        $app->get('/grades', User\GetAllGradesByUserEmail::class);
    })->add(new StudentAuth());
    
    $app->group('/users', function () use ($app): void {
        $app->post('/', User\Create::class);
        $app->patch('/', User\Update::class);
        $app->delete('/', User\Delete::class);
    });
    // ->add(new AdminAuth());
   
    $app->group('/grades', function () use ($app): void {
        $app->get('/?studentId={stud_id}&examId={exam_id}', Grade\GetOne::class);
    });

    $app->group('/disciplines', function () use ($app): void {
        $app->get('/get-types', Discipline\GetDisciplineTypes::class);
    });
    return $app;
};