<!-- conexion -->
<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Editar Datos</title>
	<!-- css -->
	 <link rel="stylesheet" type="text/css" href="css/fondo2.css">
	 <link rel="stylesheet" href="../Icons/icons-format.css">
   <link rel="stylesheet" href="../Icons/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<!-- boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
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
		<!-- Contenido -->
    <div class="bg-text">
		<!-- Barra de navegacion -->
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
		<!-- endBarradeNavegacion -->
		<div class="container">
			<!-- Titulo -->
			<div class="container" id="titulo">
			<h2 >Editar datos</h2>
			</div>
			<!-- endTitulo -->
			<div class="content" id="datos">
				
				<hr />
				
				<?php
				// Consulta a la base de datos-Select*from empleados where Numero_Documento=NIK(Index-php)
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$rols= mysqli_query($con,"SELECT
				*FROM roles");
				$sql = mysqli_query($con, "SELECT p.Persona_ID,p.Numero_Documento,p.Tipo_Documento,p.Nombre,p.Apellido_Paterno,p.Apellido_Materno,p.NroCelular,p.Fecha_Nacimiento,r.Nombre AS rol
				,p.Correo,p.Sexo,p.Direccion,p.Tipo_Documento,p.Telefono_Emergencia,
				rp.Fecha_Inicio_Contrato,r.Rol_ID,rp.Fecha_Fin_Contrato,rp.Fecha_Inscripcion,rp.Correo_Institucional,rp.Numero_Seguro,t.Nombre as turno,t.Turno_ID,t.`Hora_Inicio`,t.Hora_Fin,p.Correo
		FROM persona p
		JOIN rolespersona rp
		ON p.Persona_ID=rp.Persona_ID
		JOIN roles r
		ON r.Rol_ID=rp.Rol_ID
		JOIN turno t
		ON t.Turno_ID=rp.Turno_ID
		WHERE r.Rol_ID=3 OR r.Rol_ID=4 OR r.Rol_ID=5 OR r.Rol_ID=6
		HAVING p.Persona_ID='$nik'");
				if(mysqli_num_rows($sql) == 0){
					header("Location: index.php");
				}else{
					$row = mysqli_fetch_assoc($sql);
				}
				if(mysqli_num_rows($rols) == 0){
					header("Location: index.php");
				}else{
					$row2 = mysqli_fetch_assoc($rols);
				}
				//Guardar-Datos-Boton(GuardarDatos)
				if(isset($_POST['save'])){
					$turnoID	     = mysqli_real_escape_string($con,(strip_tags($_POST["Turno_ID"],ENT_QUOTES)));
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
					$update = mysqli_query($con, "UPDATE rolespersona SET Turno_ID='$turnoID', Numero_Seguro='$Numero_Seguro',Fecha_Inicio_Contrato='$Fecha_Inicio_Contrato',Fecha_Fin_Contrato='$Fecha_Fin_Contrato',Correo_Institucional='$Correo_Institucional',Rol_ID='$rol' WHERE Persona_ID='$nik'") or die(mysqli_error());
					$update2 = mysqli_query($con, "UPDATE persona SET Nombre='$Nombre', Apellido_Paterno='$Apellido_Paterno',Apellido_Materno='$Apellido_Materno',Sexo='$Sexo',Direccion='$Direccion',Fecha_Nacimiento='$Fecha_Nacimiento',Correo='$Correo',NroCelular='$NroCelular',Telefono_Emergencia='$Telefono_Emergencia' WHERE Persona_ID='$nik'") or die(mysqli_error());
					if($update&&$update2){
						header("Location: editardatos.php?nik=".$nik."&pesan=sukses");
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
					}
					
					
				}
				if(isset($_GET['pesan']) == 'sukses'){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
				}
				?>
				<!-- Formulario editar Datos -->
				<form class="form-horizontal " id=editar action="" method="post">
					
					<!-- NumerodeDocumento -->
					<div class="form-group">
						<label class="col-sm-3 control-label ">Numero de Documento</label>
						<div class="col-sm-2">
							<input type="text" name="Numero_Documento" value="<?php echo $row['Tipo_Documento'].': '.$row['Numero_Documento']; ?>" class="form-control" placeholder="Numero de Documento" required readonly>
						</div>
					</div>
					<!-- endNumero de Documento -->
					<!-- Nombres -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Nombres</label>
						<div class="col-sm-4">
							<input type="text" name="Nombre" value="<?php echo $row ['Nombre']; ?>" class="form-control" placeholder="Nombres" required>
						</div>
					</div>
					<!-- endNombres -->
					<!-- ApellidoPaterno -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Apellido Paterno</label>
						<div class="col-sm-4">
							<input type="text" name="Apellido_Paterno" value="<?php echo $row ['Apellido_Paterno']; ?>" class="form-control" placeholder="Apellidos" required>
						</div>
					</div>
					<!-- endApellidoPaterno -->
					<!-- apellidoMaterno -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Apellido Materno</label>
						<div class="col-sm-4">
							<input type="text" name="Apellido_Materno" value="<?php echo $row ['Apellido_Materno']; ?>" class="form-control" placeholder="Apellidos" required>
						</div>
					</div>
					<!-- endApellidMaterno -->
					<!-- correo -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Correo Personal</label>
						<div class="col-sm-4">
							<input type="text" name="Correo" value="<?php echo $row ['Correo']; ?>" class="form-control" placeholder="Apellidos" required>
						</div>
					</div>
					<!-- correoinstituional -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Correo Institucinal</label>
						<div class="col-sm-4">
							<input type="text" name="Correo_Institucional" value="<?php echo $row ['Correo_Institucional']; ?>" class="form-control" placeholder="Apellidos" required>
						</div>
					</div>
					<!-- Sexo -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Sexo</label>
							<div class="col-sm-3">
							<select name="Sexo" class="form-control">
              <option value="f" <?php if ($row ['Sexo']=='f'){echo "selected";} ?>>Femenino</option>
							<option value="m" <?php if ($row ['Sexo']=='m'){echo "selected";} ?>>Masculino</option>
						</select>  
						</div>
					</div>
					<!-- lugarnacimineto -->
					<!-- <div class="form-group">
						<label class="col-sm-3 control-label">Lugar de nacimiento</label>
						<div class="col-sm-4">
							<input type="text" name="lugar_nacimiento" value="<?php echo $row ['lugar_nacimiento']; ?>" class="form-control" placeholder="Lugar de nacimiento" required>
						</div>
					</div> -->
					<!-- endlugar -->
					<!-- fecha de nacimiento -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Fecha de nacimiento</label>
						<div class="col-sm-4">
							<input type="text" name="Fecha_Nacimiento" value="<?php echo $row ['Fecha_Nacimiento']; ?>" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
						</div>
					</div>
					<!-- Fecha_Inicio_Contrato -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Fecha Inicio Contrato</label>
						<div class="col-sm-4">
							<input type="text" name="Fecha_Inicio_Contrato" value="<?php echo $row ['Fecha_Inicio_Contrato']; ?>" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
						</div>
					</div>
					<!-- Fecha_Fin_Contrato -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Fecha Fin Contrato</label>
						<div class="col-sm-4">
							<input type="text" name="Fecha_Fin_Contrato" value="<?php echo $row ['Fecha_Fin_Contrato']; ?>" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
						</div>
					</div>
					<!-- endfecha de nacimiento -->
					<!-- Direccion -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Dirección</label>
						<div class="col-sm-3">
							<textarea name="Direccion" class="form-control" placeholder="Dirección"><?php echo $row ['Direccion']; ?></textarea>
						</div>
					</div>
					<!-- enddireccion -->
					<!-- NroCelular -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Teléfono</label>
						<div class="col-sm-3">
							<input type="text" name="NroCelular" value="<?php echo $row ['NroCelular']; ?>" class="form-control" placeholder="NroCelular" required>
						</div>
					</div>
					<!-- Telefono_Emergencia -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Teléfono de Emergencia</label>
						<div class="col-sm-3">
							<input type="text" name="Telefono_Emergencia" value="<?php echo $row ['Telefono_Emergencia']; ?>" class="form-control" placeholder="Telefono_Emergencia" required>
						</div>
					</div>
					<!-- Telefono_Emergencia -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Numero De Seguro</label>
						<div class="col-sm-3">
							<input type="text" name="Numero_Seguro" value="<?php echo $row ['Numero_Seguro']; ?>" class="form-control" placeholder="Numero_Seguro" required>
						</div>
					</div>
					<!-- endtelefono -->
					<!-- rol -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Puesto</label>
						<div class="col-sm-3">
						<select name="Rol_ID" class="form-control">
              <option value="3" <?php if ($row ['Rol_ID']==3){echo "selected";} ?>>Entrenador</option>
							<option value="4" <?php if ($row ['Rol_ID']==4){echo "selected";} ?>>Nutricionista</option>
							<option value="5" <?php if ($row ['Rol_ID']==5){echo "selected";} ?>>Administrador</option>
							<option value="6" <?php if ($row ['Rol_ID']==6){echo "selected";} ?>>Recepcionista</option>
						</select>
						</div>
					</div>
					<!-- turno -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Turno</label>
							<div class="col-sm-3">
							<select name="Turno_ID" class="form-control">
              <option value="1" <?php if ($row ['Turno_ID']==1){echo "selected";} ?>>Mañana</option>
							<option value="2" <?php if ($row ['Turno_ID']==2){echo "selected";} ?>>Tarde</option>
						</select>
					</div>
					<!-- endpuesto -->
					<!-- botones -->
					<div class="form-group">
						<label class="col-sm-3 control-label">&nbsp;</label>
						<div class="col-sm-6">
							<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
							<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
						</div>
					</div>
					<!-- endBotones -->
				</form>
				<!-- endFormulario-Editar-Datos -->
			</div>
		</div>
	</div>
</body>
</html>