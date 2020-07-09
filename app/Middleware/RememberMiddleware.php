<?php
namespace App\Middleware;

use App\Models\User;
use App\Models\UserSession;

class RememberMiddleware extends Middleware {

	public function __invoke($request, $response, $next)
	{
		$this->check();

		return $next($request, $response);

	}

	protected function check()
	{
		$rememberCookie = $this->container->settings["auth"]["remember"];
		if (!$this->container->auth->loginState() && isset($_COOKIE[$rememberCookie])) {
			$hash = $_COOKIE[$rememberCookie];
			$uagent = userAgentNoVersion();
			$uSession = UserSession::where("session", $hash)->where("user_agent", $uagent)->first();
			if ($uSession && $user = User::find($uSession->user_id)) {
				if ($uSession->expiry < time()) {
					$uSession->delete();
					setcookie($rememberCookie, null, time()-1, '/');
					return;
				}
				$this->container->auth->login($user);
			}
		}
	}
}