<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.

$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

// CONSULTA TEMPERATURA MAXIMA
$sql3= "SELECT * from datos_maximos" ;
$result3 = $mysqli->query($sql3);
$row3 = $result3->fetch_array(MYSQLI_NUM);
$vel_maxima = $row3[2];  //valor: 7



//LO NUEVO: 28 DE NOV. ---------------------------------------
$long_vel_maxima= strlen($vel_maxima); // $long_vel_max= 1;
for ($i=$long_vel_maxima;  $i<2  ; $i++)
  {
    $vel_maxima = "0".$vel_maxima;   // Valor=07
  }
  

echo $vel_maxima;  // imrpime: 07   Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
//------------------------------------------------------------

?>
