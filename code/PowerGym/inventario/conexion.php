

       <!-- Conexion -->
       <!DOCTYPE html>
       <html >
       <head>

</head>
<body>
                <?php
                // Direcion
                $db_host="localhost";
                // Usuario
                $db_user="root";
                // Contraseña
                $db_pass="";
                // Nombre de La Base de Datos
                $db_name="gimnasio";
                // Conexion
                $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                
                if(mysqli_connect_errno()){
                    echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
                }else {echo "se conecto correctamente";}
                $consulta= "select * from local ";
                $consulta1= "select * from equip_digitales ";
                $consulta2= "select * from maquinas ";

                mysqli_select_db ($con,"gym");
                
                $datos=mysqli_query ($con,$consulta);
                $datos1=mysqli_query ($con,$consulta1);
                $datos2=mysqli_query ($con,$consulta2);
                
                echo "
                
                <table border = '1'  style='margin: 0 auto;'> \n"; 
   echo "
   <h1 align ='center'> TABLA LOCAL </h1>
   <tr><td>ID</td>
   <td>Nombre</td>
   <td>Tipo</td>
   <td>Num_Pisos</td>
   </tr> \n"; 
   while ($fila=mysqli_fetch_array($datos)) { 
      echo "<tr><td>".$fila["Local_ID"]."</td><td>".$fila["Nombre"]."</td><td>".$fila["Tipo"]."</td><td>".$fila["Num_pisos"]."</td></tr> \n"; 
   }
   echo "</table> \n"; 
   echo "
                
   <table border = '1' style='margin: 0 auto;'> \n"; 
echo "
<h1 align ='center'> TABLA EQUIPOS DIGITALES </h1>
<tr><td>ID</td>
<td>Marca</td>
<td>NumSerie</td>
<td>Estado</td>
<td>Local</td>
</tr> \n"; 
while ($fila=mysqli_fetch_array($datos1)) { 
echo "<tr><td>".$fila["Equipo_ID"]."</td><td>".$fila["Marca"]."</td><td>".$fila["Numero_de_serie"]."</td><td>".$fila["Estado"]."</td><td>".$fila["Local_ID"]."</td></tr> \n"; 
}
echo "</table> \n"; 
echo "
                
<table border = '1' style='margin: 0 auto;'> \n"; 
echo "
<h1 align ='center'> TABLA MAQUINAS </h1>
<tr><td>ID</td>
<td>Tipo</td>
<td>Fecha_Fabricacion</td>
<td>Num_Pisos</td>
<td>Local</td>
<td>Marca</td>
<td>Estado_actual</td>
<td>Nombre</td>
</tr> \n"; 
while ($fila=mysqli_fetch_array($datos2)) { 
echo "<tr><td>".$fila["Maquinas_ID"]."</td><td>".$fila["Tipo"]."</td><td>".$fila["Fecha_de_fabricacion"]."</td><td>".$fila["Num_piso"]."</td>
<td>".$fila["Local_ID"]."</td>
<td>".$fila["Marca"]."</td>
<td>".$fila["Estado_actual"]."</td>
<td>Null</td>
</tr> \n"; 
}
echo "</table> \n"; 
                ?>
                
    
</body>                
</html>
    