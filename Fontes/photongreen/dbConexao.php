<?php
	$Servidor = "localhost";
	$DataBase = "incidencia_solar";
	$Usuario = "root";
	$Senha = "abc";
	
	$conexao = new PDO("mysql:host=$Servidor;dbname=$DataBase", $Usuario, $Senha);	
?>
