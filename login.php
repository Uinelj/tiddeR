<?php
require_once "utils.php";

if(isset($_GET["msg"])){
	switch($_GET["msg"]){
		case 0:
		break;
		case 1:
		$message = "Phrase de passe incorrecte.";
		break;
	}
}

//template call
require_once "template/signup.php";