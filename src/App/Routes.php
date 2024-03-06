<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

 use App\Controller\Discipline;
//  use App\Controller\Grade;
//  use App\Controller\User;
 use App\Middleware\Auth;

return static function ($app) {
    //Public routes
    $app->get('/', '\App\Controller\DefaultController:getHelp');
    $app->get('/login', '\App\Controller\User\Login:login');
    $app->get('/google/auth/callback', '\App\Controller\User\Login:callback');

    $app->group('/api', function () use ($app): void {
        $app->group('/test', function () use ($app): void {
            $app->get('/status', '\App\Controller\DefaultController:getStatus'); // Am pus getStatus aici sa vad daca e securizat behind the middleware
        })->add(new Auth());



        // poate facem un get student + /general, /scolaritate, /contact
        
        $app->group('/users', function () use ($app): void {
            $app->get('', User\GetAll::class);
            $app->get('/student', User\GetAllStudents::class);
            $app->get('/teacher', User\GetAllTeachers::class);
            $app->get('/teacher/discipline/{id}', User\GetOneTeacherByDiscipline::class);
            $app->get('/{id}', User\GetOne::class);
            $app->put('/{id}', User\Update::class);
            $app->delete('/{id}', User\Delete::class);
        });

        $app->group('/disciplines', function () use ($app): void {
            $app->get('', Discipline\GetAll::class);
            $app->get('/student/{stud_id}', Discipline\GetAllStudents::class);
            $app->post('/create', Discipline\Create::class);
            $app->get('/{id}', Discipline\GetOne::class);
            $app->put('/{id}', Discipline\Update::class);
            $app->delete('/{id}', Discipline\Delete::class);
        });

        // returneaza un json la grade cu examen, marire si restanta 
        $app->group('/grades', function () use ($app): void {
            $app->get('/student/{id}', Discipline\GetAll::class);
            $app->get('/student/{stud_id}/exam/{exam_id}', Discipline\GetOne::class);
            $app->post('/create', Discipline\Create::class);
            $app->put('/{id}', Discipline\Update::class);
            $app->delete('/{id}', Discipline\Delete::class);
        });
    });

    return $app;
};