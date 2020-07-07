<?php
namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

class PasswdMatch extends AbstractRule {

	protected $passwd;
	public function __construct($pw)
	{
		$this->passwd = $pw;
	}

	public function validate($input)
	{
		return $this->passwd === $input;
	}
}