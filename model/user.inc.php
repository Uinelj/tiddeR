<?php
	require_once 'user.php';

	function initDb($path){ //Initialise le fichier CSV de données utilisateur
		if(file_exists($path)){
			if(is_writable($path)){ //Tout est OK.
				return true;
			}else{
				$backup = file_get_contents($path); //On peut pas écrire dedans, on fait un backup et on en recrée un.
				file_put_contents($path . ".bkp" , $backup); 
			}
		}
	return file_put_contents($path, ''); //On crée le csv.
	}

	function valid($user){ //Vérifie si les infos d'un candidat sont bonnes. 
		$nickRegex = "/[\w\d]\w{2,32}/";
		if(!preg_match($nickRegex, $user->nick())){
			return false;
		}
		//Amélioration : Vérifier le mot de passe par password_get_info ?
		return true;
	}

	function store($user, $file){ //Stocke l'utilisateur dans le fichier.
		$f = fopen($file, "a+");
        if($f == false){
                return false;
        }
        return fputcsv($f, (array) $user);
	}

	function load($nick, $file){ //Charge l'utilisateur depuis le fichier
		$f = fopen($file, "r");
		while(!feof($f)){
			$cur = fgetcsv($f);
			if($cur[1] == $nick){
				fclose($f);
				return new user($cur[0], $cur[1], $cur[2], $cur[3], intval($cur[4]));
			}
		}
		fclose($f);
		return false;
	}

	function del($nick, $file){ //Tente de supprimer l'utilisateur depuis le fichier.
		$users =  file($file);
		for($i=0; $i<sizeof($users); $i++){
			$cur = str_getcsv($users[$i]);
			//print_r($cur);
			if($cur[0] == $nick){
				//print_r($cur);
				array_splice($users, $i, 1);
				 //print_r($users);
				
				$f =fopen($file, 'w');
				for($j=0; $j<sizeof($users); $j++){
					fwrite($f, $users[$j]);
				}
				return true;
			}
		}
		return false;
	}
	
	function permNumberToSQL($int){ //Permet de convertir les premissions utilisateur codées en int dans le PHP, en VARCHAR, utilisés dans la base.
		switch($int){
			case 1:
				return "user";
				break;
			case 2:
				return "admin";
				break;
			case 3:
				return "candidate";
				break;
			case 4:
				return "ban";
				break;
			default:
				return false;
		}
	}

	function permSQLToNumber($string){ // L'inverse.
		switch($string){
			case "user":
				return 1;
				break;
			case "admin":
				return 2;
				break;
			case "candidate":
				return 3;
				break;
			case "ban":
				return 4;
				break;
			default:
				return false;
		}
	}
?>
