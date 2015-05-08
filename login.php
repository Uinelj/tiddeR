<?php
require_once "utils.php";

if(isset($_GET["msg"])){
	switch($_GET["msg"]){
		case 0:
		break;
		case 1:
		$message = "Nom d'utilisateur ou phrase de passe incorrecte.";
		break;
	}
}

//template call
require_once "template/signup.php";