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
	$request['select'] = "SELECT post.*";
 	$request['from'] = " FROM post";	
	$request['where'] = " WHERE";
	$request['order'] = " ORDER BY";
	if(isset($data['nicks'])){
		$request['from'] .= ", user";
		$request['where'] .= " user.nick = " . $data['nicks'][0];
		//TODO: Multi users
	}
	if(isset($data['tags'])){
		$request['from'] .= ", tagsOfPost, tags";
 		$request['where'] .= " tags.name = " . $data['tag'][0];
	}
	if(isset($data['order'])){
		//TODO	
	}else{
		$request['order'] .= " date";
	}
	if(isset($data['search'])){
		//TODO
	}
	return $request['select'] . $request['from'] . $request['where'] . $request['order'];
}

$data = parse("~uinelj in html");
print_r($data);
print_r(forgeSQL($data));

?>
