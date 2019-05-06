<?php
include 'conexion.php';

$tipoDoc = $_POST["doctype"];
$personaID = $_POST["id"];
$nroDocumento = $_POST["numeroDoc"];
$nombre = $_POST["nombre"];
$apellidoP = $_POST["apellidoP"];
$apellidoM = $_POST["apellidoM"];
$direccion = $_POST["direccion"];
$fechaNac = $_POST["fechaNac"];
$fechaIns = $_POST["fechaIns"];
$numeroCel = $_POST["numeroCel"];
$numeroEmergencia = $_POST["numeroEmer"];
$correo = $_POST["correo"];
$sexo = $_POST["gender"];

$stInsertarInvitado = mysqli_prepare($con,"call InsertarInvitado(?,?,?,?,?,?,?,?,?,?,?,?)");
$stInsertarInvitado->bind_param("ssisssssssss",$personaID,$tipoDoc,$nroDocumento,$nombre,$apellidoP,$apellidoM,$sexo,$direccion,$numeroCel,$fechaNac,$correo,$numeroEmergencia);
$stInsertarInvitado->execute();

$stInsertarRP = mysqli_prepare($con,"call InsertarRolInvitado(?,?)");
$stInsertarRP->bind_param("ss",$personaID,$fechaIns);
$stInsertarRP->execute();


if(!$stInsertarInvitado && !$stInsertarRP){
    echo "Hubo un error en la insercion de datos";
}else{
    echo "El registro se insertó correctamente, haga click <a href='../index.html'>aqui</a> para volver";
}
$stInsertarInvitado->close();
$stInsertarRP->close();
$con->close();
?>