<?php
require_once "utils.php";

//DB connect
$db = new bdd();

//search parse
require_once "model/comment.php";
$request = "SELECT comments.* FROM comments";
if(isset($_GET["user"])){
	$request .= ", user WHERE user.nick = '" . $_GET["user"] . "' AND comments.user = user.id";
}
$request .= " ORDER BY date";
$result = $db->request($request);

//data preparation
$comments = array();
while ($row = $result->fetch_assoc()) {
	//user
	$userResult = $db->request("SELECT * FROM user WHERE id = " . $row["user"]);
	$userRow = $userResult->fetch_assoc();
	$user = $userRow["nick"];
	
	$comment = new comment($row["id"], $user, $row["date"], $row["text"], $row["post"]);
	array_push($comments, $comment);
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
require_once "template/comments.php";