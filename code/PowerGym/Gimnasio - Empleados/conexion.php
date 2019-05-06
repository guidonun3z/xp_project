<!-- Conexion -->
<?php
// Direcion
$db_host="localhost";
// Usuario
$db_user="guidonunez_gimnasio";
// Contraseña
$db_pass="gor{025G~of)";
// Nombre de La Base de Datos
$db_name="guidonunez_gimnasio";
// Conexion
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
 
if(mysqli_connect_errno()){
	echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
}
?>