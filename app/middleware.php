<?php
// Application middleware

// $app->add(new \Slim\Csrf\Guard());

$app->add(new App\Middleware\OldInputMiddleware($container));

$app->add(new App\Middleware\RememberMiddleware($container));

// proteção conta ataque CSRF
$app->add(new App\Middleware\CsrfViewMiddleware($container));
$app->add($container->csrf);