<?php
require_once "utils.php";

//search parse
require_once "model/user.php";
if($_SESSION["perms"]!==2){
	header('location: ' . referer());
	exit();
}

//candidates
$result = $db->request("SELECT * FROM user WHERE permitions = 'candidate'");
$candidates = array();
while ($row = $result->fetch_assoc()) {	
	//user	
	$user = new user($row["id"], $row["nick"], $row["mail"], null, $row["permitions"]);
	array_push($candidates, $user);
}

//user
$result = $db->request("SELECT * FROM user WHERE permitions != 'candidate'");
$users = array();
while ($row = $result->fetch_assoc()) {	
	//user	
	$user = new user($row["id"], $row["nick"], $row["mail"], null, $row["permitions"]);
	array_push($users, $user);
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