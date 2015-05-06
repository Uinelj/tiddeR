<?php
//session
session_start();


if(!isset($_SESSION['perms'])){
	$_SESSION['perms'] = 0;
}


function rootURL(){
	return "http://" . $_SERVER['HTTP_HOST'] . "/web/tiddeR/";
}

function search(){
	return "recherche";
}

function isLogged(){
	return $_SESSION['perms'] !== 0;
}

//DB connect
require_once "db/bdd.php";
$db = new bdd();

//search parse
require_once "model/post.php";
$request = "SELECT post.* FROM post";
if(isset($_GET["tag"])){
	$request .= ", tagsOfPost, tags";
	$request .= " WHERE tags.name = '" . $_GET["tag"] . "'";
	$request .= " AND tags.id = tagsOfPost.tag";
	$request .= " AND tagsOfPost.post = post.id";
}else if(isset($_GET["user"])){
	$request .= ", user WHERE user.nick = '" . $_GET["user"] . "' AND post.user = user.id";
}
$request .= " ORDER BY date";
$result = $db->request($request);

//data preparation
$posts = array();
while ($row = $result->fetch_assoc()) {
	//tags
	$tags = array();
	$tagsResults = $db->request("SELECT * FROM tagsOfPost, `tags` WHERE post = " . $row["id"] . " AND tags.id = tagsOfPost.tag");
	while($tagRow = $tagsResults->fetch_assoc()){
		array_push($tags, $tagRow["name"]);
	}
	
	//user
	$userResult = $db->request("SELECT * FROM user WHERE id = " . $row["user"]);
	$userRow = $userResult->fetch_assoc();
	$user = $userRow["nick"];
	
	$post = new post($row["id"], $row["title"], $row["link"], $row["date"], $row["content"], $tags, $row["note"], $user, $row["user"], false);
	array_push($posts, $post);
}

//list tags
$tags = array();
$result = $db->request("SELECT * FROM `tags`");
while($row = $result->fetch_assoc()){
	array_push($tags, $row["name"]);
}
if(isset($_GET["tag"])){
	$selectedTag = $_GET["tag"];
}else{
	$selectedTag = "";
}

//template call
require_once "template/listing.php";