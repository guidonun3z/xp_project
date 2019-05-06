<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar Datos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../Icons/icons-format.css">
    <link rel="stylesheet" href="../../icons/style.css">
    <script src="main.js"></script>
    <style>
		.content {
			margin-top: 80px;
		}
	</style>
</head>
<body> 
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">

			<a class="navbar-brand visible-xs-block visible-sm-block" href="../index.html">
					<span class="icon-view_compact"></span>
					Inicio
			</a>

			<a class="navbar-brand visible-xs-block visible-sm-block" href="../index.html">
				<span class="icon-person_add"></span>
				Registrar Invitado
			</a>

			<a class="navbar-brand" href="lista.php">
				<span class="icon-person_list"></span>
				Lista De Invitados
			</a>
	</nav>
    <div class="container">
		<div class="content">
			<h2>Datos del invitado &raquo; Editar datos</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($con, "SELECT * FROM Persona WHERE Persona_ID='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: ../index.html");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$id = mysqli_real_escape_string($con,(strip_tags($nik,ENT_QUOTES)));//Escanpando caracteres 
                                $nombre  = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres
                                $apellidoP = mysqli_real_escape_string($con,(strip_tags($_POST["apellidoP"],ENT_QUOTES)));

                                $apellidoM = mysqli_real_escape_string($con,(strip_tags($_POST["apellidoM"],ENT_QUOTES)));

                                $numeroDoc = mysqli_real_escape_string($con,(strip_tags($_POST["numeroDoc"],ENT_QUOTES)));

                                $tipoDoc = mysqli_real_escape_string($con,(strip_tags($_POST["doctype"],ENT_QUOTES)));

                                $direccion = mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));

                                $fechaNac = mysqli_real_escape_string($con,(strip_tags($_POST["fechaNac"],ENT_QUOTES)));
                                
                                $numeroCel = mysqli_real_escape_string($con,(strip_tags($_POST["numeroCel"],ENT_QUOTES)));

                                $numeroEmer = mysqli_real_escape_string($con,(strip_tags($_POST["numeroEmer"],ENT_QUOTES)));

                                $correo = mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));

                                $sexo = mysqli_real_escape_string($con,(strip_tags($_POST["gender"],ENT_QUOTES)));
				
                                $update = mysqli_query($con, "call EditarInvitado('$id','$tipoDoc','$numeroDoc','$nombre','$apellidoP','$apellidoM','$sexo','$direccion','$numeroCel','$fechaNac','$correo','$numeroEmer')") or die(mysqli_error($con));
                                
				if($update){
					header("Location: editardatos.php?nik=".$nik."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
            }
			?>
			<form action="" method="post">
			<div class="form-group">
                     <label for="id">ID</label>
                     <input type="text" value="<?php echo $row['Persona_ID'];?>"class="form-control" id="id" name="id" placeholder="Nombre" >
           </div>

            <div class="form-group">
                    <label for="nombre">Nombre </label>
                    <input type="text" value="<?php echo $row['Nombre'];?>" class="form-control" id="nombre" name="nombre" placeholder="Nombre" >
            </div>
            <div class="form-group">
                    <label for="apellidoPaterno">Apellido Paterno </label>
                    <input type="text" value="<?php echo $row['Apellido_Paterno'];?>" class="form-control" id="apellidoPaterno" name="apellidoP" placeholder="Apellido Paterno">
            </div>

            <div class="form-group">
                    <label for="formGroupExampleInput3">Apellido Materno</label>
                    <input type="text" value="<?php echo $row['Apellido_Materno'];?>" class="form-control" id="formGroupExampleInput3" name="apellidoM" placeholder="Apellido Materno">
            </div>

            <div class="form-group">
                    <label for="numeroDocumento" >Numero de documento </label>
                    <input type="text" value="<?php echo $row['Numero_Documento'];?>" class="form-control" id="numeroDocumento" name="numeroDoc" placeholder="Numero de documento">
            </div>

            <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de documento </label> <br>
                    <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="doctype" id="inlineRadio1" value="DNI">
                            <label class="form-check-label" for="inlineRadio1">DNI</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="doctype" id="inlineRadio2" value="Carnet de extranjería">
                            <label class="form-check-label" for="inlineRadio2">Carnet de extranjería</label>
                    </div>
            </div>

            <div class="form-group">
                    <label for="formGroupExampleInput5">Direccion</label>
                    <input type="text" value="<?php echo $row['Direccion'];?>" class="form-control" id="formGroupExampleInput5" name="direccion" placeholder="Direccion">
            </div>

            <div class="form-group">
                    <label for="fechaNacimiento" >Fecha de Nacimiento </label>
                    <input type="text" value="<?php echo $row['Fecha_Nacimiento'];?>" class="form-control" id="fechaNacimiento" name="fechaNac" placeholder="Fecha de nacimiento">
            </div>

            <div class="form-group">
                    <label for="formGroupExampleInput7">Numero de celular</label>
                    <input type="text" value="<?php echo $row['NroCelular'];?>" class="form-control" id="formGroupExampleInput7" name="numeroCel" placeholder="Numero de celular">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput7">Numero de emergencia</label>
                <input type="text" value="<?php echo $row['Telefono_Emergencia'];?>" class="form-control" id="formGroupExampleInput7" name="numeroEmer" placeholder="Numero de celular">
           </div>

            <div class="form-group">
                    <label for="formGroupExampleInput8">Correo</label>
                    <input type="text" value="<?php echo $row['Correo'];?>" class="form-control" id="formGroupExampleInput8" name="correo" placeholder="ejemplo@gmail.com">
            </div>
            
            <div class="form-group">
                    <label for="formGroupExampleInput">Sexo </label> <br>
                    <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="M">
                            <label class="form-check-label" for="inlineRadio1">Masculino</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="F">
                            <label class="form-check-label" for="inlineRadio2">Femenino</label>
                    </div>
            </div>	
				
		
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn-edit btn btn-sm btn-primary" value="Guardar datos">
						<a href="lista.php" class="btn edit btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>