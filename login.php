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
	return "* by recent";
}

function isLogged(){
	return false;
}

//template call
require_once "template/signup.php";