<?php
require_once "utils.php";

//search parse
require_once "model/post.php";
require_once "bonusFeatures/parser.php";
if(isset($_GET['search']) && ($_GET['search'] != "")){
	$search = htmlspecialchars($_GET['search']);
}else{
	$search = "* by date";
}
// $request = "SELECT post.* FROM post";
// if(isset($_GET["tag"])){
// 	$request .= ", tagsOfPost, tags";
// 	$request .= " WHERE tags.name = '" . $_GET["tag"] . "'";
// 	$request .= " AND tags.id = tagsOfPost.tag";
// 	$request .= " AND tagsOfPost.post = post.id";
// }else if(isset($_GET["user"])){
// 	$request .= ", user WHERE user.nick = '" . $_GET["user"] . "' AND post.user = user.id";
// }
// $request .= " ORDER BY date";
// $result = $db->request($request);
$result = $db->request(searchToRequest($search));
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