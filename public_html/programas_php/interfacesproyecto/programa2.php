<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

// LAs siguientes son líneas de código HTML simple, para crear una página web
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title> ULTIMOS datos medidos del dispositivo IoT
		  </title>
      <meta http-equiv="refresh" content="2" />
    </head>
    <body>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	 <tr>
         <td valign="top" align=center width=100& colspan=11 bgcolor="blue"">  
           <img src="img/bus.jpg" width=900 height=250>
         </td>
 	     </tr>
 	     <tr>
         <td valign="top" align=center width=100& colspan=11 bgcolor="blue"">
           <h1> <font color=white>Puestos disponibles del vehiculo # 1</font></h1>
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
            <b>Placa</b>
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
            <b>Ruta</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Fecha</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Hora</b>
         </td>
 	     </tr>
<?php
// la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
$sql1 = "SELECT * from datos_vehiculos order by id DESC LIMIT 15"; // Aquí se ingresa el valor recibido a la base de datos.
// la siguiente línea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexión a la base de datos mysqli
$result1 = $mysqli->query($sql1);
// la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
// tenga algún registro resultante. Como la consulta arroja 5 resultados, los últimos que tenga la tabla, se ejecutará 5 veces el siguiente ciclo while.
// el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, así sucesivamente
$contador = 0;
while($row1 = $result1->fetch_array(MYSQLI_NUM))
{

$contador++;
$ID_tarjeta = $row1[1];
$placa = $row1[2];
$libres = $row1[3];
$puesto_1 = $row1[4];
$puesto_2 = $row1[5];
$puesto_3 = $row1[6];
$puesto_4 = $row1[7];
$ruta = $row1[8];
$fecha = $row1[9];
$hora = $row1[10];
 
?>
    	 <tr>
         <td valign="top" align=center>
           <?php echo $contador; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $ID_tarjeta; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $placa; ?> 
         </td>
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
           <?php echo $ruta; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $fecha; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $hora; ?> 
         </td>
         
 	     </tr>
<?php
}
?>
     </body>
   </html>