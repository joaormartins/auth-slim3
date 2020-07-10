<?php
namespace App\Auth;

trait UserValidations {

	public function changePassword(array $params): bool
	{
		$new = $params["password_new"];
		$confirm = $params["password_confirm"];
		$password = $params["password"];

		if (empty($new) || empty($confirm) || empty($password)) {
			$this->error = "Por favor, preencha todos os campos";
			return false;
		}

		if (strlen($new) < 8) {
			$this->error = "A senha deve conter pelo menos 8 caracteres";
			return false;
		}
		if ($new !== $confirm) {
			$this->error = "As senhas inseridas nao conferem";
			return false;
		}
		if (!password_verify($password, $this->user->password)) {
			$this->error = "A senha atual está incorreta";
			return false;
		}
		if ($password === $new) {
			$this->error = "Entre com uma senha diferente da atual";
			return false;
		}

		$this->user->changePassword($new);

		return true;
	}

}