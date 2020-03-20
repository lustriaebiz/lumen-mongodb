<?php

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



$router->group(['prefix' => 'spatie', 'middleware' => 'jwt.auth'], function ($router) {
    $router->get('/roles',  'UserController@GetRolePermission');
    $router->post('/roles', 'UserController@CreateRolePermission');
});

$router->group(['prefix' => 'jwt'], function ($router) {
    $router->post('/token', 'UserController@encode');
    $router->post('/decode', 'UserController@decode');
});

$router->group(['prefix' => 'cars', 'middleware' => 'jwt.auth'], function ($router) {
    $router->get('/list', 'CarsController@list');
    $router->post('/store', 'CarsController@store');
    $router->put('/update/{id}', 'CarsController@update');
    $router->get('/detail/{id}', 'CarsController@detail');
    $router->delete('/destroy/{id}', 'CarsController@destroy');
});

$router->group(['prefix' => 'redis'], function ($router) {
    $router->post('/set', 'RedisController@setter');
    $router->get('/get', 'RedisController@getter');
    $router->post('/publish', 'RedisController@publish');
    $router->delete('/destroy', 'RedisController@destroy');
});

