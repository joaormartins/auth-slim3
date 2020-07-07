<?php
// rota teste
$app->get("/", "WebController:home")->setName("home");


$app->group("/auth", function ($container) use ($app) {


	$app->get("/login", "AuthController:login")->setName("auth.login");
	$app->post("/login", "AuthController:postLogin");

	$app->get("/register", "AuthController:register")->setName("auth.register");
	$app->post("/register", "AuthController:postRegister");

})->add(new App\Middleware\GhostMiddleware($container));

$app->get("/logout", "AuthController:logout")->setName("auth.logout");