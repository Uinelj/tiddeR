<?php
/*****************
 * tiddeR
 * user
 *****************/

class user
{
	private $nick;
	private $mail;
	private $hash;
	private $perms; //3 perms : ban(0), user(1), admin(2)

	public function __construct($nick, $mail, $hash, $perms){
		$this->nick = $nick;
		$this->mail = $mail;
		$this->hash = $hash;
		$this->perms = $perms;
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