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
	$order[] = "date";
	if(isset($data['nicks'][0])){
		$from[] = "user";
		$where[] = "user.nick = '" . $data['nicks'][0] . "'";
		$where[] = "post.user = user.id";
	}
	if(isset($data['tags'][0])){
		$from[] = "tagsOfPost";
		$from[] = "tags";
		$where[] = "tags.name = '" . $data['tags'][0] . "'"; 
		$where[] = "tags.id = tagsOfPost.tag AND tagsOfPost.post = post.id";
	}
	if(isset($data['order'])){
		//TODO
	}
	return "SELECT " . implode(", ", $select) . " FROM " . implode(", ", $from) . " WHERE " . implode(" AND ", $where) . " ORDER BY " . implode(", ", $order);
}

$data = parse("~uinelj in ipsum");
print_r($data);
print_r(forgeSQL($data));

?>
