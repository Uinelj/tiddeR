<?php
/*****************
 * tiddeR
 * post
 *****************/

class post
{
	private $id;
	private $title;
	private $link;
	private $date;
	private $content;
	private $tags = array();
	private $rating;
	private $author;
	private $authorID;
	private $self;
	private $comments;
	
	public function __construct($id, $title, $link, $date, $content, $tags, $rating, $author, $authorID, $self, $comments = array()){
		$this->id = $id;
		$this->title = $title;
		$this->link = $link;
		$this->date = $date;
		$this->content = $content;
		$this->tags = $tags;
		$this->rating = $rating;
		$this->author = $author;
		$this->authorID = $authorID;
		$this->self = $self;
		$this->comments = $comments;
	}
	
	public function id(){
		return $this->id;
	}
	
	public function title(){
		return $this->title;
	}
	
	public function link(){
		return $this->link;
	}
	
	public function date(){
		return date("d F Y", strtotime($this->date));
	}
	
	public function content(){
		return $this->content;
	}
	
	public function tags(){
		return $this->tags;
	}
	
	public function rating(){
		return $this->rating;
	}
	
	public function setRating($rating){
		$this->rating = $rating;
		return $rating;
	}
	
	public function author(){
		return $this->author;
	}
	
	public function authorID(){
		return $this->authorID;
	}
	
	public function isSelf(){
		return $this->self;
	}
	
	public function domain(){
		return parse_url($this->link, PHP_URL_HOST);
	}
	
	public function comments(){
		return $this->comments;
	}
	
	public function setComments($comments){
		$this->comments = $comments;
	}
}