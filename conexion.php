<?php
require_once 'datos.php';
/**
 * [creaConexion hace la coneccion a la base de datos]
 * @return conexion Regresa la conexion a MySQL
 */
function creaConexion(){
	$conexion= mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
	if($conexion->connect_error){
		die("Error en la conexion: ".$conexion->connect_errno."-".$conexion-connect_error);
	}
return $conexion;
}
?>