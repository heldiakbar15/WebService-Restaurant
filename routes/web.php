<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\MenusController;
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

$router->group(['prefix' => 'auth'], function () use ($router){
    $router->post('/register','AuthController@register');
    $router->post('/login','AuthController@login');
});

$router->get('menus','MenusController@index');
$router->get('menus/{id}','MenusController@show');
$router->post('/menus', 'MenusController@store');
$router->put('menus/{id}', 'MenusController@update');
$router->delete('menus/{id}','MenusController@destroy');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('orders', 'OrdersController@index');
    $router->get('orders/{id}', 'OrdersController@show');
    $router->post('orders', 'OrdersController@store');
    $router->put('orders/{id}', 'OrdersController@update');
    $router->delete('orders/{id}', 'OrdersController@destroy');
});