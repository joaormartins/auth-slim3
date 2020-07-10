<?php
namespace App\Middleware;

use App\Models\User;
use App\Models\UserSession;

class RememberMiddleware extends Middleware {

	public function __invoke($request, $response, $next)
	{
		$rememberCookie = $this->container->settings["auth"]["remember"];
		if (!$this->container->auth->loginState() && isset($_COOKIE[$rememberCookie])) {
			$hash = $_COOKIE[$rememberCookie];
			$uagent = userAgentNoVersion();
			$uSession = UserSession::where("session", $hash)->where("user_agent", $uagent)->first();
			if ($uSession && $user = User::find($uSession->user_id)) {
				if ($uSession->expiry > time()) {
					$this->container->auth->login($user);
					$this->container->flash->addMessage("info", "Seja bem vindo {$user->username}");
					return $response->withRedirect($this->container->router->pathFor("home"));
				}

				$uSession->delete();
				setcookie($rememberCookie, null, time()-1, '/');
			}
		}

		return $next($request, $response);

	}
}