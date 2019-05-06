

       <!-- Conexion -->
       <!DOCTYPE html>
       <html >
       <head>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="css/diseño.css">
       <link rel="stylesheet" href="css/style.css">
       <link rel="stylesheet" href="../Icons/style.css">
       <link rel="stylesheet" href="../Icons/icons-format.css">
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
       integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <style>
      td{color:white ;}
      </style>
</head>
<body background ="img/gym2.png">

      <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a class="navbar-brand visible-xs-block visible-sm-block" href="../index.html">
                     <span class="icon-view_compact"></span>
                     Inicio
            </a>
      </nav>

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
                }else {echo "";}
                $consulta= "select * from local ";
                $consulta1= "select * from equip_digitales ";
                $consulta2= "select * from maquinas ";

                mysqli_select_db ($con,"gym");
                
                $datos=mysqli_query ($con,$consulta);
                $datos1=mysqli_query ($con,$consulta1);
                $datos2=mysqli_query ($con,$consulta2);
                
                echo "
                <div class='container'>
                <table class='table table-striped table-bordered '> \n"; 
   echo "
   <h1 align ='center'> TABLA LOCAL </h1>
   <tr><th>ID</th>
   <th>Nombre</th>
   <th>Tipo</th>
   <th>Num_Pisos</th>
   </tr> 
   </div>
   \n"; 
   while ($fila=mysqli_fetch_array($datos)) { 
      echo "<tr><td>".$fila["Local_ID"]."</td><td>".$fila["Nombre"]."</td><td>".$fila["Tipo"]."</td><td>".$fila["Num_pisos"]."</td></tr> \n"; 
   }
   echo "</table> \n"; 
   echo "
   <div class='container'>
   <table class = 'table table-striped'> \n"; 
echo "
<h1 align ='center'> TABLA EQUIPOS DIGITALES </h1>
<tr><th>ID</th>
<th>Marca</th>
<th>NumSerie</th>
<th>Estado</th>
<th>Local</th>
</tr> 
</div>
\n"; 

while ($fila=mysqli_fetch_array($datos1)) { 
echo "<tr><td>".$fila["Equipo_ID"]."</td><td>".$fila["Marca"]."</td><td>".$fila["Numero_de_serie"]."</td><td>".$fila["Estado"]."</td><td>".$fila["Local_ID"]."</td></tr> \n"; 
}
echo "</table> \n"; 
echo "
         <div class='container'>       
<table class='table table-striped' > \n"; 
echo "
<h1 align ='center'> TABLA MAQUINAS </h1>
<tr><th>ID</th>
<th>Tipo</th>
<th>Fecha_Fabricacion</th>
<th>Num_Pisos</th>
<th>Local</th>
<th>Marca</th>
<th>Estado_actual</th>

</tr> 
</div>
\n"; 
while ($fila=mysqli_fetch_array($datos2)) { 
echo "<tr><td>".$fila["Maquinas_ID"]."</td><td>".$fila["Tipo"]."</td><td>".$fila["Fecha_de_fabricacion"]."</td><td>".$fila["Num_piso"]."</td>
<td>".$fila["Local_ID"]."</td>
<td>".$fila["Marca"]."</td>
<td>".$fila["Estado_actual"]."</td>

</tr> \n"; 
}
echo "</table> \n"; 
                ?>
<script src="js/jquery.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</body>                
</html>
    