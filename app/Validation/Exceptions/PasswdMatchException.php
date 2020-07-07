<?php
namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class PasswdMatchException extends ValidationException {

	public static $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => "The entered passwords do not match."
		]
	];

}