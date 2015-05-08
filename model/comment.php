<?php
/*****************
 * tiddeR
 * comment
 *****************/

class comment
{
	private $id;
	private $author;
	private $date;
	private $postid;
	
	public function __construct($id, $author, $date, $content, $postid){
		$this->id = $id;
		$this->author = $author;
		$this->date = $date;
		$this->content = $content;
		$this->postid = $postid;
	}
	
	public function id(){
		return $this->id;
	}
	
	public function author(){
		return $this->author;
	}
	
	public function date(){
		return $this->date;
	}
	
	public function content(){
		return $this->content;
	}
	
	public function postid(){
		return $this->postid;
	}
}