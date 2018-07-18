<?php

$router->get('/', function () use ($router) {
  return $router->app->version();
});

$router->group(['prefix' => 'api'], function() use ($router) {
  $router->get('product',         ['uses' => 'ProductController@show']);
});

$router->group(['prefix' => 'api'], function() use ($router) {
  $router->post('product',        ['uses' => 'ProductController@store']);
  $router->patch('product/{id}',  ['uses' => 'ProductController@update']);
  $router->delete('product/{id}', ['uses' => 'ProductController@destroy']);
});
