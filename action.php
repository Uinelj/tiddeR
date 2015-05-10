<?php
/*
	ABADJI & DESPORTES

	Gère toutes les actions du site web, relatives au login, au postage, etc.
*/
require_once "utils.php";
require_once './model/user.inc.php'; 
require_once './utils.php';
$csvDb = USERS;

initDb($csvDb);

switch($_GET['a']){
	//admin actions
	case 'accept':
		if($_SESSION['perms']==2 && isset($_GET["id"]) && is_int(intval($_GET["id"]))){ //On vérifie si on est correctement loggué en administrateur
			$result = $db->request("SELECT * FROM user WHERE id = " . intval($_GET['id']));
			$row = $result->fetch_assoc();
			$user = new user(
				$row["id"],
				$row["nick"],
				$row["mail"],
				$row["pass"], 
				permSQLToNumber($row["permitions"]));
			store($user, $csvDb); //On enregistre l'utilisateur dans la base de donnée des users, le fichier CSV
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
	case 'dtag': //Suppression d'un tag
		if($_SESSION['perms']==2 && isset($_GET["name"])){
			$result = $db->request("SELECT * FROM `tags` WHERE `name` = '" . $_GET['name'] . "'");
			$row = $result->fetch_assoc();
			$tid = $row["id"];
			$result = $db->request("DELETE FROM `tagsOfPost` WHERE `tag` = " . $tid); //On retire les liens des posts à cet ancien tag
			$result = $db->request("DELETE FROM `tags` WHERE `id` = " . $tid); //On retire le tag en lui même
		}
		header('location: ' . ROOTURL . 'admin.php');
		exit();
		break;
	case 'atag': //Ajout d'un tag
		if($_SESSION['perms']==2 && isset($_POST["tag"])){
			$result = $db->request("INSERT INTO `tags` (`name`) VALUES ('" . $_POST["tag"] . "')");
		}
		header('location: ' . ROOTURL . 'admin.php');
		exit();
		break;
	//accounts actions
	case 'sign':
		$result = $db->request("SELECT * FROM user WHERE user.nick = _utf8 '" . htmlspecialchars($_POST['nick']) . "' COLLATE utf8_bin"); //On utilise _urf8 et COLLATE pour éviter les soucis de casse
		if(($result->num_rows != 0) || load(htmlspecialchars($_POST['nick']), $csvDb) != false){ //Si l'user existe dans la BDD ( on aurait 0 rows sinon  ), ou dans le CSV ( le load renverrait autre chose que false )
			header('location: ' . ROOTURL . 'login.php?msg=2');
			exit();
		}
		$user = new user( //Si l'user n'existe pas on le crée 
			0,
			htmlspecialchars($_POST['nick']),
			htmlspecialchars($_POST['mail']),
			htmlspecialchars(password_hash($_POST['pass'], PASSWORD_BCRYPT)), //Hachage du mot de passe
			3);
		$result = $db->request("SELECT * FROM user WHERE nick = '" . $user->nick() . "'");
		if(valid($user) && !is_string($result)){ //On vérifie la validité des infos ( nickname )
			$db->request("INSERT INTO `user` (`nick`, `mail`, `permitions`, `pass`) VALUES ('" . $user->nick() . "', '" . $user->mail() . "', 'candidate', '" . $user->hash() . "')"); //On insère dans la DB
			header('location: ' . ROOTURL . 'login.php?msg=0');
			exit();
		}
		header('location: ' . ROOTURL . 'login.php?msg=3');
		exit();
		break;
	case 'log':
		$user = load(htmlspecialchars($_POST['nick']), $csvDb);

		if(($user != false) && (password_verify($_POST['pass'], $user->hash()))){ //Si on peut charger l'user et que son mot de passe est correct
			$_SESSION['nick'] = $user->nick();
			$_SESSION['mail'] = $user->mail();
			$_SESSION['perms'] = $user->perms();
			$_SESSION['id'] = $user->id();
			header('location: ' . ROOTURL); //On set la session et on envoie l'user sur la home
			exit();
		}
		header('location: ' . ROOTURL . 'login.php?msg=1');
		exit();
		break;
	case 'logout': //On détruit la session. =array() est plus rapide selon divers benchmarks.
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

		$selfpost = false; //Un selfpost est un post sans lien. Juste de la "description".
		
		if($_POST['link'] == ""){
			$selfpost = true;
 		}

		if(($_POST['link'] != "") && (!parse_url($_POST['link']))){
			//Lien n'est pas une URL valide.
			header('location: ' . ROOTURL. 'post.php?msg=1');
			exit();
		}
		if($_POST['title'] == ""){
			if($_POST['link'] == ""){
				echo 'pas de lien';
				// Un selfpost nécessite un titre.
				header('location: ' . ROOTURL . 'post.php?msg=2');
				exit();
			}
			$_POST['title'] = getTitle($_POST['link']);
		}
		//sanitize
		$_POST['content'] = htmlspecialchars($_POST['content']);
		$_POST['link'] = addslashes($_POST['link']);
		$_POST['title'] = addslashes($_POST['title']);
		$_POST['content'] = addslashes($_POST['content']);
		$userId = $_SESSION['id'];
		$request = "INSERT INTO `post` (`title`, `link`, `content`, `user`, `date`, `note`, `vote_number`) VALUES ('" . $_POST['title'] . "', '" . $_POST['link'] . "', '" . $_POST['content'] . "'," . $userId . ", NOW(), 0, 0)";
		$db->request($request);
		$request = "SELECT id FROM post WHERE post.link = '" . $_POST['link'] . "'";
		$row = $db->request($request)->fetch_assoc();
		if($selfpost){ //Si selfpost, le lien est en fait le lien du selfpost, forgé à partir de l'id
			$_POST['link'] = ROOTURL . "p/" . $row['id'];
			$db->request("UPDATE `tiddeR`.`post` SET `link` = '" . $_POST['link'] . "' WHERE `post`.`id` = ". $row['id']); //On UPDATE juste après avoir inséré le selfpost pour éviter des problèmes de concurrence.  
		}

		//tags
		foreach($_POST['tags'] as $tag){
			$resultAssoc = $db->request("SELECT id FROM tags WHERE tags.name = '" . $tag . "'")->fetch_assoc();
			$db->request("INSERT INTO tagsOfPost VALUES (NULL, " . $row['id'] . ", " . $resultAssoc['id'] . ")"); //On attribue au post ses tags via la table tagsOfPost
		}
		header('location: ' . ROOTURL . 'p/' . $row["id"]);
		exit();
		break;
	case 'editPost': //On remplace certaines parties du post. 
		$_POST['title'] = htmlspecialchars($_POST['title']);
		$_POST['content'] = htmlspecialchars($_POST['content']);
		$_GET['id'] = htmlspecialchars($_GET['id']);
		$db->request("UPDATE `tiddeR`.`post` SET `title` = '" . $_POST['title'] . "', `content` = '" . $_POST['content'] . "' WHERE `post`.`id` = " . $_GET['id'] ." ");
		$db->request("DELETE FROM tidder.tagsOfPost WHERE post = " . $_GET['id']);
		foreach($_POST['tags'] as $tag){
			$resultAssoc = $db->request("SELECT id FROM tags WHERE tags.name = '" . $tag . "'")->fetch_assoc();
			$db->request("INSERT INTO tagsOfPost VALUES (NULL, " . $_GET['id'] . ", " . $resultAssoc['id'] . ")");
		}
		header('location: ' . ROOTURL . 'p/' . $_GET['id']);
		exit();
		break;
	case 'delPost': //Suppression du post !
		$_GET['id'] = htmlspecialchars($_GET['id']);
		$db->request("DELETE FROM comments WHERE post = " . $_GET['id']);
		$db->request("DELETE FROM tagsOfPost WHERE post = " . $_GET['id']);
		$db->request("DELETE FROM post WHERE id = " . $_GET['id']);
		header('location: ' . referer());
		exit();
		break;
	default:
		break;

}
?>