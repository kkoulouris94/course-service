<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['namespace' => 'Courses'], function () use ($router) {
    $router->get('/courses', 'CoursesController@index');
    $router->get('/courses/{id}', 'CoursesController@show');
    $router->delete('/courses/{id}', 'CoursesController@delete');

    $router->group(['middleware' => 'ensure.json'], function () use ($router) {
        $router->post('/courses', 'CoursesController@store');
        $router->put('/courses/{id}', 'CoursesController@update');
    });
});
