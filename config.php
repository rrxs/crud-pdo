<?php

class config{
  protected $host;
  protected $user;
  protected $pass;
  protected $dbname;

  protected function makeConfig(){
  	if ($_SERVER['SERVER_NAME'] == "localhost") {
  		$this->host = "localhost";
  		$this->user = "root";
  		$this->pass = "";
  		$this->dbname = "pdo";
  	}
  }
}