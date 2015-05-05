<?php
session_start();
require_once './model/user.inc.php'; 
$config = include './bonusFeatures/config.php';

$db = $config['users'];

initDb($db);
//print_r($_SESSION);
switch($_GET['a']){
	case 'sign':
		$user = new user(
			htmlspecialchars($_POST['nick']),
			htmlspecialchars($_POST['mail']),
			htmlspecialchars(password_hash($_POST['pass'], PASSWORD_BCRYPT)), 
			'1'
			);
		if(valid($user) && !load($user->nick(), $db)){
			store($user, $db);
		}
		break;
	case 'log':
		$user = load(htmlspecialchars($_POST['nick']), $db);
		//echo var_dump($user);
		if(password_verify($_POST['pass'], $user->hash())){
			//set($user->hash);
			//$_SESSION['user'] = $user; Cool mais il faudrait des fonctions magiques.
			$_SESSION['nick'] = $user->nick();
			$_SESSION['mail'] = $user->mail();
			$_SESSION['perms'] = $user->perms();
			print_r($_SESSION);
		}
		break;
	case 'logout':
		$_SESSION = array();
	default:
		break;

}
?>