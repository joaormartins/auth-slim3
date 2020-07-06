<?php
namespace App\Controllers;


class Controller {

	protected $container;

	public function __construct($container)
	{
		$this->container = $container;
	}

	// manipula o get
	public function __get($param)
	{
		if ($this->container->{$param}) {
			return $this->container->{$param};
		}
	}
}