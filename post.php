<?php
require_once "utils.php";

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