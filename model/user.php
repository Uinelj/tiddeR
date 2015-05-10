<?php
/*****************
 * tiddeR
 * user
 *****************/

class user
{
	private $id;
	private $nick;
	private $mail;
	private $hash;
	private $perms; //4 perms : visitor(0), user(1), admin(2), candidate(3) ban(4)

	public function __construct($id, $nick, $mail, $hash, $perms){
		$this->id = $id;
		$this->nick = $nick;
		$this->mail = $mail;
		$this->hash = $hash;
		$this->perms = $perms;
	}

	public function id(){
		return $this->id;
	}

	public function nick(){
		return $this->nick;
	}

	public function mail(){
		return $this->mail;
	}

	public function hash(){
		return $this->hash;
	}

	public function perms(){
		return $this->perms;
	}
}