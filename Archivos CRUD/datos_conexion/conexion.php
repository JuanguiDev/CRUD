<?php 
	date_default_timezone_set('America/Bogota');
		//virtual
		//$serv="173.249.20.186";
		//$user="desarrollo";
		//$pass='Y7@vG3#mN1$wX2&pL';

		//local 4d
		$serv="localhost";	// Se ha cambiado el server a -> localhost
		$user="root";
		$pass="";			// Se ha cambiado la contraseña a -> ""
		$db="gestion_soft"; 
		$type = "mysqli";

	$mysqli = new mysqli($serv, $user,  $pass, $db);	// Variable de conexion
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Error de conexión local: %s\n", mysqli_connect_error());
		exit();
	}

$mysqli->set_charset("utf8");