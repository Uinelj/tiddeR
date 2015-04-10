<?php 
	require_once '../lib/evaluator.inc.php';
	// $user['name'] = "Uinelj";
	// $user['password'] = "murenbeton";

	// var_dump($user);

	// $user['hash'] = password_hash($user['password'], PASSWORD_BCRYPT); //Warning, 72 chars max..

	// var_dump($user);

	// echo password_verify("mkurenbeton", $user['hash']);
	$u['id'] = 101010;
	$u['nickname'] = "Uinelj";
	$u['hash'] = "2592765541456527";
	$u['mail'] = "aulien.jbadji@gmail.com";
	createUser($u);
?>