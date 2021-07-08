<!DOCTYPE html>
<html>
  <head>
     <!-- <meta http-equiv="refresh" content="5" /> -->
    <style>
       #map {
        height: 500px;
        width: 90%;
       }
    </style>
  </head>
  <body>
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
        $sql3 = "SELECT * from info_vehiculos where id='$idactual'  ";
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
                   $hora[$i] = $rowveh[8];
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

      var latit= <?php echo $latitud[1] ?>+0.0009;
      var longi= <?php echo $longitud1[1] ?>;
      var uluru = {lat: latit, lng: longi};
      var uluruAux = {lat: latit, lng: longi};
    
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
                    uluruAux = {lat: latit, lng: longi};
                    var infowindow = new google.maps.InfoWindow({
                    content: ' Ruta: ' + <?php echo $arreglorutas[$w];?> + '<br> Placa: <?php echo $arregloplacas[$w]   ;?>' +  '<br> Puestos libres: ' + <?php echo $arreglolibres[$w];?> + ' <br> <?php echo $hora[$w]   ;?>', 
                    position: uluruAux
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
       var infowindow = new google.maps.InfoWindow({
                    content: ' Ruta: ' + <?php echo $arreglorutas[1];?> + '<br> Placa: <?php echo $arregloplacas[1]   ;?>' +  '<br> Puestos libres: ' + <?php echo $arreglolibres[1];?> + ' <br> <?php echo $hora[1]   ;?>', 
                    position: uluru
                    });
                    infowindow.open(map);

}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg96Eu8Snrh4j2ONzvvEEycqHMnSFrbBo&callback=initMap">  <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->
    </script>
  </body>
</html>
