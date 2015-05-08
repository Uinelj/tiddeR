<?php
//////////////////////////////////////////////////////////////////////
// PPE 2012-2013
// Louis Desportes
// accès a la bdd
//////////////////////////////////////////////////////////////////////
// request($requete) : envoyer une requete	
// erreur() : obtenir le message d'erreur
//////////////////////////////////////////////////////////////////////

require_once 'config.php'; 

class bdd
{
	private $erreur = false;
	public $dbco;
	
	public function __construct()
	{
		//Connection à la BDD
		$this->dbco = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
		if(!is_object($this->dbco)){echo "<font color='red' size='5'>DB N EST PAS UN OBJET</font>";}
		//gestion des erreurs de connection
		if ($this->dbco->errno)
		{
			$this->erreur= "Erreur de connection a la bdd : " . $this->dbco->connect_error;
		}
		if (!$this->dbco->set_charset("utf8")) {
			printf("Erreur lors du chargement du jeu de caractères utf8 : %s\n", $this->dbco->error);
		}
	}
	
	public function request($requete)
	{
		if (!$this->erreur)
		{
			if(!is_object($this->dbco)){echo "<font color='red' size='5'>dbco n'est pas un objet dans request 1</font>";}
			$result = $this->dbco->query($requete);
			if ($this->dbco->errno)
			{
				return $erreur = "Erreur a l execution de la requete: " . $this->dbco->error;
			}
			else
			{
				return $result;
			}
		}
	}
	
	public function erreur()
	{
		return $this->erreur;
	}
}
?>