<?php 

class IMEC { 
	function __construct(){}

	function Valores($val){
		require("datos_conexion/conexion.php");
		return $mysqli->real_escape_string($val);
	}

	function Encriptar($Variable){
		return sha1(md5('3@4gF$fTEm..'.$Variable));
	}

	function ArrSerialize($Var){
		if (strlen($Var)>3){
			$Arr1 = explode("&", $Var);
			foreach ($Arr1 as $value) {
				$Arr2 = explode("=", $value);
				$Arr3[]=$Arr2[1];
			}
			return $Arr3;
		}else{
			return $Var;
		}
	}

	// Metodo para insertar los registros en la base de datos

	// $tabIns -> Nombre de la tabla
	// $valIns -> Nombre de los campos de la tabla
	// $contIns --> Valores que se registraran en los campos de la tabla
	// $condIns --> Condicional

	function Insertar($tabIns,$valIns,$contIns,$condIns){
		require("datos_conexion/conexion.php");	// Conectarnos a la base de datos
		if ($condIns=="" || $condIns==null) {
			// Se realiza una consulta sin condiciones
		    $SQLI="INSERT INTO $tabIns($valIns) values($contIns)";
			$mysqli->query($SQLI);
		}else{
			// Se realiza la consulta con una condición
			$SQLI="INSERT INTO $tabIns ($valIns) values ($contIns) WHERE ($condIns)";
			$mysqli->query($SQLI);
		}
		return($mysqli->insert_id);
	}

    function InsertNoti($userid,$id_noti){
		require("datos_conexion/conexion.php");
		
	    $SQLI="INSERT INTO `notificaciones_mensajes` ( `id_noti_men`, `usr`) VALUES ('$id_noti', '$userid')";

			$mysqli->query($SQLI);
		
		return($mysqli->insert_id);
	}

	// Este metodo nos permite realizar una consulta y nos devuelve un solo dato
	function Consultar($tab,$cond){
		require("datos_conexion/conexion.php");
		if ($cond=="" || $cond==null) {
			// Se realiza una consulta sin condiciones
			$SQL="SELECT * FROM $tab";
			$Row=$mysqli->query($SQL);
		}else{
			// Se realiza la consulta con una condición
			$SQL="SELECT * FROM $tab WHERE ($cond)";
			$Row=$mysqli->query($SQL);
		}
		return($Row->fetch_array());
	}

	// Este metodo nos sirve para realizar consultas y que nos devuelva una lista de resultados
	function ConLista($tab,$cond){
		require("datos_conexion/conexion.php");
		if ($cond=="" || $cond==null) {
			// Se realiza una consulta sin condiciones
			$SQL="SELECT * FROM $tab";
		}else{
			// Se realiza la consulta con una condición
	     	$SQL="SELECT * FROM $tab WHERE $cond";
		}
		return($mysqli->query($SQL));
	}

    // Método para actualizar registros en la base de datos
	function Actualizar($tabAct,$datAct,$condAct){	
		  require("datos_conexion/conexion.php");
		if ($condAct=="" || $condAct==null) {
			// Se realiza una consulta sin condiciones
		  $SQLA="UPDATE $tabAct SET $datAct";
		}else{
			// Se realiza la consulta con una condición
	      $SQLA="UPDATE $tabAct SET $datAct WHERE($condAct)";
		}
			if ($Row=$mysqli->query($SQLA)) {
				return true;
			}
				return false;
	}

    // Método para eliminar registros de la base de datos
	function Eliminar($tabEli,$condEli){
		  require("datos_conexion/conexion.php");
		if ($condEli=="" || $condEli==null) {
			// DELETE FROM `tecnicos_asignados` WHERE 0
		 // $SQLA="DELETE FROM $tabAct";
		}else{
			// Se realiza la consulta con una condición
		    $SQLE="DELETE FROM $tabEli WHERE($condEli)";
		}
			if ($Row=$mysqli->query($SQLE)) {
				return true;
			}
				return false;
	}
	function Manual($Conten)
	{
		require("datos_conexion/conexion.php");
		$SQLI=$Conten;	
		return($mysqli->query($SQLI));
	}	

	function validar_fecha($fecha){
	$valores = explode('-', $fecha);
	if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
		return true;
    }
		return false;
	}

	function alerts($mensaje)
	{
		return '<div class="alert alert-success" role="alert">'.$mensaje.' </div>';
	}	

	function alertd($mensaje)
	{
		return '<div class="alert alert-danger" role="alert">'.$mensaje.' </div>';
	}	

	function alerti($mensaje)
	{
		return '<div class="alert alert-info" role="alert">'.$mensaje.' </div>';
	}	

	function alertw($mensaje)
	{
		return '<div class="alert alert-warning" role="alert">'.$mensaje.' </div>';
	}
	
}
$BD= new IMEC();