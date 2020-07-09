<?php
namespace App\Auth;

use App\Models\User;
use App\Models\UserSession;

class Auth {

	const NONE = 0;
	const LOGGED = 1;
	const ADMIN = 2;

	protected $container, $config;

	protected $state, $user;

	public $error, $obj;

	public function __construct($container)
	{
		$this->container = $container;
		$this->config = $container->settings["auth"];

		// check
		$this->check();
	}

	protected function check(): void
	{
		$session = $_SESSION[$this->config["session"]] ?? null;

		if ($session && $user = User::find($session)) {
			$this->user = $user;
			$this->state = $user->admin ? self::ADMIN : self::LOGGED;
			return;
		}
		$this->user = null;
		$this->state = self::NONE;
	}

	public function loginAttemp(array $params): bool
	{
		$username = $params["username"];
		$passwd = $params["password"];

		if (empty($username) || empty($passwd)) {
			$this->error = "É necessario preencher todos os campos para fazer login";
			return false;
		}

		if (!$user = User::where("username", $username)->orWhere("email", $username)->first()) {
			$this->error = "Nome de usuario ou Email não encontrado :/";
			return false;
		}

		if (!password_verify($passwd, $user->password)) {
			$this->error = "A senha inserida está incorreta";
			return false;
		}

		$this->login($user, isset($params["remember"]));

		return true;
	}

	public function login(User $user, $remember = false)
	{
		$_SESSION[$this->config["session"]] = $user->id;
		$this->state = $user->admin ? self::ADMIN : self::LOGGED;
		$this->user = $user;

		// remember
		if ($remember) {
			$hash = generateToken1();
			$uagent = userAgentNoVersion();
			$expiry = time()+60*60*24*30;
			setcookie($this->config["remember"], $hash, $expiry, "/");
			UserSession::updateOrCreate(
				[ "user_id" => $user->id, "user_agent" => $uagent ],
				[ "session" => $hash, "expiry" => $expiry ]
			);
		}
		// muda id da sessao sempre que faz login
		session_regenerate_id(true);
	}

	public function logout()
	{
		unset($_SESSION[$this->config["session"]]);
		$this->state = self::NONE;
		$this->user = null;

		//remember
		$remembCookie = $this->config["remember"];
		if (isset($_COOKIE[$remembCookie])) {
			$hash = $_COOKIE[$remembCookie];
			setcookie($remembCookie, "", time()-1, "/");
			UserSession::where("session", $hash)->where("user_agent", userAgentNoVersion())->delete();
		}
	}

	public function loginState(): int
	{
		return $this->state ?? self::NONE;
	}

	public function user(): ?User
	{
		return $this->user;
	}

}