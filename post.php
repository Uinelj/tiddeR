<?php
require_once "utils.php";

//DB connect
require_once "db/bdd.php";
$db = new bdd();
$edit = false;
require_once "model/post.php";
$post = null;

if(isset($_GET['edit'])){
	$edit = true;
	//tags
	$tags = array();
	$tagsResults = $db->request("SELECT * FROM tagsOfPost, `tags` WHERE post = " . $_GET['id'] . " AND tags.id = tagsOfPost.tag");
	while($tagRow = $tagsResults->fetch_assoc()){
		array_push($tags, $tagRow["name"]);
	}
	
	//search parse
	$result = $db->request("SELECT post.*, user.nick FROM post,user WHERE post.id = " . $_GET["id"] . " AND user.id = post.user");
	$row = $result->fetch_assoc();
	$post = new post($row["id"], $row["title"], $row["link"], $row["date"], $row["content"], $tags, $row["note"], $row['nick'], $row["user"], false);
}else{
	$post = new post(false, false, false, false, false, false, false, false, false, false);
}

//list tags
$tags = array();
$result = $db->request("SELECT * FROM `tags`");
while($row = $result->fetch_assoc()){
	array_push($tags, $row["name"]);
}

//template call
require_once "template/posting.php";