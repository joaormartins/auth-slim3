<?php
namespace App\Auth;

use App\Models\User;

class Auth {

	const NONE = 0;
	const LOGGED = 1;
	const ADMIN = 2;

	protected $container;

	protected $state, $user;

	public $error, $obj;

	public function __construct($container)
	{
		$this->container = $container;

		// check
		$this->check();
	}


	protected function check(): void
	{
		$config = $this->container["settings"];
		$session = $_SESSION[$config["session"]] ?? null;

		if ($session && $user = User::find($session)) {
			$this->user = $user;
			if ($user->admin) {
				$this->state = self::ADMIN;
				return;
			}
			$this->state = self::LOGGED;
			return;
		}
		$this->user = null;
		$this->state = self::NONE;
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