<?php


// Routes
$app->get('/', 'HomeController:index');
$app->get('/login/[{name}]', 'LoginController:index');
