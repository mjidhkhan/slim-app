<?php

/** @var \Interop\Container\ContainerInterface $container */
$container = $app->getContainer();
$container['HomeController'] = function ($container) {
    return new \App\Controller\HomeController($container
    );
};
$container['LoginController'] = function ($container) {
    return new \App\Controller\LoginController($container
    );
};
