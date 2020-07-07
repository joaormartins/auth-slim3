<?php
namespace App\Controllers;

use Respect\Validation\Validator as v;

use App\Models\User;

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

	// tentativa de cadastro (POST)
	public function postRegister($request, $response)
	{
		$v = $this->validation->validate($request, [
			"username" => v::notEmpty()->alnum()->length(6, 15),
			"email" => v::notEmpty()->email(),
			"password" => v::notEmpty()->length(8, null)
		]);

		if ($v->failed()) {
			return $response->withRedirect($this->router->pathFor("auth.register"));
		}

		User::create([
			"username" => $request->getParam("username"),
			"email" => $request->getParam("email"),
			"password" => password_hash($request->getParam("password"), PASSWORD_DEFAULT)
		]);

		return $response->withRedirect($this->router->pathFor("home"));
	}

}