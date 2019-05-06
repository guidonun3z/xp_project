<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Empleados</title>

	<!-- css -->
	<link rel="stylesheet" href="../Icons/icons-format.css">
    <link rel="stylesheet" href="../Icons/style.css">
	<link rel="stylesheet" type="text/css" href="css/fondo.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
		.content {
			margin-top: 80px;
		}
		
	</style>
</head>
<body>
	<div class="bg-image" >
	</div>
	
	<div class="bg-text"">
		<div class="container">
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav ">
					<li class="active"><a href="index.php">Lista de empleados</a></li>
					<li><a href="agregardatos.php">Agregar datos</a></li>
				</ul>
			</div>
    </div>
    <!-- Barra de Navegacion -->
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
        <div class="content">
            <h2>Lista de Empleados</h2>
            <hr/>
            <?php
            
			if(isset($_GET['aksi'])=='delete'){
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM rolespersona WHERE Persona_ID='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "DELETE FROM rolespersona WHERE Persona_ID='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
            }
            //Filtro-Empleados
			?>
			
			<br />
			<div class="table-wrapper-scroll-y my-custom-scrollbar">
			<table class="table table-hover">
			<!-- Columnas -->
				<tr>
                    <th class="bg-dark">N°</th>
					<th class="bg-dark">Codigo</th>
					<th class="bg-dark">N°Documento</th>
					<th class="bg-dark">Nombres</th>
					<!-- Apellidos -->
					<th class="bg-dark">Apellido Paterno</th>
					<th class="bg-dark">Apellido Materno</th>
                    <!-- <th class="bg-dark">Lugar de nacimiento</th> -->
                    <th class="bg-dark">Fecha de nacimiento</th>
					<th class="bg-dark">Teléfono</th>
					<th class="bg-dark">Cargo</th>
                    <th class="bg-dark">|____Acciones____|</th>
				</tr>
				<?php
                //Consulta}
				//Filtros
				
                $res;
                $consulta="SELECT p.Persona_ID,p.Numero_Documento,p.Tipo_Documento,p.Nombre,p.Apellido_Paterno,p.Apellido_Materno,p.NroCelular,p.Fecha_Nacimiento,r.Nombre AS rol
				FROM persona p
				JOIN rolespersona rp
				ON p.Persona_ID=rp.Persona_ID
				JOIN roles r
				ON r.Rol_ID=rp.Rol_ID
				JOIN turno t
				ON t.Turno_ID=rp.Turno_ID
				WHERE r.Rol_ID=3 OR r.Rol_ID=4 OR r.Rol_ID=5 OR r.Rol_ID=6
				";
                $res=$con->query($consulta);
				if($row_cont=0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					// filas
					while($row = $res->fetch_assoc()){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['Persona_ID'].'</td>
							<td>'.$row['Numero_Documento'].'</td>
							<td><a href="perfil.php?nik='.$row['Persona_ID'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['Nombre'].'</a></td>
							<td>'.$row['Apellido_Paterno'].'</td>
							<td>'.$row['Apellido_Materno'].'</td>
                            
                            <td>'.$row['Fecha_Nacimiento'].'</td>
							<td>'.$row['NroCelular'].'</td>
                            <td>'.$row['rol'].'</td>
							<td>
								
								<a href="editardatos.php?nik='.$row['Persona_ID'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true">Editar</span></a>
								<a href="index.php?aksi=delete&nik='.$row['Persona_ID'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['Nombre'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true">Eliminar</span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div><center>
	<p>&copy; PowerGym <?php echo date("Y");?></p
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
        </div>
    </div>

	</div>
    
</body>
</html>