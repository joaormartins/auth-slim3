<?php
namespace App\Middleware;


class GhostMiddleware extends Middleware {

	public function __invoke($request, $response, $next)
	{

		if ($this->container->auth->loginState()) {
			$this->container->flash->addMessage("info", ":/");
			return $response->withRedirect($this->container->router->pathFor("home"));
		}

		return $next($request, $response);

	}
}