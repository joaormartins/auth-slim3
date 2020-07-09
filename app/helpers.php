<?php

// function to example helper
function sum($a, $b)
{
	return $a + $b;
}

function userAgentNoVersion(): string
{
	$uagent = $_SERVER["HTTP_USER_AGENT"];
	$regx = "/\/[a-zA-Z0-9.]+/";
	return preg_replace($regx, '', $uagent);
}

function generateToken1(): string
{
	$token = openssl_random_pseudo_bytes(20);
	return bin2hex($token);
}