<?php

$userFile = "../db/users.csv";

function createUser($user){
	global $userFile;
	initCsvFile($userFile);
	if(!isValidCsvFile($userFile)){
		echo "ERR: CSV file not valid";
		return false;
	}
	if(!isValidUser($user)){
		echo "ERR: User data not valid";
		return false;
	}
	//TODO: If the user exists in the file.
	if(!addUser($user, $userFile)){
		echo "ERR: IO Error";
		return false;
	}
	return true;
}
// 	}
// 	storeUser($user, $userFile);
// }
// function deleteEvaluator($name){}
// function loadEvaluator($name){}
// function addLink($link, $a){}
// function editLink(){}
// function deleteLink(){}
// function addComment(){}
// function rankLink(){}
// function isOwnerOf(){}
// function evaluatorExists(){}

/* PRIMITIVE FUNCTIONS */

function initCsvFile($path){
	if(file_exists($path)){
		return false;
	}
	$f = file_put_contents($path, '');
	return true;
}
function isValidCsvFile($file){
	//According to RFC 4180, MIME is text/csv. Excel is a douche.
	/*
		TODO: Find a way to :
		- Recognize the MIME type
		OR
		- put the correct MIME type in initCsvFile
	*/
	if(!file_exists($file)){
		return false;
	}
	return true;
}
function isValidUser($user){
	/*
		A user, or evaluator, is an array composed of : 
		$u['id'] : A unique number intended to fasten the access in the CSV file
		$u['nickname'] : SELF EKSPLENATORI LULULULUL :-{D
		$u['hash'] : His password hash, password_hash()'ed.
		$u['mail'] : Maybe ?..
	*/
	$nicknameRegex = "/^[a-zA-Z]\w{5,14}$/";
	if(!is_int($user['id'])){
		return false;
	}
	if(!preg_match($nicknameRegex, $user['nickname'])){
		return false;
	}
	if(true){
		//TODO : Check the hash's validity. See password_get_info().
	}
	return true;
}
function addUser($user, $userFile){
	$f = fopen($userFile, "a+");
	if($f == false){ //TODO: Find more elegant.
		return false;
	}
	return fputcsv($f, $user);
}
?>