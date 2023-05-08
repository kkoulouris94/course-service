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

$router->get('/courses', 'Courses\CoursesController@index');
$router->post('/courses', 'Courses\CoursesController@store');
$router->get('/courses/{id}', 'Courses\CoursesController@show');
$router->put('/courses/{id}', 'Courses\CoursesController@update');
$router->delete('/courses/{id}', 'Courses\CoursesController@delete');
