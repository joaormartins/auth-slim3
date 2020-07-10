<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

	protected $table = "users";

	protected $fillable = [
		"username",
		"email",
		"password"
	];


	public function changePassword($new)
	{
		if (!password_get_info($new)["algo"]) {
			$new = password_hash($new, PASSWORD_DEFAULT);
		}

		$this->password = $new;
		return $this->save();
	}
}