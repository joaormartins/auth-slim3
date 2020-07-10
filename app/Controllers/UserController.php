<?php
namespace App\Controllers;

class UserController extends Controller {


	public function changePassword($request, $response)
	{

		return $this->view->render($response, "user/change_password.twig");
	}

	public function postChangePassword($request, $response)
	{
		$pass = $this->auth->changePassword($request->getParams());

		if (!$pass) {
			$this->flash->addMessage("error", $this->auth->error);
			return $response->withRedirect($this->router->pathFor("user.change_password"));
		}

		$this->flash->addMessage("success", "Sua senha foi alterada com sucesso!");
		return $response->withRedirect($this->router->pathFor("home"));
	}

}