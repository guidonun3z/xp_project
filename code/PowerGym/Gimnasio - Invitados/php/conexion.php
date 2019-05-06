<?php
$db_host="localhost";
$db_user="guidonunez_gimnasio";
$db_pass="gor{025G~of)";
$db_name="guidonunez_gimnasio";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
 
if(mysqli_connect_errno()){
	echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
}
?>