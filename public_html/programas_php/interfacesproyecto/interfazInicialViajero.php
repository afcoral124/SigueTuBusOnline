<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

// LAs siguientes son líneas de código HTML simple, para crear una página web   <meta http-equiv="refresh" content="2" /> 
?>

<!DOCTYPE html>
<html>
<head>
      <title> Sigue tu bus!
		  </title>
     
     
    </head>
    
    
<body>

<h1>Seleccione la ruta:</h1>

<p>Seleccione el numero de ruta que desea consultar:</p>

<?php
//SE CONSULTA EN info_rutas LAS RUTAS QUE EXISTEN EN LA BASE DE DATOS
$sqlRutas= "SELECT id from info_rutas";
$resultRutas = $mysqli->query($sqlRutas);
$contadorRutas=0;
while($rowRutas = $resultRutas->fetch_array(MYSQLI_NUM))
{
    $vectorRutas[$contadorRutas]=$rowRutas[0];
    $contadorRutas++;    
}

$longitudRutas = count($vectorRutas);


?>
<!-- SE HACE EL FORMULARIO Y SE LLENA LA LISTA SEGUN LAS RUTAS ENCONTRADAS EN LA BD-------------------------------------------------------------------------------------- -->
<form method=POST action="interfazInicialViajero.php" >
  <label for="Rutas">Elige el numero de ruta:</label>
  <select name="Rutas" id="Rutas">
<?php
for($i=0; $i<$longitudRutas; $i++)
      {        
        $numRuta= $vectorRutas[$i];
?>  
        <option value=" <?php echo $numRuta ?>"> <?php echo $numRuta ?> </option>
<?php
      }
?>  

    
  </select>
  <br><br>
  <input type="hidden" name="enviado" value="S1">  
  <input type="submit" value="Consultar">
  </form>
<!-- ACABA EL FORMULARIO ----------------------------------------------------------------------------------------------------- -->

<!-- VERIFICACIÓN DE ENVÍO DEL FORMULARIO   ------------------------------------ -->
 <?php     
   if ((isset($_POST["enviado"])))  // Ingresa a este if si el formulario ha sido enviado..., al ingresar actualiza los datos ingresados en el formulario, en la base de datos.
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
?>    
  <br>
  La ruta escogida fue: 
  <?php echo $_POST["Rutas"]; 
  $rutaEscogida=  $_POST["Rutas"];
  ?>
  <br>
        <?php 
        
              //CONSULTAS A LA BASE DE DATOS
        
              //CONSULTA A info_vehiculos todos los vehículos que pertenezcan a la ruta escogida
              $sqlinfo_vehiculos = "SELECT * from info_vehiculos where id_Ruta=$rutaEscogida order by id DESC";
              $resultadoinfo_vehiculos = $mysqli->query($sqlinfo_vehiculos);
              
               //se verifica si existen vehiculos asignados a la ruta escogida por el viajero
              
              $totalFilas    =    mysqli_num_rows($resultadoinfo_vehiculos);
              if ($totalFilas == 0) {
              
              ?>
              <h2>Lo sentimos, no hay vehículos asociados a la ruta escogida :(</h2>
              <?php
              }
              
              
              //Si si existen vehiculos asignados a dicha ruta entonces se cejecuta el código que los imprime en pantalla:
              else
              {
                 
                      ?>
                      
                      <!-- CREACIÓN DE LA TABLA   ------------------------------------- -->   
                     <table width="80%" align=center cellpadding=3 border=1 bgcolor="#FFFFFF">
                  	 <tr>
                       <td valign="top" align=center width=100& colspan=10 bgcolor="3377FF"">  
                         <img src="img/bus.jpg" width=900 height=250>
                       </td>
               	     </tr>
               	     <tr>
                       <td valign="top" align=center width=100& colspan=10 bgcolor="3377FF"">
                         <h1> <font color=white>Informacion de vehiculos de la Ruta # <?php echo $rutaEscogida ?>  </font></h1>
                       </td>
               	     </tr>
                  	 <tr>
                       <td valign="top" align=center bgcolor="#E1E1E1">
                          <b>#</b>
                       </td>
                       <td valign="top" align=center bgcolor="#E1E1E1">
                          <b>Placa</b>
                       </td>
                       <td valign="top" align=center bgcolor="#E1E1E1">
                          <b>Ruta</b>
                       </td>
                       <td valign="top" align=center bgcolor="#E1E1E1">
                          <b>Puestos libres</b>
                       </td>
                       <td valign="top" align=center bgcolor="#E1E1E1">
                          <b>Estado puesto 1</b>
                       </td>
                       <td valign="top" align=center bgcolor="#E1E1E1">
                          <b>Estado puesto 2</b>
                       </td>
                       <td valign="top" align=center bgcolor="#E1E1E1">
                          <b>Estado puesto 3</b>
                       </td>
                       <td valign="top" align=center bgcolor="#E1E1E1">
                          <b>Estado puesto 4</b>
                       </td>
              
                       <td valign="top" align=center bgcolor="#E1E1E1">
                          <b>Ultimo registro</b>
                       </td>
    
               	     </tr>
                       
                   <?php    
                       // COMIENZA EL WHILE PARA CADA FILA EN LA INTERFAZ
                      $contador = 0;
                      while($rowinfo_vehiculos = $resultadoinfo_vehiculos->fetch_array(MYSQLI_NUM))
                      {
                      
                      //SE COMIENZA CAPTURANDO LOS VALORES DE info_vehiculos
                      $contador++;
                      
                      $id_vehiculo = $rowinfo_vehiculos[0];
                      $placa = $rowinfo_vehiculos[1];
                      $ruta = $rowinfo_vehiculos[2];
                      
               
                      //Primero se verifica que el vehículo este activo (habilitado) o inactivo (deshabilitado)
                      $estado_vehiculo=  $rowinfo_vehiculos[4];
                      if($estado_vehiculo=="habilitado")
                          {
                       
                    ?>
                    <!--   SE LLENAN PRIMERO LOS DATOS DE LA FILA QUE FUERON CONSULTADOS DE LA BD EN LA TABLA info_vehiculos -->
                            
                             <tr>
                             <td valign="top" align=center>
                               <?php echo $contador; ?> 
                             </td>
                             <td valign="top" align=center>
                               <?php echo $placa; ?> 
                             </td>
                             <td valign="top" align=center>
                               <?php echo $ruta; ?> 
                             </td>
                             
                    <!--   SE CONSULTA EN LA TABLA datos_vehiculos según el id_vehiculo capturado en esta fila -->         
                             <?php
                             $sqldatos_vehiculos = "SELECT * from datos_vehiculos where id_vehiculo=$id_vehiculo order by id DESC LIMIT 1";
                             $resultadodatos_vehiculos = $mysqli->query($sqldatos_vehiculos);
                             
                             while($rowdatos_vehiculos = $resultadodatos_vehiculos->fetch_array(MYSQLI_NUM))
                                    {
                                
                                 
                                      $libres = $rowdatos_vehiculos[2];
                                      $puesto_1 = $rowdatos_vehiculos[3];
                                      $puesto_2 = $rowdatos_vehiculos[4];
                                      $puesto_3 = $rowdatos_vehiculos[5];
                                      $puesto_4 = $rowdatos_vehiculos[6];
                                      $fecha = $rowdatos_vehiculos[7];
                                      $hora = $rowdatos_vehiculos[8];
                                       
                                      
                                
                             ?>
                             
                             
                             
                                     <!--   SE LLENA EL RESTO DE DATOS DE LA FILA QUE CORRESPONDE A LA TABLA DE LA BD datos_vehiculos -->  
                                     <td valign="top" align=center>
                                       <?php echo $libres; ?> 
                                     </td>
                                     <td valign="top" align=center>
                                       <?php echo $puesto_1; ?> 
                                     </td>
                                     <td valign="top" align=center>
                                       <?php echo $puesto_2; ?> 
                                     </td>
                                     <td valign="top" align=center>
                                       <?php echo $puesto_3; ?> 
                                     </td>
                                     <td valign="top" align=center>
                                       <?php echo $puesto_4; ?> 
                                     </td>
                                     <td valign="top" align=center>
                                       <?php echo $fecha;echo " / "; echo $hora;?> 
                                     </td>
                                     
                                     
                             	     </tr>
                       
         
<?php
                }
            }
        }
      }
    }
  }
  
?>  



</body>
</html>
