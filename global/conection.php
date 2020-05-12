<?php
	//VALORES DE LA CONEXIÓN EN LOCALHOST  
	$server = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'php_carrito';
	//INTENTA CONECTAR
	try {
	  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
	} catch (PDOException $e) {
	  die('Connection Failed: ' . $e->getMessage());
	}
?>