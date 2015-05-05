<?php
	require_once 'user.php';
	

	function initDb($path){ //TODO: WARN si PHP peut pas écrire dans le dossier.
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

	function valid($user){
		$nickRegex = "/[\w\d]\w{4,32}/";
		if(!preg_match($nickRegex, $user->nick())){
			echo "ERR: Longeur et/ou caractères de nickname incorrects.";
			return false;
		}
		//vérifier le mdp par password_get_info ?
		return true;
	}

	function store($user, $file){ //flock ?
		$f = fopen($file, "a+");
        if($f == false){ //Find more elegant ?
                return false;
        }
        return fputcsv($f, (array) $user);
	}

	function load($nick, $file){
		$f = fopen($file, "r");
		while(!feof($f)){
			$cur = fgetcsv($f);
			if($cur[0] == $nick){
				fclose($f);
				return new user($cur[0], $cur[1], $cur[2], $cur[3]);
			}
		}
		//print_r("pas trouvé");
		fclose($f);
		return false;
	}

	function del($nick, $file){ //false si user pas trouvé.
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

?>
