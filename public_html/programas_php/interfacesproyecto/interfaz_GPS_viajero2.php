<!DOCTYPE html>
<html>
  <head>
     
    <style>
       #map {
        height: 500px;
        width: 90%;
       }
    </style>
  </head>
  <body>
 <?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

// LAs siguientes son líneas de código HTML simple, para crear una página web   <meta http-equiv="refresh" content="2" /> 
?>         
          <h1> <font color=blue size= 20> Seleccione la ruta:</font> </h1>

     <font color=blue size= 5> Seleccione el numero de ruta que desea consultar:</font>

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
<form method=POST action="interfaz_GPS_viajero2.php" >
  <label for="Rutas"> <font color=blue size= 5> Elige el numero de ruta:</font></label>
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
  <br>
  <form method=POST action="/../../index.php">                   
                  <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">              
                  </form> 
      
      
<!--  <div>
       
    <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    <tr>
         <td valign="top" align=center width=100& colspan=11 bgcolor="blue"">  
           
         </td>
      </tr>
      <tr>
         <td valign="top" align=center width=100& colspan=11 bgcolor="blue"">
           <h1> <font color=white>Ultima ubicacion de los vehiculos.</font></h1>
         </td>
      </tr>
    <tr>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>#</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>ID_tarjeta</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Latitud</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Longitud</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Altitud</b>
         </td>
         
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Velocidad</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Fecha</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Hora</b>
         </td>
         
   </div>
-->

<?php     
   if ((isset($_POST["enviado"])))  // Ingresa a este if si el formulario ha sido enviado..., al ingresar actualiza los datos ingresados en el formulario, en la base de datos.
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
?>    
  <br>
    
     <font color=blue size=5>  La ruta escogida fue:  # <?php echo $_POST["Rutas"]; 
     $rutaEscogida=  $_POST["Rutas"];?>  </font>
 
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
              <h2>    <font color=red> Lo sentimos, no hay vehículos asociados a la ruta escogida :( <font> </h2>
              <?php
              }

              //Si si existen vehiculos asignados a dicha ruta entonces se cejecuta el código siguiente:
              else
              { 
                  ?>      
                        
                      <!-- CREACIÓN DE LA TABLA   ------------------------------------- -->   
                     <table width="80%" align=center cellpadding=3 border=1 bgcolor="#FFFFFF">
                  
               	     <tr>
                       <td valign="top" align=center width=100& colspan=10 bgcolor="162D5D"">
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
                        
                        
                        $i=0;
                        $contador=0;
                        //Desde aquí pegamos
                        $sql2 = "SELECT id from info_vehiculos where estado='habilitado' and id_Ruta=$rutaEscogida";
                        $result2 = $mysqli ->query($sql2);
                        
                        //COMIENZA A LLENARSE LA TABLA DE LA INTERFAZ CON LA PRIMERA CONSULTA
                        $contador2=0;
                        while($row2 = $result2->fetch_array(MYSQLI_NUM))
                        {
                        $ids[$contador2]=$row2[0];
                        $contador2++;
                        }
                        
                        
                        $longitud = count($ids);
                        $contador4=0;
                         //Recorro todos los elementos
                        for($y=0; $y<$longitud; $y++)
                              {
                                $idactual=$ids[$i];      
                                $sql3 = "SELECT * from info_vehiculos where id='$idactual' ";
                                $result3 = $mysqli ->query($sql3);
                                
                                while($row3 = $result3->fetch_array(MYSQLI_NUM))
                                {
                                  $contador4++;
                                  
                                  
                                  $ID_tarjeta = $row3[3];
                                  $placa = $row3[1];
                                  $arregloplacas[$y]=$row3[1];
                                  //echo $placa;
                                  $ruta = $row3[2];
                                  $arreglorutas[$y]=$row3[2];
                                  $estado =$row3[4]; 
                                  ?>
                                  <!--
                              	 <tr>
                                   <td valign="top" align=center>
                                     <?php echo $contador4; ?> 
                                   </td>
                                   <td valign="top" align=center>
                                     <?php echo $ID_tarjeta; ?> 
                                   </td>
                                   <td valign="top" align=center>
                                     <?php echo $placa; ?> 
                                   </td>
                                   <td valign="top" align=center>
                                     <?php echo $ruta; ?> 
                                   </td>
                                   <td valign="top" align=center>
                                     <?php echo $estado; ?> 
                                   </td>
                                   -->
                                   <?php
                                   
                                   $sql4 = "SELECT * from datos_vehiculos where id_vehiculo='$idactual' order by id DESC LIMIT 1";
                                   $result4 = $mysqli ->query($sql4);
                                    while($rowveh = $result4->fetch_array(MYSQLI_NUM))
                                    {
                                      
                                          $contador++;
                                          
                                           $latitudActual= $rowveh[9];
                                           
                                           $longitudActual=$rowveh[10];
                                           
                                           $altitudActual = $rowveh[11];
                                           
                                           $fechaActual = $rowveh[7];
                                           
                                           $horaActual = $rowveh[8];
                                           
                                           $id_vehiculoActual = $rowveh[1];
                                           
                                           $velocidadActual = $rowveh[12];
                                           $latitud[$i] = $rowveh[9];
                                           $longitud1[$i] = $rowveh[10];
                                           $altitud[$i] = $rowveh[11];
                                           $fecha[$i] = $rowveh[7];
                                           
                                           $horanueva[$i] = $rowveh[8];
                                           $id_vehiculo[$i] = $rowveh[1];
                                           $velocidad[$i] = $rowveh[12];
                                           $arreglolibres[$y]=$rowveh[2];
                                           
                                           ?>
                            <!--
                                            <tr>
                                 <td valign="top" align=center>
                                   <?php echo $contador; ?>
                                 </td>
                                  <td valign="top" align=center>
                                   <?php echo $id_vehiculoActual; ?>
                                 </td>
                                 
                                 <td valign="top" align=center>
                                   <?php echo $latitudActual; ?>
                                 </td>
                                 <td valign="top" align=center>
                                   <?php echo $longitudActual; ?>
                                 </td>
                                 <td valign="top" align=center>
                                   <?php echo $altitudActual; ?>
                                 </td>
                                 <td valign="top" align=center>
                                   <?php echo $velocidadActual; ?>
                                 </td>
                                 <td valign="top" align=center>
                                   <?php echo $fechaActual; ?>
                                 </td>
                                 <td valign="top" align=center>
                                   <?php echo $horaActual; ?>
                                 </td>
                          </tr>
                                           
                        -->            
                                 
                                 <?php
                                    }
                               
                                            
                                    
                                }
                                
                               
                                $i++;
                                       
                              } 
                 
                 
                 
                 
              }     
                      ?>





<?php
}
}

else{


include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
//$sqlubi = "SELECT * from datos_vehiculos order by id DESC LIMIT 3"; //CONSULTA LAS ULTIMAS 100 UBICACIONES DE LA TABLA DE LA BASE DE DATOS
//$resultubi = $mysqli->query($sqlubi);
$i=0;
$contador=0;    

//Desde aquí pegamos
$sql2 = "SELECT id from info_vehiculos where estado='habilitado'";
$result2 = $mysqli ->query($sql2);

//COMIENZA A LLENARSE LA TABLA DE LA INTERFAZ CON LA PRIMERA CONSULTA
$contador2=0;
while($row2 = $result2->fetch_array(MYSQLI_NUM))
{
$ids[$contador2]=$row2[0];
$contador2++;
}


$longitud = count($ids);
$contador4=0;
 //Recorro todos los elementos
for($y=0; $y<$longitud; $y++)
      {
        $idactual=$ids[$i];      
        $sql3 = "SELECT * from info_vehiculos where id='$idactual' ";
        $result3 = $mysqli ->query($sql3);
        
        while($row3 = $result3->fetch_array(MYSQLI_NUM))
        {
          $contador4++;
          
          
          $ID_tarjeta = $row3[3];
          $placa = $row3[1];
          $arregloplacas[$y]=$row3[1];
          //echo $placa;
          $ruta = $row3[2];
          $arreglorutas[$y]=$row3[2];
          $estado =$row3[4]; 
          ?>
          <!--
      	 <tr>
           <td valign="top" align=center>
             <?php echo $contador4; ?> 
           </td>
           <td valign="top" align=center>
             <?php echo $ID_tarjeta; ?> 
           </td>
           <td valign="top" align=center>
             <?php echo $placa; ?> 
           </td>
           <td valign="top" align=center>
             <?php echo $ruta; ?> 
           </td>
           <td valign="top" align=center>
             <?php echo $estado; ?> 
           </td>
           -->
           <?php
           
           $sql4 = "SELECT * from datos_vehiculos where id_vehiculo='$idactual' order by id DESC LIMIT 1";
           $result4 = $mysqli ->query($sql4);
            while($rowveh = $result4->fetch_array(MYSQLI_NUM))
            {
              
                  $contador++;
                  
                   $latitudActual= $rowveh[9];
                   
                   $longitudActual=$rowveh[10];
                   
                   $altitudActual = $rowveh[11];
                   
                   $fechaActual = $rowveh[7];
                   
                   $horaActual = $rowveh[8];
                   
                   $id_vehiculoActual = $rowveh[1];
                   
                   $velocidadActual = $rowveh[12];
                   $latitud[$i] = $rowveh[9];
                   $longitud1[$i] = $rowveh[10];
                   $altitud[$i] = $rowveh[11];
                   $fecha[$i] = $rowveh[7];
                   $horanueva[$i] = $rowveh[8];
                   $id_vehiculo[$i] = $rowveh[1];
                   $velocidad[$i] = $rowveh[12];
                   $arreglolibres[$y]=$rowveh[2];
                  // echo $longitud1[$i];
                   ?>
    <!--
                    <tr>
         <td valign="top" align=center>
           <?php echo $contador; ?>
         </td>
          <td valign="top" align=center>
           <?php echo $id_vehiculoActual; ?>
         </td>
         
         <td valign="top" align=center>
           <?php echo $latitudActual; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $longitudActual; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $altitudActual; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $velocidadActual; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $fechaActual; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $horaActual; ?>
         </td>
  </tr>
                   
-->            
         
         <?php
            }
       
                    
            
        }
        
       
        $i++;
               
      }
}
//hasta aquí pegamos
 // echo $latitud[$i-1];
  $longitudAux=$altitud[$i-1];
?>   

    
     <h3>ULTIMAS UBICACIONES REGISTRADAS</h3>
    <div id="map">
    </div>
    <script>
      var map;

      // ALMACENA EN VARIABLES LA UBICACION INICIAL Y FINAL

      var latit= <?php echo $latitud[0] ?>;
      var longi= <?php echo $longitud1[0] ?>;
      var uluru = {lat: latit, lng: longi};

      var latitk= <?php echo $latitud[$i-1] ?>;
      var longik= <?php echo $longitud1[$i-1] ?>;
      var uluruk = {lat: latitk, lng: longik};

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: uluru,
          mapTypeId: 'roadmap'                                                                 
        });
        // LAS UBICACIONES LAS LOCALIZA UTILIZANDO UN ICONO DEFINIDO (CUADRO AZUL), UBICADO EN LA SUBCARPETA ICONS, DENOMINADO ubicacion.png

        //var myicons = 'http://localhost/pruebas_MAPS/icons/';
        var myicons = 'http://siguetubus.online/programas_php/interfacesproyecto/img/';
        var icons = {
          ubicacion: {
            icon: myicons + 'antonio.png'
          }
        };
        <?php 
            for ($w=0;$w<$i;$w++)
                {   //echo $placa;
        ?>          latit= <?php echo $latitud[$w] ?>+0.0009;
                    longi= <?php echo $longitud1[$w] ?>;
                    uluru = {lat: latit, lng: longi};
                    var infowindow = new google.maps.InfoWindow({
                    content: ' Ruta: ' + <?php echo $arreglorutas[$w];?> + '<br> Placa: <?php echo $arregloplacas[$w]   ;?>' +  '<br> Puestos libres: ' + <?php echo $arreglolibres[$w];?> + ' <br> <?php echo $horanueva[$w]   ;?>', 
                    position: uluru
                    });
                    infowindow.open(map);
                <?php 
                }
                ?>
              
                
        // GUARDA EN UN ARREGLO FEATURES LOS PUNTOS DE UBICACION
        var features = [
           <?php
             for ($k=0;$k<$i;$k++)
               {
           ?>    
           {
            position: new google.maps.LatLng(<?php echo $latitud[$k];?>, <?php echo $longitud1[$k];?>),
            type: 'ubicacion'
            
           },
           <?php
              }
           ?>    
          {
            position: new google.maps.LatLng(<?php echo $latitud[$k-1];?>, <?php echo $longitud1[$k-1];?>),
            type: 'ubicacion'
          }
        ];

        // CREA LOS MARCADORES Y LOS PRESENTA EN EL MAPA
        features.forEach(function(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
          });
        });

      // PRESENTA TAMBIEN UN MENSAJE EMERGENTE PARA LA UBICACION INICIAL Y LA FINAL.

}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg96Eu8Snrh4j2ONzvvEEycqHMnSFrbBo&callback=initMap">  <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->
    </script>
  </body>
</html>
