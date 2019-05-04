<?php

class DB{

	private $host='localhost';
	private $username = 'root';
	private $password ='';
	private $dbname='eceshop'; 
	public $bdd;

	public function __construct($host = null, $username = null, $password =null, $dbname = null)
	{
		if($host != null)
		{
			$this->host= $host;
			$this->username= $username;
			$this->password= $password;
			$this->dbname= $dbname;


		}

		$this->bdd= new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8', $this->username, $this->password);



	}
	public function requette($sql , $data= array())
	{
		
		$req=$this->bdd->prepare($sql);
		$req->execute($data);
		//on recupere tout
		return $req->fetchall(PDO::FETCH_OBJ);
	}


}



?>