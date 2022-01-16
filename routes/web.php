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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/index', function () use ($router) {
    return "Hello Word!";
});

$router->group(['prefix' => 'api'], function () use ($router){
    $router->get(uri:'/posts', action:'PostController@index');
    $router->post(uri:'/posts', action:'PostController@store');
    $router->put(uri:'/posts/{id}', action:'PostController@update');
    $router->delete(uri:'/posts/{id}', action:'PostController@destroy');
});
