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

$router->post("/register", "UserController@register");
$router->post("/login", "UserController@login");

$router->group(['middleware'=>'auth.api'], function () use ($router) {
    $router->post("/merchant", "MerchantController@show");
    $router->post("/order", "MerchantController@order");
    $router->post("/order/history", "CustomerController@history");
    $router->post("/order/detail", "CustomerController@orderDetail");
});