<?php
//session
session_start();
if(!isset($_SESSION["session"])){
	$_SESSION["session"] = true;
	$_SESSION["tags"] = array();
	$_SESSION["order"] = "date";
	$_SESSION["search"] = null;
}

function rootURL(){
	return "http://" . $_SERVER['HTTP_HOST'] . "/web/tiddeR/";
}

function search(){
	return "recherche";
}

function isLogged(){
	return false;
}

//DB connect
require_once "db/bdd.php";
$db = new bdd();

//search parse
require_once "db/post.php";
$request = "SELECT post.* FROM post";
if(isset($_GET["tag"])){
	$request .= ", tagsOfPost, tags";
	$request .= " WHERE tags.name = '" . $_GET["tag"] . "'";
	$request .= " AND tags.id = tagsOfPost.tag";
	$request .= " AND tagsOfPost.post = post.id";
}else if(isset($_GET["user"])){
	$request .= ", user WHERE user.nick = '" . $_GET["user"] . "' AND post.user = user.id";
}
$request .= " ORDER BY " . $_SESSION["order"];
$result = $db->request($request);

//data preparation
$posts = array();
$row = $result->fetch_assoc();

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

//comments
require_once "db/comment.php";
$comments = array();
$commentsResult = $db->request("SELECT comments.*, user.nick FROM comments, user WHERE post = " . $post->id() . " AND user = user.id ORDER BY date");
while($commentRow = $commentsResult->fetch_assoc()){
	$comment = new comment($commentRow["id"], $commentRow["nick"], $commentRow["date"], $commentRow["text"]);
	array_push($comments, $comment);
}

//template call
require_once "template/link.php";