<?php
session_start();
require_once './lib/evaluator.inc.php'; 
switch($_GET['a']){
	case 'sign':
		$user['nick'] = htmlspecialchars($_POST['nick']);
		$user['mail'] = $_POST['mail'];
		$user['pass'] = password_hash($_POST['pass'], PASSWORD_BCRYPT); //WARNING : 72chars max.
		if(createUser($user)){
			header('location:' . $_SERVER['HTTP_REFERER']);
		}
		break;
	case 'log':
		$user['nick'] = htmlspecialchars($_POST['nick']);
		$user['pass'] = $_POST['pass'];
		if(login($user)){
			$_SESSION['nick'] = $_POST['nick'];
			$_SESSION['mail'] = $_POST['mail'];
			header('location:' . $_SERVER['HTTP_REFERER']);
		}
		break;
	default:
		break;

}
?>