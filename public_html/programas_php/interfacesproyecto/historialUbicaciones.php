<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db);

session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: /../../index.php?mensaje=4');
    }



// LAs siguientes son líneas de código HTML simple, para crear una página web
// PROGRAMA DE MENU CONSULTA                                                 
   ?> 
     <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
            <style>
               #map {
                height: 500px;
                width: 90%;
               }
            </style>
           <title>Historial de Ubicaciones
           <meta http-equiv="refresh" content="15" />
           </title>
        </head>
       <body>
        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    	   <tr>
           <td valign="top" align=left width=70%>
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30%>
                     <img src="img/bus.jpg" border=0 width=350 height=120> 
             	    </td>
                  <td valign="top" align=center width=60%>
                     <h1><font color=blue>Consulta de historial de ubicaciones </font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <td valign="top" align=right>
             <!-- <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php  echo "Nombre Usuario</u>:   ".$_SESSION["nombre_usuario"];?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>  
              <font FACE="arial" SIZE=2 color="#00FFFF"> <b><u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></b></font>  
            -->    
           </td>
	     </tr>
     </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
<?php
include "menu_consul.php";
?>   
 	    <tr valign="top">
        <td height="20%" align="left" bgcolor="#FFFFFF" class="_espacio_celdas" style="color: #FFFFFF; font-weight: bold">
			    <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Consulta ubicaciones (por rango de fechas y horas)</h1></b></font>  

		       </td>
	          <td height="20%" align="right" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
			     
		       </td>
		     </tr>
<?php

if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
       $fecha_ini = $_POST["fecha_ini"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
       $fecha_fin = $_POST["fecha_fin"];
       $hora_ini= $_POST["hora_ini"];
       $hora_ini= date("h:i:s A", strtotime($hora_ini)); 
       $hora_fin= $_POST["hora_fin"];
       $hora_fin= date("h:i:s A", strtotime($hora_fin)); 
       $id_vehiculo= $_POST["Vehiculos"];
       $mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
       
       //Comienzan las sentencias sql:
       
       $sqlVehiculo = "SELECT * from info_vehiculos where id='$id_vehiculo'  ";
        $resultVehiculo = $mysqli ->query($sqlVehiculo);
        
        while($rowVehiculo = $resultVehiculo->fetch_array(MYSQLI_NUM))
        {
          $placa = $rowVehiculo[1];
          $ruta = $rowVehiculo[2];
          $ID_tarjeta = $rowVehiculo[3];
          $estado =$rowVehiculo[4];
          
          //segunda sentencia
          $i=0;
          $sqlHistorial = "SELECT * from datos_vehiculos where id_vehiculo='$id_vehiculo' and fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and hora >= '$hora_ini' and hora <= '$hora_fin' order by fecha";
          $resultHistorial = $mysqli ->query($sqlHistorial);
          
          //verificar si es vacío el resultado, es decir que no hay datos entre los rangos de tiempo consultados:
          
          $totalFilas    =    mysqli_num_rows($resultHistorial);
              if ($totalFilas == 0) {
              ?>
              <h2>    <font color=red> Lo sentimos, no se encontraron datos en ese rango de tiempo :( <font> </h2>
              <h2>    <font color=red> Inténtelo de nuevo. <font> </h2>
              <?php
              }

              //Si si existen datos en el rango entonces:
              else
              { 
                   
          
                      while($rowHistorial = $resultHistorial->fetch_array(MYSQLI_NUM))
                        {
                               $fecha[$i] = $rowHistorial[7];
                               $hora[$i] = $rowHistorial[8];
                               $latitud[$i] = $rowHistorial[9];
                               $longitud1[$i] = $rowHistorial[10];
                               $altitud[$i] = $rowHistorial[11];
                               $velocidad[$i] = $rowHistorial[12];
                               $arreglolibres[$i]=$rowHistorial[2];
                               $i++;
                        }       
                      
                }
        }    
       
?>  
    <!-- CODIGO MAPA INICIO ---------------------------------------------------------------------------- -->
    <?php
    //verificar si es vacío el resultado, es decir que no hay datos entre los rangos de tiempo consultados:
          
          $totalFilas    =    mysqli_num_rows($resultHistorial);
              if ($totalFilas == 0) {
             
              }

              //Si si existen datos en el rango entonces:
              else
              { 
                ?>
    
     <h3>Rango de fechas consultado: desde <?php echo $fecha_ini; ?> hasta <?php echo $fecha_fin; ?> </h3>
     <h3>Rango de horas consultado: desde <?php echo $hora_ini; ?> hasta <?php echo $hora_fin; ?> </h3>
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
            icon: myicons + 'antonio2.png'
          }
        };
        <?php 
            for ($w=0;$w<$i;$w++)
                {   //echo $placa;
        ?>          latit= <?php echo $latitud[$w] ?>+0.0009;
                    longi= <?php echo $longitud1[$w] ?>;
                    uluru = {lat: latit, lng: longi};
                    var infowindow = new google.maps.InfoWindow({
                    content: ' Ruta: ' + <?php echo $ruta;?> + '<br> Placa: <?php echo $placa   ;?>' +  '<br> Puestos libres: ' + <?php echo $arreglolibres[$w];?> + ' <br> <?php echo $fecha[$w]   ;?>' + ' <br> <?php echo $hora[$w]   ;?>' + '<br> Velocidad:'+ <?php echo $velocidad[$w];?> + ' km/h' , 
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
    
    <?php
              }
              ?>
    
    <!-- CODIGO MAPA FINAL ---------------------------------------------------------------------------- -->
    </table>
      
      <tr>	
        <form method=POST action="historialUbicaciones.php">
				  <td bgcolor="#EEEEEE" align=center colspan=6> 
				    <input type="submit" value="Volver" name="Volver">  
          </td>	
        </form>	
       </tr>
   </table>
<?php
    } // FIN DEL IF, si ya se han recibido las fechas del formulario
   }  // FIN DEL IF, si la variable enviado existe, que es cuando ya se envío el formulario
  else
    {
?>    
    	 
    <table width="70%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
     <form method=POST action="historialUbicaciones.php">
 	     <tr>	
      		<td bgcolor="#3377FF" align=center> 
			   	  <font FACE="arial" SIZE=2 color=white> <b>Fecha Inicial:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="date" name="fecha_ini" value="" required>  
          </td>	
	     </tr>
 	     <tr>	
      		<td bgcolor="#3377FF" align=center> 
			   	  <font FACE="arial" SIZE=2 color=white> <b>Fecha Final:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="date" name="fecha_fin" value="" required>  
          </td>
	     </tr>
	     <tr>	
      		<td bgcolor="#3377FF" align=center> 
			   	  <font FACE="arial" SIZE=2 color=white> <b>Hora Inicial:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="time" name="hora_ini" value="" required>  
            </td>
	     </tr>
	     <tr>	
      		<td bgcolor="#3377FF" align=center> 
			   	  <font FACE="arial" SIZE=2 color=white> <b>Hora Final:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="time" name="hora_fin" value="" required>  
          </td>
	     </tr>
	     <tr>
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Vehiculo:</b></font>  
				</td> 	
				<td bgcolor="#EEEEEE" align=center> 
                <?php
             
//SE CONSULTA EN info_rutas LAS RUTAS QUE EXISTEN EN LA BASE DE DATOS
$sqlVehiculos= "SELECT * from info_vehiculos";
$resultVehiculos = $mysqli->query($sqlVehiculos);
$contadorVehiculos=0;
while($rowVehiculos = $resultVehiculos->fetch_array(MYSQLI_NUM))
{
    $vectorIds[$contadorVehiculos]=$rowVehiculos[0];
    $vectorPlacas[$contadorVehiculos]=$rowVehiculos[1];
    $contadorVehiculos++;
}

$longitudVehiculos = count($vectorIds);



?>
                <select name="Vehiculos" id="Vehiculos">
         <?php
              for($i=0; $i<$longitudVehiculos; $i++)
      {        
        $idActual= $vectorIds[$i];
        $placaActual=$vectorPlacas[$i];
        ?>  
        <option value=" <?php echo $idActual ?>"> <?php echo "id:"; echo $idActual; echo " | "; echo "Placa:" ;echo $placaActual  ?> </option>
<?php
      }
      
?>  
        </select>
				</td>	
			     </tr>
       <tr>	
				  <td bgcolor="#EEEEEE" align=center colspan=2> 
				    <input type="hidden" name="enviado" value="S1">  
				    <input type="submit" value="Consultar" name="Consultar">
				    </form>
          
                    <form method=POST action="InicialAdmin.php">                   
                    <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">   
                    </form> 
          </td>	
	     </tr>
      	  

<?php
    } 
?>    


       </table>
      <hr><br><br> 
     </body>
   </html>