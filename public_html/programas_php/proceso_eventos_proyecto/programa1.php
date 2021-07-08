<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.

$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
; // el dato de humedad que se recibe aquí con GET denominado humedad, es enviado como parametro en la solicitud que realiza la tarjeta microcontrolada
//$temp = $_GET["temperatura"]; // el dato de temperatura que se recibe aquí con GET denominado temperatura, es enviado como parametro en la solicitud que realiza la tarjeta microcontrolada
//$placa = $_GET["placa"];
//$ruta = 1;

$ID_tarjeta =$_GET["ID_tarjeta"];
$libres = $_GET["libres"];
$puesto_1 = $_GET["puesto_1"];
$puesto_2 = $_GET["puesto_2"];
$puesto_3 = $_GET["puesto_3"];
$puesto_4 = $_GET["puesto_4"];
$lon = $_GET["longitud"]; 
$lat = $_GET["latitud"]; 
$vel = $_GET["velocidad"]; 
$alt = $_GET["altitud"]; 

$sql1= "SELECT * from info_vehiculos WHERE ID_tarjeta = $ID_tarjeta" ;

$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_array(MYSQLI_NUM);

$id_vehiculo = $row1[0];  //NUEVOOOO

date_default_timezone_set('America/Bogota'); // esta línea es importante cuando el servidor es REMOTO y está ubicado en otros países como USA o Europa. Fija la hora de Colombia para que grabe correctamente el dato de fecha y hora con CURDATE y CURTIME, en la base de datos.
$fecha1= date("Y-m-d");
$hora1= date("h:i:s A");                //CAMBIOS AQUI:
$sql2 = "INSERT into datos_vehiculos (id_vehiculo, libres, puesto_1, puesto_2, puesto_3, puesto_4, fecha, hora, latitud, longitud, altitud, velocidad) VALUES ('$id_vehiculo', '$libres', '$puesto_1', '$puesto_2', '$puesto_3', '$puesto_4', '$fecha1', '$hora1', '$lat', '$lon','$alt', '$vel')"; // Aquí se ingresa el valor recibido a la base de datos.
//echo "sql2...".$sql2; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de algún error.
$result2 = $mysqli->query($sql2);
//echo "result es...".$result2; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.


$sql3= "SELECT maximo from datos_maximos" ;
$result3 = $mysqli->query($sql3);
$row3 = $result3->fetch_array(MYSQLI_NUM);
$vel_maxima = $row3[0]; //porque solo le busca la máxima (0)

if ($vel>$vel_maxima){
    $sql4 = "INSERT into alertas (id_vehiculo, velocidadVehiculo, velocidadLimite, fecha, hora) VALUES ('$id_vehiculo','$vel','$vel_maxima','$fecha1','$hora1')";
    echo "sql4...".$sql4; 
$result4 = $mysqli->query($sql4);
echo "result es...".$result4;
}




?>






