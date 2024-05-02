<?php
session_start();
date_default_timezone_set("America/Chicago");
$servidor="";	//IP DEL SERVER DE BD
$usuario="";	//USUARIO DE LA BD
$clave="";		//CLAVE DE LA BD
$bd="";			//NOMBRE DE BD

	$conexion=mysqli_connect($servidor,$usuario,$clave,$bd);

	if (!$conexion) 
	{
    	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    	exit;
	}
	else 
		{
			mysqli_set_charset($conexion,"utf8");
			//mysqli_select_db($bd, $conexion);
			mysqli_query($conexion,"SET time_zone = '-06:00'");
			//mysqli_query($conexion,"SET NAMES 'utf8'");
		}


$sql="select now()as hoy";
$query= mysqli_query($conexion,$sql) or die($queryrne."<br/><br/>".mysql_error());

if(mysqli_num_rows($query) != 0)
{
	                            
	while($row = mysqli_fetch_array($query))
	{
		$c = $row['hoy'];
	}
	//echo $c;
}
//$documentos=$conexion->query($tareas)
?>