<?php
// rota teste
$app->get("/", "WebController:home")->setName("home");


$app->group("/auth", function ($container) use ($app) {


	$app->get("/login", "AuthController:login")->setName("auth.login");

	$app->get("/register", "AuthController:register")->setName("auth.register");

});