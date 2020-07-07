<?php
return [
	"settings" => [
		// Slim settings (main)
		"displayErrorDetails" => true,


		// View Settings
		"view" => [
			"template_path" => __DIR__ . "/../resources/views",
			"twig" => [
				"cache" => __DIR__ . "/../cache/twig",
				"debug" => true,
				"auto_reload" => true
			]
		],

		// database Settings
		"db" => [
			"driver" => "mysql",
			"host" => "localhost",
			"database" => "authslim3",
			"username" => "root",
			"password" => "",
			"charset" => "utf8",
			"collation" => "utf8_unicode_ci",
			"prefix" => ""
		],


		// auth settings
		"auth" => [
			"session" => "user_id",
			"remember" => "user_r"
		]
	]
];