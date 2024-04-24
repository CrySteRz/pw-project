<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

 use App\Controller\Discipline;
 use App\Controller\Grade;
 use App\Controller\User;
 use App\Middleware\Auth;
 use OpenApi\Annotations as OA;


return static function ($app) {
    $app->get('/', '\App\Controller\DefaultController:getHelp');
    $app->post('/login/google', '\App\Controller\User\Login:login');
    

    $app->get('/openapi', '\App\Controller\DefaultController:getOpenApiDefinition');

    $app->group('/students', function () use ($app): void {
        $app->get('/', User\GetAllStudents::class);
        $app->get('/data', User\GetStudentByEmail::class);
        $app->get('/disciplines', User\getDisciplinesByUserEmail::class);
        $app->get('/grades', User\GetAllGradesByUserEmail::class);
    });

    $app->group('/teachers', function () use ($app): void {
        $app->get('/', User\GetAllTeachers::class);
        $app->get('/{discipline_id}', User\GetOneTeacherByDiscipline::class);
    });

    $app->group('/users', function () use ($app): void {
        $app->get('/', User\GetAll::class);
        $app->post('/', User\Create::class);
        $app->patch('', User\Update::class);
    $app->delete('', User\Delete::class);
    });

    $app->group('/disciplines', function () use ($app): void {
        $app->get('/', Discipline\GetAll::class);
        $app->get('/get-types', Discipline\GetDisciplineTypes::class);
        $app->get('/{id}', Discipline\GetOne::class);
        $app->post('/', Discipline\Create::class);
        $app->patch('/{id}', Discipline\Update::class);
        $app->delete('/{id}', Discipline\Delete::class);
    });

    // returneaza un json la grade cu examen, marire si restanta 
    $app->group('/grades', function () use ($app): void {
        $app->get('/', Grade\GetAll::class);
        $app->get('/?studentId={stud_id}&examId={exam_id}', Grade\GetOne::class);
        $app->post('/', Grade\Create::class);
        $app->patch('/{id}', Grade\Update::class);
        $app->delete('/{id}', Grade\Delete::class);
    });
    return $app;
};