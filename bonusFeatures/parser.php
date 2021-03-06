<?php
/*
	Julien ABADJI
	Gère le parsage des chaînes de caractère permettant la navigation
*/
/*
	Sample strings :

	~uinelj in html
	~uinelj in html|css
	~akkes in css by date
	~uinelj by rating
	html by rating
	by date

	Complex string example :

	~uinelj|~akkes in html|css|php by rating
*/
function searchToRequest($str){ //Transforme une chaîne de caractères en requête SQL
	return forgeSQL(parse($str));
}
function editOrder($str, $order='date'){ //Modifie l'ordre de tri à une string.
	$parsed = parse($str);
	$parsed['order'] = $order;
	return forgeString($parsed);
}
function addTag($str, $tag){ //Ajoute un tag à une string.
	$parsed = parse($str);
	if(!array_key_exists('tags', $parsed)){
		$parsed['tags'] = array($tag);
	}else{
		array_push($parsed['tags'], $tag);
	}
	return forgeString($parsed);
}
function rmTag($str, $tag){ //Retire un tag à une string.
	$parsed = parse($str);
	$key = array_search($tag, $parsed['tags']);
	if( $key !== false){
		array_splice($parsed['tags'], $key, 1);
	}
	return forgeString($parsed);
}
function editStr($str, $edits){ //Modifie divers éléments dans une string, basé sur un tableau de modification de données.
	$parsed = parse($str);
	if(isset($edits['nicks'])){
		$parsed['nicks'] = $edits['nicks'];
	}
	if(isset($edits['tags'])){
		$parsed['tags'] = $edits['tags'];
	}
	if(isset($edits['order'])){
		$parsed['order'] = $edits['order'];
	}
	if(isset($edits['search'])){
		$parsed['search'] = $edits['search'];
	}
	return forgeString($parsed);
}
function parse($str){ //Parse la chaîne pour en sortir un tableau de données. ( pseudos, tags, ordre.. )
	$data['search'] = "";
	$str = trim($str);
	if($str[0] == '\\'){
		$data['search'] = substr($str, 1);
		return $data;
	}
	$exp = explode(" ", $str);
	for($i=0; $i<count($exp); $i++){
		if($exp[$i][0]=="~"){
			$data['nicks'] = explode("|", str_replace("~", "", $exp[$i]));
		}else
		if($exp[$i]=="in"){
			$data['tags'] = explode("|", $exp[$i+1]);
			$i++; //Ignore next word.
		}else
		if($exp[$i] == "by"){
			$data['order'] = $exp[$i+1];
			$i++;
		}else{
			$data['search'] .= $exp[$i] . " ";
		}

	}
	return $data;
}
function forgeSQL($data){ //Forge une requête SQL à partir d'un tableau de données.
	$select[] = "post.*";
	$from[] = "post";
	//$order[] = "date";
	if(isset($data['nicks'])){
		$from[] = "user";
		$where[] = "user.nick IN ('" . implode("', '", $data['nicks']) . "')";
		$where[] = "post.user = user.id";
	}
	$_SESSION["tags"] = $data['tags'];
	if(isset($data['tags'])){
		$from[] = "tagsOfPost";
		$from[] = "tags";
		$where[] = "tagsOfPost.tag = tags.id";
		$where[] = "(tags.name IN ('" . implode("', '", $data['tags']) . "'))";
		$where[] = "post.id = tagsOfPost.post";
		
		$group = "post.id HAVING COUNT( post.id )=" . count($data['tags']);
	}
	switch ($data['order']){
		case 'title':
			$_SESSION['order'] = 0;
			$order = 'title ASC';
			break;
		case 'date':
			$_SESSION['order'] = 1;
			$order = 'date DESC';
			break;
		case 'best':
			$_SESSION['order'] = 2;
			$order = 'note DESC';
			break;
		case 'worst':
			$_SESSION['order'] = 3;
			$order = 'note ASC';
			break;
		default:
			$_SESSION['order'] = 1;
			$order = 'date DESC';
	}
	$sql = "SELECT " . implode(", ", $select) . " FROM " . implode(", ", $from); 
	if($where != NULL){
		$sql .= " WHERE " . implode(" AND ", $where);
	}
	if($group != NULL){
		$sql .= " GROUP BY " . $group;
	}
	if($order != NULL){
		$sql .= " ORDER BY " . $order;
	}
	return $sql;
}

function forgeString($data){ //Force une chaîne de caractères à partir d'un tableau de données. 
	$str ="";
	if(isset($data['nicks']) && $data['nicks'] != NULL){
		foreach ($data['nicks'] as &$nick) {
			$nick = "~" . $nick;
		}
		$str .= implode("|", $data['nicks']);
		$str .= ' ';
	}
	if(isset($data['tags']) && ($data['tags'] != NULL)){
		$str .= 'in ';
		$str .= implode("|", $data['tags']);
		$str .= ' ';
	}
	if($data['order'] != NULL){
		$str .= 'by ';
		$str .= $data['order'];
	}
	if($data['search'] != NULL){
		$str .= ' ' . $data['search'];
	}
	return $str;
}
?>
