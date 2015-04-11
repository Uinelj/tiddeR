<?php

$userFile = "../db/users.csv";
$numberFile = "../db/usersNumber.txt";
function createUser($user){
	// Garder des return false dans les if, ou mettre un flag pour pouvoir print plusieurs erreurs ? - UJ
	global $userFile;
	global $numberFile;
	initCsvFile($userFile);
	initNumberOfUsersFile($numberFile);
	if(!isValidCsvFile($userFile)){
		echo "ERR: CSV file not valid";
		return false;
	}
	if(!isValidNumberOfUsersFile($numberFile)){
		echo "ERR : Number of users not valid";
		return false;
	}
	if(!isValidUser($user)){
		echo "ERR: User data not valid";
		return false;
	}
	//TODO: If the user exists in the file.
	$user['id'] = getNumberOfUsers($numberFile) +1;
	setNumberOfUsers($user['id'], $numberFile);
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


/* CSV FILE*/


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

/* USER MANAGEMENT */


function isValidUser($user){
	/*
		A user, or evaluator, is an array composed of : 
		$u['id'] : A unique number intended to fasten the access in the CSV file
		$u['nickname'] : SELF EKSPLENATORI LULULULUL :-{D
		$u['pw'] : His password hash, password_hash()'ed.
		$u['mail'] : Maybe ?..
	*/
	$nicknameRegex = "/^[a-zA-Z]\w{5,14}$/";
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
	ksort($user);
	return fputcsv($f, $user);
}
/* NUMBER OF USERS FILE AND MANAGEMENT */


function initNumberOfUsersFile($path){
	if(file_exists($path)){
		return false;
	}
	file_put_contents($path, 0);
	return true;
}
function isValidNumberOfUsersFile($file){
	// TODO: If it's not valid, recount and make one valid
	// TODO: Make it actually work
	//return is_int(file_get_contents($file));
	return true;
}
function getNumberOfUsers($file){
	return file_get_contents($file);
}
function setNumberOfUsers($numberOfUsers, $file){
	file_put_contents($file, $numberOfUsers, LOCK_EX);
}
?>