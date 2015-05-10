<?php
require_once "utils.php";
require_once './model/user.inc.php'; 
require_once './utils.php';
$csvDb = USERS;

initDb($csvDb);
//print_r($_SESSION);
switch($_GET['a']){
	//admin actions
	case 'accept':
		if($_SESSION['perms']==2 && isset($_GET["id"]) && is_int(intval($_GET["id"]))){
			$result = $db->request("SELECT * FROM user WHERE id = " . intval($_GET['id']));
			$row = $result->fetch_assoc();
			$user = new user(
				$row["id"],
				$row["nick"],
				$row["mail"],
				$row["pass"], 
				permSQLToNumber($row["permitions"]));
			store($user, $csvDb);
			$result = $db->request("UPDATE user SET permitions = 'user', pass = NULL WHERE id = '" . $user->id() . "'");
			header('location: ' . ROOTURL . 'admin.php');
			exit();
		}
		break;
	case 'refuse':
		if($_SESSION['perms']==2 && isset($_GET["id"]) && is_int(intval($_GET["id"]))){
			$result = $db->request("DELETE FROM user WHERE id = " . intval($_GET['id']));
			
			header('location: ' . ROOTURL . 'admin.php');
			exit();
		}
		break;
	case 'ban':
		if($_SESSION['perms']==2 && isset($_GET["id"]) && is_int(intval($_GET["id"]))){
			$result = $db->request("UPDATE user SET permitions = 'ban' WHERE id = " . intval($_GET['id']));
		}
		header('location: ' . ROOTURL . 'admin.php');
		exit();
		break;
	case 'admin':
		if($_SESSION['perms']==2 && isset($_GET["id"]) && is_int(intval($_GET["id"]))){
			$result = $db->request("UPDATE user SET permitions = 'admin' WHERE id = " . intval($_GET['id']));
		}
		header('location: ' . ROOTURL . 'admin.php');
		exit();
		break;
	case 'delete':
		if($_SESSION['perms']==2 && isset($_GET["id"]) && is_int(intval($_GET["id"]))){
			$result = $db->request("DELETE FROM `user` WHERE `id` = " . intval($_GET['id']));
		}
		header('location: ' . ROOTURL . 'admin.php');
		exit();
		break;
	case 'dtag':
		if($_SESSION['perms']==2 && isset($_GET["name"])){
			$result = $db->request("SELECT * FROM `tags` WHERE `name` = '" . $_GET['name'] . "'");
			$row = $result->fetch_assoc();
			$tid = $row["id"];
			$result = $db->request("DELETE FROM `tagsOfPost` WHERE `tag` = " . $tid);
			$result = $db->request("DELETE FROM `tags` WHERE `id` = " . $tid);
		}
		header('location: ' . ROOTURL . 'admin.php');
		exit();
		break;
	case 'atag':
		if($_SESSION['perms']==2 && isset($_POST["tag"])){
			$result = $db->request("INSERT INTO `tags` (`name`) VALUES ('" . $_POST["tag"] . "')");
		}
		header('location: ' . ROOTURL . 'admin.php');
		exit();
		break;
	//accounts actions
	case 'sign':
		$result = $db->request("SELECT * FROM user WHERE user.nick = _utf8 '" . htmlspecialchars($_POST['nick']) . "' COLLATE utf8_bin");
		if(($result->num_rows != 0) || load(htmlspecialchars($_POST['nick']), $csvDb) != false){
			header('location: ' . ROOTURL . 'login.php?msg=2');
			exit();
		}
		$user = new user(
			0,
			htmlspecialchars($_POST['nick']),
			htmlspecialchars($_POST['mail']),
			htmlspecialchars(password_hash($_POST['pass'], PASSWORD_BCRYPT)), 
			3);
		$result = $db->request("SELECT * FROM user WHERE nick = '" . $user->nick() . "'");
		if(valid($user) && !is_string($result)){
			//db
			$db->request("INSERT INTO `user` (`nick`, `mail`, `permitions`, `pass`) VALUES ('" . $user->nick() . "', '" . $user->mail() . "', 'candidate', '" . $user->hash() . "')");
			header('location: ' . ROOTURL . 'login.php?msg=0');
			exit();
		}
		header('location: ' . ROOTURL . 'login.php?msg=1');
		exit();
		break;
	case 'log':
		$user = load(htmlspecialchars($_POST['nick']), $csvDb);

		if(($user != false) && (password_verify($_POST['pass'], $user->hash()))){
			//set($user->hash);
			//$_SESSION['user'] = $user; Cool mais il faudrait des fonctions magiques.
			$_SESSION['nick'] = $user->nick();
			$_SESSION['mail'] = $user->mail();
			$_SESSION['perms'] = $user->perms();
			$_SESSION['id'] = $user->id();
			//print_r($_SESSION);
			header('location: ' . ROOTURL);
			exit();
		}
		header('location: ' . ROOTURL . 'login.php?msg=1');
		exit();
		break;
	case 'logout':
		$_SESSION = array();
		header('location: ' . ROOTURL);
		exit();
		break;
	//users actions
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
	case 'vote':
		if (isLogged() && isset($_GET["id"]) && isset($_GET["v"]) && 1 <= $_GET["v"] && $_GET["v"] <= 5 && is_numeric($_GET["id"])) {
			$user = $_SESSION["id"];
			$result = $db->request("SELECT COUNT(*) FROM vote WHERE post = '" . $_GET['id'] . "' AND user = '" . $user . "'");
			$count = $result->fetch_array()[0];
			if($count){
				$db->request("UPDATE vote SET value = '" . $_GET["v"] . "' WHERE user = '" . $user . "' AND post = '" . $_GET["id"] . "'");
			}else{
				$db->request("INSERT INTO `vote` (`user`, `post`, `value`) VALUES ('" . $user . "', '" . $_GET["id"] . "', '" . $_GET["v"] . "')");
			}
			$result = $db->request("SELECT AVG(value), COUNT(*) FROM vote WHERE vote.`post` = " . $_GET['id']);
			$row = $result->fetch_array();
			$average = $row[0];
			$count = $row[1];
			$result = $db->request("UPDATE post SET note = '" . $average . "', vote_number = '" . $count . "' WHERE id = '" . $_GET["id"] . "'");
		}
		header('location: ' . referer());
		exit();
		break;
	case 'post':

		$selfpost = false;
		
		if($_POST['link'] == ""){
			$selfpost = true;
			//header('location: ' . ROOTURL . 'post.php');
 		}

		if(($_POST['link'] != "") && (!parse_url($_POST['link']))){
			//Lien n'est pas une URL valide.
			header('location: ' . ROOTURL. 'post.php?msg=1');
			exit();
		}
		if($_POST['title'] == ""){
			//echo 'pas de titre';
			if($_POST['link'] == ""){
				echo 'pas de lien';
				// Un selfpost nécessite un titre.
				header('location: ' . ROOTURL . 'post.php?msg=2');
				exit();
			}
			$_POST['title'] = getTitle($_POST['link']);
		}

		$_POST['content'] = htmlspecialchars($_POST['content']);
		$_POST['link'] = addslashes($_POST['link']);
		$_POST['title'] = addslashes($_POST['title']);
		$_POST['content'] = addslashes($_POST['content']);
		$userId = $_SESSION['id'];
		$request = "INSERT INTO `post` (`title`, `link`, `content`, `user`, `date`, `note`, `vote_number`) VALUES ('" . $_POST['title'] . "', '" . $_POST['link'] . "', '" . $_POST['content'] . "'," . $userId . ", NOW(), 0, 0)";
		$db->request($request);
		$request = "SELECT id FROM post WHERE post.link = '" . $_POST['link'] . "'";
		$row = $db->request($request)->fetch_assoc();
		if($selfpost){
			$_POST['link'] = ROOTURL . "p/" . $row['id'];
			$db->request("UPDATE `tiddeR`.`post` SET `link` = '" . $_POST['link'] . "' WHERE `post`.`id` = ". $row['id']);
		}

		//tags
		foreach($_POST['tags'] as $tag){
			$resultAssoc = $db->request("SELECT id FROM tags WHERE tags.name = '" . $tag . "'")->fetch_assoc();
			$db->request("INSERT INTO tagsOfPost VALUES (NULL, " . $row['id'] . ", " . $resultAssoc['id'] . ")");
		}
		header('location: ' . ROOTURL . 'p/' . $row["id"]);
		exit();
		break;
	case 'editPost':
		$_POST['title'] = htmlspecialchars($_POST['title']);
		$_POST['content'] = htmlspecialchars($_POST['content']);
		$_POST['id'] = htmlspecialchars($_POST['id']);
		
		$db->request("UPDATE `tiddeR`.`post` SET `title` = '" . $_POST['title'] . "', `content` = '" . $_POST['content'] . "' WHERE `post`.`id` = " . $_POST['id'] ." ");
		$db->request("DELETE FROM tidder.tagsOfPost WHERE post = " . $_POST['id']);
		foreach($_POST['tags'] as $tag){
			$resultAssoc = $db->request("SELECT id FROM tags WHERE tags.name = '" . $tag . "'")->fetch_assoc();
			$db->request("INSERT INTO tagsOfPost VALUES (NULL, " . $_POST['id'] . ", " . $resultAssoc['id'] . ")");
		}
		header('location :' . $_SERVER['HTTP_REFERER']);
		exit();
		break;
	case 'delPost':
		$_POST['id'] = htmlspecialchars(string);
		$db->request("DELETE FROM `tiddeR`.`post` WHERE `post`.`id` =" . $_POST['id']);
		header('location :' .$_SERVER['HTTP_REFERER']);
		exit();
		break;
	default:
		break;

}
?>