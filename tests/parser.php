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
function parseString($string){
	var_dump($string);
	$exploded = explode(" ", $string);
	for($i=0; $i<count($exploded); $i++){
		if($exploded[$i][0]=="~"){
			$data['usernames'] = explode("|", str_replace("~", "", $exploded[$i]));
		}
		if($exploded[$i]=="in"){
			$data['tags'] = explode("|", $exploded[$i+1]);
			$i++; //Ignore next word.
		}
		if($exploded[$i] == "by"){
			$data['order'] = $exploded[$i+1];
			$i++;
		}
	}
	var_dump($data);
}
parseString("in html|css|php by date");
?>