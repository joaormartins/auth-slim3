<?php

session_start();
// var_dump($_SESSION);

require __DIR__ . "/../vendor/autoload.php";

// funcoes globais na aplicacao (dentro de modelos e controladores)
require __DIR__ . "/../app/helpers.php";


$config = require __DIR__ . "/../app/config.php";


$app = new \Slim\App($config);

// dependencias
require __DIR__ . "/../app/dependencies.php";


// middlewares
require __DIR__ . "/../app/middleware.php";

// rotas
require __DIR__ . "/../app/routes.php";