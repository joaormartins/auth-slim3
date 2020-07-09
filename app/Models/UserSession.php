<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model {

	protected $table = "user_sessions";

	protected $fillable = [
		"user_id",
		"session",
		"user_agent",
		"expiry"
	];

	public $timestamps = false;
}