<?php

class NuclearFactory{
	/******************** Mysql **********************/
	protected $username = 'root';
	protected $password = '';
	protected $server = 'mysql:host=localhost;dbname=nuclear';
	protected $options  = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
	/******************** Mongo **********************/
  
	public function __construct(){
		try{
			$this->con = new PDO($this->server, $this->username, $this->password, $this->options);
		}catch (PDOException $e){
			print "¡Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
	public function query($sql){
	  	return $this->con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}
	public function query_by_id($sql){
		return $this->con->query($sql)->fetch();
	}
	public function execute($sql, $data){
		return $this->con->prepare($sql)->execute($data);
	}
	public function execute_insert_last_insert_id($sql, $data){
		$this->con->prepare($sql)->execute($data);
		return $this->con->lastInsertId();
	}
}
