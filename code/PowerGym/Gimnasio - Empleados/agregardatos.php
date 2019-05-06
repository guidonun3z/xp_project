<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agregar Empleado</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/fondo2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="main.css">
	<link rel="stylesheet" href="../Icons/icons-format.css">
    <link rel="stylesheet" href="../Icons/style.css">
    <script src="main.js"></script>
    <style>
		.content {
			margin-top: 80px;
		}
	</style>
</head>
<body>
	<div class="bg-image" >
	</div>
    <div class="bg-text">
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
	    <a class="navbar-brand visible-xs-block visible-sm-block" href="../index.html">
		    <span class="icon-view_compact"></span>
			Inicio
		</a>
		<a class="navbar-brand" href="agregardatos.php">
		    <span class="icon-person_add"></span>
			Agregar Empleado
		</a>
        <a class="navbar-brand" href="index.php">
		    <span class="icon-person_list"></span>
			Lista De Empleados
		</a>
    </nav>
	<div class="container">
		<div class="content" id="datos">
			<h2>Agregar Nuevo Empleado</h2>
			<hr />
			<?php
			$rols= mysqli_query($con,"SELECT*FROM roles");
			if(mysqli_num_rows($rols) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($rols);
			}
			$turno= mysqli_query($con,"SELECT*
			FROM Turno");
			if(mysqli_num_rows($turno) == 0){
				header("Location: index.php");
			}else{
				$turnos = mysqli_fetch_assoc($turno);
			}
			?>
			

			<?php
			if(isset($_POST['add'])){
					$turnoID	     = mysqli_real_escape_string($con,(strip_tags($_POST["Turno_ID"],ENT_QUOTES)));
					$Tipo_Documento	     = mysqli_real_escape_string($con,(strip_tags($_POST["Tipo_Documento"],ENT_QUOTES)));
					$Codigo	     = mysqli_real_escape_string($con,(strip_tags($_POST["Codigo"],ENT_QUOTES)));
					$Sexo	     = mysqli_real_escape_string($con,(strip_tags($_POST["Sexo"],ENT_QUOTES)));
					$Numero_Documento		     = mysqli_real_escape_string($con,(strip_tags($_POST["Numero_Documento"],ENT_QUOTES))); 
					$Nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre"],ENT_QUOTES)));
					$Apellido_Paterno		     = mysqli_real_escape_string($con,(strip_tags($_POST["Apellido_Paterno"],ENT_QUOTES))); 
					$Apellido_Materno		     = mysqli_real_escape_string($con,(strip_tags($_POST["Apellido_Materno"],ENT_QUOTES))); 
					$Fecha_Nacimiento	 = mysqli_real_escape_string($con,(strip_tags($_POST["Fecha_Nacimiento"],ENT_QUOTES)));
					$Fecha_Inicio_Contrato	 = mysqli_real_escape_string($con,(strip_tags($_POST["Fecha_Inicio_Contrato"],ENT_QUOTES)));
					$Fecha_Fin_Contrato	 = mysqli_real_escape_string($con,(strip_tags($_POST["Fecha_Fin_Contrato"],ENT_QUOTES))); 
					$Direccion	     = mysqli_real_escape_string($con,(strip_tags($_POST["Direccion"],ENT_QUOTES)));
					$Correo	     = mysqli_real_escape_string($con,(strip_tags($_POST["Correo"],ENT_QUOTES)));
					$Correo_Institucional	     = mysqli_real_escape_string($con,(strip_tags($_POST["Correo_Institucional"],ENT_QUOTES)));
					$NroCelular		 = mysqli_real_escape_string($con,(strip_tags($_POST["NroCelular"],ENT_QUOTES)));
					$Telefono_Emergencia		 = mysqli_real_escape_string($con,(strip_tags($_POST["Telefono_Emergencia"],ENT_QUOTES)));
					$rol		 = mysqli_real_escape_string($con,(strip_tags($_POST["Rol_ID"],ENT_QUOTES)));
					$Numero_Seguro		 = mysqli_real_escape_string($con,(strip_tags($_POST["Numero_Seguro"],ENT_QUOTES))); 
					$cek = mysqli_query($con,"SELECT * FROM persona WHERE Persona_ID='$Codigo'");
					$fecha_actual=date("Y/m/d");
					if(mysqli_num_rows($cek) == 0){
						$insertpersona = mysqli_query($con,"INSERT INTO persona(Persona_ID,Tipo_Documento,Numero_Documento,Nombre,Apellido_Paterno,Apellido_Materno,Sexo,Direccion,NroCelular,Fecha_Nacimiento,Correo,Telefono_Emergencia)
															VALUES('$Codigo','$Tipo_Documento','$Numero_Documento','$Nombre','$Apellido_Paterno','$Apellido_Materno','$Sexo','$Direccion','$NroCelular','$Fecha_Nacimiento','$Correo','$Telefono_Emergencia')") or die(mysqli_error());

						$insertrol = mysqli_query($con, "INSERT INTO rolespersona(Rol_ID,Persona_ID,Turno_ID,Fecha_Inscripcion,Fecha_Inicio_Contrato,Fecha_Fin_Contrato,Correo_Institucional,Numero_Seguro)
															VALUES('$rol','$Codigo','$turnoID','$fecha_actual','$Fecha_Inicio_Contrato','$Fecha_Fin_Contrato','$Correo_Institucional','$Numero_Documento')") or die(mysqli_error());
						if($insertpersona){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
			?>

			<!-- Formulario editar Datos -->
			<form class="form-horizontal " id=editar action="" method="post">
					<!-- Codigo -->
					<div class="form-group">
						<label class="col-sm-3 control-label ">Codigo</label>
						<div class="col-sm-1">
							<input type="text" name="Codigo" class="form-control" placeholder="Codigo" required>
						</div>
					</div>
					<!-- TipoDocumento -->
					<div class="form-group">
						<label class="col-sm-3 control-label ">Tipo Documento</label>
						<div class="col-sm-1">
							<input type="text" name="Tipo_Documento" class="form-control" placeholder="Tipo_Documento" required>
						</div>
					</div>
					<!-- NumerodeDocumento -->
					<div class="form-group">
						<label class="col-sm-3 control-label ">Numero de Documento</label>
						<div class="col-sm-2">
							<input type="text" name="Numero_Documento" class="form-control" placeholder="Numero de Documento" required>
						</div>
					</div>
					<!-- endNumero de Documento -->
					<!-- Nombres -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Nombres</label>
						<div class="col-sm-4">
							<input type="text" name="Nombre"  class="form-control" placeholder="Nombres" required>
						</div>
					</div>
					<!-- endNombres -->
					<!-- ApellidoPaterno -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Apellido Paterno</label>
						<div class="col-sm-4">
							<input type="text" name="Apellido_Paterno" class="form-control" placeholder="Apellido Paterno" required>
						</div>
					</div>
					<!-- endApellidoPaterno -->
					<!-- apellidoMaterno -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Apellido Materno</label>
						<div class="col-sm-4">
							<input type="text" name="Apellido_Materno"  class="form-control" placeholder="Apellido Materno" >
						</div>
					</div>
					<!-- endApellidMaterno -->
					<!-- correo -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Correo Personal</label>
						<div class="col-sm-4">
							<input type="text" name="Correo"  class="form-control" placeholder="Correo Personal" >
						</div>
					</div>
					<!-- correoinstituional -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Correo Institucinal</label>
						<div class="col-sm-4">
							<input type="text" name="Correo_Institucional"  class="form-control" placeholder="Correo Institucional" >
						</div>
					</div>
					<!-- Sexo -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Sexo</label>
							<div class="col-sm-3">
							<select name="Sexo" class="form-control">
              				<option value="f">Femenino</option>
							<option value="m">Masculino</option>
						</select>  
						</div>
					</div>
					<!-- lugarnacimineto -->
					<!-- <div class="form-group">
						<label class="col-sm-3 control-label">Lugar de nacimiento</label>
						<div class="col-sm-4">
													</div>
					</div> -->
					<!-- endlugar -->
					<!-- fecha de nacimiento -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Fecha de nacimiento</label>
						<div class="col-sm-4">
							<input type="text" name="Fecha_Nacimiento"  class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
						</div>
					</div>
					<!-- Fecha_Inicio_Contrato -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Fecha Inicio Contrato</label>
						<div class="col-sm-4">
							<input type="text" name="Fecha_Inicio_Contrato"  class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required >
						</div>
					</div>
					<!-- Fecha_Fin_Contrato -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Fecha Fin Contrato</label>
						<div class="col-sm-4">
							<input type="text" name="Fecha_Fin_Contrato" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
						</div>
					</div>
					<!-- endfecha de nacimiento -->
					<!-- Direccion -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Dirección</label>
						<div class="col-sm-3">
							<textarea name="Direccion" class="form-control" placeholder="Dirección"></textarea>
						</div>
					</div>
					<!-- enddireccion -->
					<!-- NroCelular -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Teléfono</label>
						<div class="col-sm-3">
							<input type="text" name="NroCelular"  class="form-control" placeholder="NroCelular"required >
						</div>
					</div>
					<!-- Telefono_Emergencia -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Teléfono de Emergencia</label>
						<div class="col-sm-3">
							<input type="text" name="Telefono_Emergencia"  class="form-control" placeholder="Telefono_Emergencia"required >
						</div>
					</div>
					<!-- Telefono_Emergencia -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Numero De Seguro</label>
						<div class="col-sm-3">
							<input type="text" name="Numero_Seguro"  class="form-control" placeholder="Numero_Seguro" required>
						</div>
					</div>
					<!-- endtelefono -->
					<!-- rol -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Puesto</label>
						<div class="col-sm-3">
						<select name="Rol_ID" class="form-control">
              				<option value="3" <?php if ($row['Rol_ID']==3){echo "selected";} ?>>Entrenador</option>
							<option value="4" <?php if ($row['Rol_ID']==4){echo "selected";} ?>>Nutricionista</option>
							<option value="5" <?php if ($row['Rol_ID']==5){echo "selected";} ?>>Administrador</option>
							<option value="6" <?php if ($row['Rol_ID']==6){echo "selected";} ?>>Recepcionista</option>
						</select>
						</div>
					</div>
					<!-- turno -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Turno</label>
							<div class="col-sm-3">
							<select name="Turno_ID" class="form-control">
              				<option value="1" <?php if ($turnos['Turno_ID']==1){echo "selected";} ?>>Mañana</option>
							<option value="2" <?php if ($turnos['Turno_ID']==2){echo "selected";} ?>>Tarde</option>
						</select>
					</div>
					<!-- endpuesto -->
					<!-- botones -->
					<div class="form-group">
						<label class="col-sm-3 control-label">&nbsp;</label>
						<div class="col-sm-6">
							<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
							<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
						</div>
					</div>
					<!-- endBotones -->
				</form>
				<!-- endFormulario-Editar-Datos -->
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>