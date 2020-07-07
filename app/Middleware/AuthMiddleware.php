<?php
namespace App\Middleware;

use App\Auth\Auth;

class AuthMiddleware extends Middleware {

	public function __invoke($request, $response, $next)
	{

		if ($this->container->auth->loginState() == Auth::NONE) {
			$this->container->flash->addMessage("error", "Access not allowed, Log In! :(");
			return $response->withRedirect($this->container->router->pathFor("auth.login"));
		}

		return $next($request, $response);

	}
}