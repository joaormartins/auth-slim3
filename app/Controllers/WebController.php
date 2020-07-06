<?php
namespace App\Controllers;


class WebController extends Controller {


	public function home($request, $response)
	{
		return $this->view->render($response, "home.twig", [
			"sum" => sum(15, 20)
		]);
	}

}