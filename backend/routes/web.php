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

$router->get('/teste', 'TestCtrl@index');

$router->group([
    "prefix" => "/api/v1",
    "middleware" => "auth",
], function () use ($router) {
    $router->group(["prefix" => "/user"], function () use ($router) {
        $router->post('/create', 'v1\UserCtrl@create');
        $router->post('/search', 'v1\UserCtrl@search');
        $router->put('/edit/{id}', 'v1\UserCtrl@edit');
        $router->put('/changepwd/{id}', 'v1\UserCtrl@changePwd');
        $router->delete('/exclude/{id}', 'v1\UserCtrl@exclude');
        $router->post('/searchexcludes', 'v1\UserCtrl@searchExcludes');
        $router->get('/restore/{id}', 'v1\UserCtrl@restore');
        $router->get('/getbyid', 'v1\UserCtrl@getById');
    });
    $router->group(["prefix" => "/employees"], function () use ($router) {
        $router->post('/create', 'v1\EmployeesCtrl@create');
        $router->post('/search', 'v1\EmployeesCtrl@search');
        $router->put('/edit/{id}', 'v1\EmployeesCtrl@edit');
        $router->delete('/exclude/{id}', 'v1\EmployeesCtrl@exclude');
        $router->post('/searchexcludes', 'v1\EmployeesCtrl@searchExcludes');
        $router->get('/restore/{id}', 'v1\EmployeesCtrl@restore');
        $router->get('/getbyid', 'v1\EmployeesCtrl@getById');
    });
    $router->group(["prefix" => "/companies"], function () use ($router) {
        $router->post('/create', 'v1\CompaniesCtrl@create');
        $router->post('/search', 'v1\CompaniesCtrl@search');
        $router->put('/edit/{id}', 'v1\CompaniesCtrl@edit');
        $router->delete('/exclude/{id}', 'v1\CompaniesCtrl@exclude');
        $router->post('/searchexcludes', 'v1\CompaniesCtrl@searchExcludes');
        $router->get('/restore/{id}', 'v1\CompaniesCtrl@restore');
        $router->get('/getbyid', 'v1\CompaniesCtrl@getById');
    });
    $router->group(["prefix" => "/oauth"], function () use ($router) {
        $router->get('/logout', 'v1\AuthCtrl@logout');
    });
});
