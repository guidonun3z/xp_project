<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datos de empleados</title>
    <!-- css -->
    <!-- <link rel="stylesheet" type="text/css" href="css/fondo2.css"> -->
	<!-- Bootstrap -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Foto -->
	<style>
        .content {
            margin-top: 80px;
        }
        .avatar img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 200px;
            height: 200px;
            max-width: 200px;
            max-height: 200px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
           
        }
	</style>

</head>
<body>
    <div class="bg-image" >
	</div>
    <div class="bg-text">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand visible-xs-block visible-sm-block" href="login.php">Inicio</a>
        <a class="navbar-brand" href="index.php">Lista De Empleados</a>
        <a class="navbar-brand" href="agregardatos.php">Agregar Empleado</a>
    </nav>
	<div class="container">
		<div class="content">
            <center>
            <h2 >Perfil Empleado</h2>
            </center>
			<hr/>
			<!-- Consulta -->
			<?php
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			
			$sql = mysqli_query($con, "SELECT p.Persona_ID,p.Numero_Documento,p.Tipo_Documento,p.Nombre,p.Apellido_Paterno,p.Apellido_Materno,p.NroCelular,p.Fecha_Nacimiento,r.Nombre AS rol
			,p.Correo,p.Sexo,p.Direccion,p.Tipo_Documento,p.Telefono_Emergencia,
			rp.Fecha_Inicio_Contrato,r.Rol_ID,rp.Fecha_Fin_Contrato,rp.Fecha_Inscripcion,rp.Correo_Institucional,rp.Numero_Seguro,t.Nombre as turno,t.Turno_ID,t.`Hora-Inicio`,t.Hora_Fin,p.Correo
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
			// Delete
			if(isset($_GET['aksi']) == 'delete'){
				$delete = mysqli_query($con, "DELETE FROM rolespersona WHERE Persona_ID='$nik'");
				if($delete){
					echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>DatosEliminados.</div>';
				}else{
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>';
				}
			}
            ?>
            <center>
                <div class="avatar">
                    <img alt="" src="896747.jpg">
                </div>
            </center>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-hover table-condensed" id="ta">
				<tr>
					<th class="bg-dark" width="20%">Codigo</th>
					<td><?php echo $row['Persona_ID']; ?></td>
				</tr>
				<tr>
					<th class="bg-dark" width="20%">Numero de Documento</th>
					<td><?php echo $row['Numero_Documento']; ?></td>
				</tr>
				<tr>
					<th class="bg-dark" width="20%">Tipo de Documento</th>
					<td><?php echo $row['Tipo_Documento']; ?></td>
				</tr>
				<tr>
					<th class="bg-dark">Nombres del empleado</th>
					<td><?php echo $row['Nombre'].' '.$row['Apellido_Paterno'].' '.$row['Apellido_Materno']; ?></td>
				</tr>
				<!-- <tr>
					<th class="bg-dark">Lugar y Fecha de Nacimiento</th>
					<td><?php echo $row['lugar_nacimiento'].', '.$row['fecha_nacimiento']; ?></td>
				</tr> -->
				<tr>
					<th class="bg-dark" width="20%">Sexo</th>
					<td><?php echo $row['Sexo']; ?></td>
				</tr>
				<tr>
					<th class="bg-dark">Dirección</th>
					<td><?php echo $row['Direccion']; ?></td>
				</tr>
				<tr>
					<th class="bg-dark">NroCelular</th>
					<td><?php echo $row['NroCelular']; ?></td>
				</tr>
				<tr>
					<th class="bg-dark">Teléfono de emergencia</th>
					<td><?php echo $row['Telefono_Emergencia']; ?></td>
				</tr>
				<tr>
					<th class="bg-dark">Correo Personal</th>
					<td><?php echo $row['Correo']; ?></td>
				</tr>
				<tr>
					<th class="bg-dark">Correo Institucional</th>
					<td><?php echo $row['Correo_Institucional']; ?></td>
				</tr>
				<tr>
					<th class="bg-dark">Numero de Seguro</th>
					<td><?php echo $row['Numero_Seguro']; ?></td>
				</tr>
				<tr>
					<th class="bg-dark">Turno</th>
					<td><?php echo $row['turno']; ?></td>
                </tr>
				<tr>
					<th class="bg-dark">Puesto</th>
					<td><?php echo $row['rol']; ?></td>
                </tr>
                <tr>
                    <th class="bg-dark">Inicio de Contrato</th>
                    <td><?php echo $row['Fecha_Inicio_Contrato']; ?></td>
                </tr>
                <tr>
                    <th class="bg-dark">Fin de Contrato</th>
                    <td><?php echo $row['Fecha_Fin_Contrato']; ?></td>
                </tr>
                <tr>
                    <th class="bg-dark">Fecha de Inscripcion</th>
                    <td><?php echo $row['Fecha_Inscripcion']; ?></td>
                </tr>
				
			</table>
            </div>
			<center>
			<!-- Regresar -->
			<a href="index.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Regresar</a>
			<!-- Editardatos -->
			<a href="editardatos.php?nik=<?php echo $row['Persona_ID']; ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos</a>
			<!-- Delete -->
			<a href="perfil.php?aksi=delete&nik=<?php echo $row['Persona_ID']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Esta seguro de borrar los datos <?php echo $row['nombres']; ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
            </center>
        </div>
    </div>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>