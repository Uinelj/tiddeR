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
                echo "ERR: CSV file not valid\n";
                return false;
        }
        if(!isValidNumberOfUsersFile($numberFile)){
                echo "ERR : Number of users not valid\n";
                return false;
        }
        if(!isValidUser($user)){
                echo "ERR: User data not valid";
                return false;
        }
        if(userExists($user, $userFile)){
                echo "ERR: User already exists\n";
                return false;  
        }
        $user['id'] = getNumberOfUsers($numberFile) +1;
        setNumberOfUsers($user['id'], $numberFile);
        if(!addUser($user, $userFile)){
                echo "ERR: IO Error";
                return false;
        }
        return true;
}
 
function login($user){
        global $userFile;
        if(!userExists($user)){
                return false;
        }
        $userFromDb = loadUser($user, $userFile);
        if(isCorrectPassword($user['password'], $userFromDb['password'])){
                echo "Login validé\n";
                return $userFromDb;
        }
        return false;
}
//      }
//      storeUser($user, $userFile);
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
        $nicknameRegex = "/[\w\d]\w{5,14}/"; //Any
        if(!preg_match($nicknameRegex, $user['nickname'])){
                return false;
                //return true;
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
        //ksort($user);
        return fputcsv($f, $user);
}
function userExists($user, $userFile){
        //If mail or nickname equal, then it exists.
        $f = fopen($userFile, "r");
        while(!feof($f)){
                $cur = fgetcsv($f);
                //var_dump(fgetcsv($f));
                if($cur[2] == $user['mail']){
                        return true;
                }
                if($cur[0] == $user['nickname']){
                        return true;
                }
        }
        return false;
}
function loadUser($user, $userFile){
        //Loads a user corresponding to his mail or his nickname (or his ID ?)
        $f = fopen($userFile, "r");
        while(!feof($f)){
                $cur =fgetcsv($f);
                if($cur[0] == $user['nickname']){
                        $user['mail'] = $cur[1];
                        $user['password'] = $cur[2];
                        //$user['id']
                        return $user;
                }
                if($cur[1] == $user['mail']){
                        $user['nickname'] = $cur[0];
                        $user['password'] = $cur[2];
                        //$user['id']
                        return $user;
                }
        }
        return false;
}
 
function isCorrectPassword($passwordHash, $user){
        return $passwordHash == $user['password'];
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