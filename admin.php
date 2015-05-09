<?php
require_once "utils.php";

//search parse
require_once "model/user.php";
if($_SESSION["perms"]!==2){
	//header('location: ' . referer());
	//exit();
}

$result = $db->request("SELECT * FROM user");
//data preparation
$users = array();
while ($row = $result->fetch_assoc()) {	
	//user
	$user = $userRow["nick"];
	
	$post = new user($row["nick"], $row["$mail"], 0, $row["perms"]);
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
require_once "template/admin.php";