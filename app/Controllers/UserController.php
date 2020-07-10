<?php
namespace App\Controllers;

class UserController extends Controller {


	public function changePassword($request, $response)
	{

		return $this->view->render($response, "user/change_password.twig");
	}

	public function postChangePassword($request, $response)
	{
		
	}

}