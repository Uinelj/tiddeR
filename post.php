<?php
//session
session_start();


if(!isset($_SESSION['perms'])){
	echo "yolo";
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
require_once "template/posting.php";