<?php
require_once "utils.php";

if(isset($_GET["msg"])){
	switch($_GET["msg"]){
		case 0:
		$message = "Nom d'utilisateur ou phrase de passe trop court.";
		break;
		case 1:
		$message = "Nom d'utilisateur ou phrase de passe incorrecte.";
		break;
		case 2:
		$message = "Nom d'utilisateur déjà pris.";
	}
}

//template call
require_once "template/signup.php";