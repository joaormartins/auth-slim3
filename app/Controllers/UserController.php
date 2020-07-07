<?php
namespace App\Controllers;

class UserController extends Controller {


	public function profile($request, $response)
	{

		return $this->view->render($response, "user/profile.twig");
	}

}