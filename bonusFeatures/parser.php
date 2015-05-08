<?php
/*
	Sample strings :

	~uinelj in html
	~uinelj in html|css
	~akkes in css by date
	~uinelj by rating
	html by rating
	* by date ( equivalent to 'by date')

	Complex string example :

	~uinelj|~akkes in html|css|php by rating
*/
function searchToRequest($str){
	return forgeSQL(parse($str));
}
function parse($str){
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
function forgeSQL($data){
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

?>
