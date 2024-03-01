<?php
	function getDB(){
		$host = "localhost";
		$name = "sqlite:./database.db";
		$db = new PDO($name);
		return $db;
	}
    
?>