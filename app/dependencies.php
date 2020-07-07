<?php

$container = $app->getContainer();

// database
$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container["settings"]["db"]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container["db"] = function ($container) use ($capsule) {
	return $capsule;
};

//-
$container["auth"] = function ($container) {
	return new App\Auth\Auth($container);
};

// view
$container["view"] = function ($container) use ($app) {
	$config = $container->get("settings");
	$view = new \Slim\Views\Twig($config["view"]["template_path"],
		$config["view"]["twig"]);


	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->get("router"),
		$container->get("request")->getUri()
	));

	// auth data
	$view->getEnvironment()->addGlobal("auth", [
		"state" => $container->auth->loginState(),
		"user" => $container->auth->user()
	]);


	return $view;
};


$container["WebController"] = function ($container) {
	return new App\Controllers\WebController($container);
};
$container["AuthController"] = function ($container) {
	return new App\Controllers\AuthController($container);
};