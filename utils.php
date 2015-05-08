<?php
//session
session_start();
require_once 'config.php';
require_once "db/bdd.php";

//DB connect
$db = new bdd();

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
	if(isset($_SERVER['HTTP_REFERER'])){
		return $_SERVER['HTTP_REFERER'];
	}else{
		return ROOTURL;
	}
}

function getTitle($Url){ //StackOverflow
    $str = file_get_contents($Url);
    if(strlen($str)>0){
        preg_match("/\<title\>(.*)\<\/title\>/",$str,$title);
        return $title[1];
    }
}