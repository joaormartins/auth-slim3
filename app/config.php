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
	]
];