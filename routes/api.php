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



$router->group(['prefix' => 'roles', 'middleware' => ['jwt.auth', 'role:super-admin']], function ($router) {
    $router->post('/create-with-permissions', 'RolesController@CreateRolePermissions');
    $router->get('/list', 'RolesController@list');
});

$router->group(['prefix' => 'permission', 'middleware' => 'jwt.auth'], function ($router) {
    $router->get('/list', 'PermissionController@list');
    $router->post('/create', 'PermissionController@store');
});

$router->group(['prefix' => 'user', 'middleware' => 'jwt.auth'], function ($router) {
    $router->get('/role-permissions',  'UserController@hasRolePermissions');

    $router->post('/assign-role-permission',  'UserController@assignRolePermissions');
    $router->post('/remove-role-permission',  'UserController@removeRolePermissions');

    $router->post('/give-permissions',  'UserController@givePermissions');
    $router->post('/revoke-permissions',  'UserController@revokePermissions');
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

