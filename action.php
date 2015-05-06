<?php
require_once "utils.php";
require_once './model/user.inc.php'; 

$db = USERS;

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
			header('location: ' . ROOTURL . 'login.php?msg=0');
			exit();
		}
		header('location: ' . ROOTURL . 'login.php?msg=1');
		exit();
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
			//print_r($_SESSION);
			header('location: ' . ROOTURL . 'login.php?msg=0');
			exit();
		}
		header('location: ' . ROOTURL . 'login.php?msg=1');
		exit();
		break;
	case 'logout':
		$_SESSION = array();
	default:
		break;

}
?>