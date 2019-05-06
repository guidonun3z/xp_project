<?php

include 'conexion.php'

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- LINKS DE BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- LINKS DE CSS -->
    <link rel="stylesheet" href="../../Icons/icons-format.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/lista.css">
    <link rel="stylesheet" href="../../icons/style.css">
    <title>Lista de invitados</title>
</head>
<body>
   
    <!-- Barra de Navegacion -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
	    <a class="navbar-brand visible-xs-block visible-sm-block" href="../../index.html">
            <span class="icon-view_compact"></span>
            Inicio
        </a>

        <a class="navbar-brand visible-xs-block visible-sm-block" href="../index.html">
            <span class="icon-person_add"></span>
            Registrar Invitado
        </a>

        <a class="navbar-brand" href="#">
             <span class="icon-person_list"></span>
             Lista De Invitados
        </a>
    </nav>
	<div class="sideback"></div>
    <div class="container">
        <div class="content">
            <h2>Lista de Invitados</h2>
            <hr/>
            <?php
            
			if(isset($_GET['aksi'])=='delete'){
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM Persona WHERE Persona_ID='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "call EliminarInvitado('$nik')");
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
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>Nro</th>
                    <th>ID</th>
					<th>Nombre</th>
					<th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Numero de documento</th>
					<th>Fecha de nacimiento</th>
					<th>Sexo</th>
					<th>Numero de Celular</th>
					<th>Correo</th>
					<th>Fecha Inscripcion</th>
                    <th>===Acciones===</th>
				</tr>
				<?php
                //Consulta}
                //Filtros
                $statement = mysqli_query($con,"call ListarInvitados");

				if($row_cont=0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_row($statement)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row[0].'</td>
							<td>'.$row[1].'</td>
                            <td>'.$row[2].'</td>
                            <td>'.$row[3].'</td>
							<td>'.$row[4].'</td>
							<td>'.$row[5].'</td>
							<td>'.$row[6].'</td>
							<td>'.$row[7].'</td>
							<td>'.$row[8].'</td>
							<td>'.$row[9].'</td>
							<td>
 
								<a href="editardatos.php?nik='.$row[0].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true">Editar</span></a>
								<a href="lista.php?aksi=delete&nik='.$row[0].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos de '.$row[1].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true">Eliminar</span></a>
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

    
</body>
</html>