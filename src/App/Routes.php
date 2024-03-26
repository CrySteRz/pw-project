<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

 use App\Controller\Discipline;
 use App\Controller\Grade;
//  use App\Controller\User;
 use App\Middleware\Auth;
 use OpenApi\Annotations as OA;


return static function ($app) {
    //Public routes
    $app->get('/', '\App\Controller\DefaultController:getHelp');
    $app->get('/login', '\App\Controller\User\Login:login');
    $app->get('/google/auth/callback', '\App\Controller\User\Login:callback');

    // $app->group('/api', function () use ($app): void {
    //     $app->group('/test', function () use ($app): void {
    //         $app->get('/status', '\App\Controller\DefaultController:getStatus'); // Am pus getStatus aici sa vad daca e securizat behind the middleware
    //     })->add(new Auth());

        $app->get('/openapi', '\App\Controller\DefaultController:getOpenApiDefinition');
        $app->group('/users', function () use ($app): void {
            $app->get('/', User\GetAll::class);
            $app->get('/student', User\GetAllStudents::class);
            $app->get('/teacher', User\GetAllTeachers::class);
            $app->get('/teachersByDiscId/{id}', User\GetOneTeacherByDiscipline::class);
            $app->get('/{id}', User\GetOne::class);
            $app->patch('/{id}', User\Update::class);
            $app->delete('/{id}', User\Delete::class);
        });

        $app->group('/disciplines', function () use ($app): void {
            $app->get('/', Discipline\GetAll::class);
            $app->get('/student/{stud_id}', Discipline\getAllByUserId::class);
            $app->get('/{id}', Discipline\GetOne::class);
            $app->post('/', Discipline\Create::class);
            $app->patch('/{id}', Discipline\Update::class);
            $app->delete('/{id}', Discipline\Delete::class);
        });

        // returneaza un json la grade cu examen, marire si restanta 
        $app->group('/grades', function () use ($app): void {
            $app->get('/student/{stud_id}', Grade\GetAllByStudentId::class);
            $app->get('/student/{stud_id}/exam/{exam_id}', Grade\GetOne::class);
            $app->post('/', Grade\Create::class);
            $app->patch('/{id}', Grade\Update::class);
            $app->delete('/{id}', Grade\Delete::class);
        });
    // });

    return $app;
};