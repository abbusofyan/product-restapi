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

$router->group(['prefix' => 'api'], function()  use ($router){
  $router->post('register', 'AuthController@register');
  $router->post('login', 'AuthController@login');
  $router->get('getProducts', 'ProductController@index');
  $router->get('getProductById/{id}', 'ProductController@find');
  $router->post('addProduct', 'ProductController@add');
  $router->post('updateProduct/{id}', 'ProductController@update');
  $router->get('deleteProduct/{id}', 'ProductController@delete');
});
