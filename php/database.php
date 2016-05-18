<?php
class Database
{
	private $dbname = '';//'SeaTour'
	private $user = '';//'root'
	private $pass = '';//''
	private $server = '';//localhost
	
	function __construct($name, $usr, $pw, $serv) 
	{
       $this->dbname = $name;
	   $this->user = $usr;
	   $this->pass = $pw;
	   $this->server = $serv;	  
	}

	function get_dbname()
	{
		return self::$dbname;
	}
	
	function get_user()
	{
		return self::$user;
	}
	
	function get_pass()
	{
		return self::$pass;
	}
	
	function get_server()
	{
		return self::$server;
	}
}
?>