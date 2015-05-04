<?php
session_start();
require_once './users/user.inc.php'; 
$db = './usersDb/users.csv';
initDb($db);
var_dump($_SESSION);
switch($_GET['a']){
	case 'sign':
		$user = new user(
			htmlspecialchars($_POST['nick']),
			htmlspecialchars($_POST['mail']),
			htmlspecialchars(password_hash($_POST['pass'], PASSWORD_BCRYPT)), 
			'1'
			);
		store($user, $db);
		break;
	case 'log':
		$user = load(htmlspecialchars($_POST['nick']), $db);
		print_r($user);
		if(password_verify($_POST['pass'], $user->hash)){
			//set($user->hash);
			//$_SESSION['user'] = $user; Cool mais il faudrait des fonctions magiques.
			$_SESSION['nick'] = $user->nick;
			$_SESSION['mail'] = $user->mail;
			$_SESSION['perms'] = $user->perms;
		}
		break;
	default:
		break;

}
?>