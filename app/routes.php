<?php

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {

    $route->get('/users', 'UserController@index');

    $route->get('/login', 'AuthController@loginPage');
    $route->post('/login', 'AuthController@login');

    $route->get('/register', 'AuthController@registerPage');
    $route->post('/register', 'AuthController@register');

    $route->get("/",'UserController@home');


    $route->post("/api/register",'Api\AuthController@register');
    $route->post("/api/login",'Api\AuthController@login');
    $route->post("/api/logout",'Api\AuthController@logout');

    $route->get("/api/users",'Api\UserController@index');
    $route->get("/api/user",'Api\UserController@user');

});