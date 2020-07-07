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

	public function postLogin($request, $response)
	{
		$pass = $this->auth->loginAttemp($request->getParams());

		if (!$pass) {
			$this->flash->addMessage("error", $this->auth->error);
			return $response->withRedirect($this->router->pathFor("auth.login"));
		}

		$this->flash->addMessage("success", "Successfully login!");
		return $response->withRedirect($this->router->pathFor("home"));
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
			"username" => v::notEmpty()->alnum()->length(6, 15)->usernameAvailable(),
			"email" => v::notEmpty()->email()->emailAvailable(),
			"password" => v::notEmpty()->length(8, null),
			"password_confirm" => v::passwdMatch($request->getParam("password"))
		]);

		if ($v->failed()) {
			$this->flash->addMessage("error", $v->first());
			return $response->withRedirect($this->router->pathFor("auth.register"));
		}

		$user = User::create([
			"username" => $request->getParam("username"),
			"email" => $request->getParam("email"),
			"password" => password_hash($request->getParam("password"), PASSWORD_DEFAULT)
		]);

		$this->flash->addMessage("success", "Successfully registration!");
		return $response->withRedirect($this->router->pathFor("home"));
	}

}