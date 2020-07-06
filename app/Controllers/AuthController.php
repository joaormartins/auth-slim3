<?php
namespace App\Controllers;


class AuthController extends Controller {

	// pagina do login (GET)
	public function login($request, $response)
	{
		return $this->view->render($response, "auth/login.twig");
	}


	// pagina do cadastro (GET)
	public function register($request, $response)
	{
		return $this->view->render($response, "auth/register.twig");
	}

}