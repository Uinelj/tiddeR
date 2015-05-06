<?php
//session
session_start();
require_once 'config.php'; 

if(!isset($_SESSION['perms'])){
	$_SESSION['perms'] = 0;
}


function rootURL(){
	return ROOTURL;
}

function search(){
	return "recherche";
}

function isLogged(){
	return $_SESSION['perms'] !== 0;
}

function referer(){
	return $_SERVER['HTTP_REFERER'];
}