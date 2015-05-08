<?php
require_once "utils.php";
require_once './model/user.inc.php'; 

$csv = USERS;

initDb($csv);
//print_r($_SESSION);
switch($_GET['a']){
	case 'sign':
		$user = new user(
			htmlspecialchars($_POST['nick']),
			htmlspecialchars($_POST['mail']),
			htmlspecialchars(password_hash($_POST['pass'], PASSWORD_BCRYPT)), 
			'1'
			);
		if(valid($user) && !load($user->nick(), $csv)){
			store($user, $csv);
			//db
			$db->request("INSERT INTO `user` (`nick`, `mail`) VALUES ('" . $user->nick() . "', '" . $user->mail() . "')");
			header('location: ' . ROOTURL . 'login.php?msg=0');
			exit();
		}
		header('location: ' . ROOTURL . 'login.php?msg=1');
		exit();
		break;
	case 'log':
		$user = load(htmlspecialchars($_POST['nick']), $csv);
		//echo var_dump($user);
		if(password_verify($_POST['pass'], $user->hash())){
			//set($user->hash);
			//$_SESSION['user'] = $user; Cool mais il faudrait des fonctions magiques.
			$_SESSION['nick'] = $user->nick();
			$_SESSION['mail'] = $user->mail();
			$_SESSION['perms'] = $user->perms();
			//print_r($_SESSION);
			header('location: ' . $_GET['ref']);
			exit();
		}
		header('location: ' . ROOTURL . 'login.php?msg=1');
		exit();
		break;
	case 'logout':
		$_SESSION = array();
		header('location: ' . referer());
		exit();
		break;
	case 'comment':
		if(isLogged()){
			//sanitize input
			$msg = addslashes($_POST["msg"]);
			$post = $_GET["id"];
			$result = $db->request("SELECT id FROM user WHERE nick = '" . $_SESSION['nick'] . "'");
			$row = $result->fetch_assoc();
			$user = $row["id"];
			
			//request
			$db->request("INSERT INTO `comments` (`post`, `user`, `text`, `date`) VALUES ('" . $post . "', '" . $user . "', '" . $msg . "', NOW())");
			
			//redirect
			header('location: ' . ROOTURL . "p/" . $post);
			exit();
		}
		break;
	case 'order':
		if (isset($_GET["o"]) && 0 <= $_GET["o"] && $_GET["o"] <= 3) {
			$_SESSION["order"] = $_GET["o"];
			header('location: ' . $_GET["ref"]);
			exit();
		}
		break;
	case 'vote':
		if (isset($_GET["id"]) && isset($_GET["v"]) && 1 <= $_GET["v"] && $_GET["v"] <= 5 && is_int($_GET["id"])) {
			$result = $db->request("SELECT id FROM user WHERE nick = '" . $_SESSION['nick'] . "'");
			$row = $result->fetch_assoc();
			$user = $row["id"];
			
			$db->request("INSERT INTO `vote` (`user`, `post`, `value`) VALUES ('" . $user . "', '" . $_GET["id"] . "', '" . $_GET["v"] . "')");
			//$db->request("UPDATE `post` SET `note` = AVG(vote.value WHERE vote.post = '" . $_GET["id"] . "'), `vote_number` = `vote_number`+1 WHERE `id` = '1'");
			
			header('location: ' . $_GET["ref"]);
			exit();
		}
		break;
	default:
		break;

}
?>