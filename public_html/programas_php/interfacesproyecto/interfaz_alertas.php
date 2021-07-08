<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
// LAs siguientes son líneas de código HTML simple, para crear una página web

session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: /../../index.php?mensaje=4');
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title> ALERTAS
		  </title>
      <meta http-equiv="refresh" content="15" />
    </head>
    <body>
        
        <form method=POST action="InicialAdmin.php">                   
                    <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">   
                    </form>
        
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	 <tr>
         <td valign="top" align=center width=80% colspan=8 bgcolor="3377FF"">
           <img src="img/bus.jpg" width=800 height=250>
         </td>
 	     </tr>
 	     <tr>
         <td valign="top" align=center width=80% colspan=8 bgcolor="3377FF">
           <h1> <font color=white>Alertas Registradas</font></h1>
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
            <b>Velocidad Vehiculo (km/h)</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Velocidad Limite (km/h)</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Fecha</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Hora</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Alerta</b>
         </td>
      
         

 	     </tr>
<?php
// la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.

$sqlalertas= "SELECT * from alertas order by id DESC";
$resultalertas = $mysqli->query($sqlalertas);
$contador=0;
while($rowalertas = $resultalertas->fetch_array(MYSQLI_NUM))
{
    $id_vehiculo = $rowalertas[1];
    $velocidadveh = $rowalertas[2];
    $velocidadmax= $rowalertas[3];
    $fecha = $rowalertas[4];
    $hora = $rowalertas[5];
    $contador++;
    
 $sqlplaca= "SELECT placa from info_vehiculos WHERE id='$id_vehiculo' "; 
 $resultplaca = $mysqli->query($sqlplaca);
$rowplaca = $resultplaca->fetch_array(MYSQLI_NUM);
$placa = $rowplaca[0]; 
?>

	 <tr>
         <td valign="top" align=center>
           <?php echo $contador; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $placa; ?> 
         </td>
           <td valign="top" align=center>
           <?php echo $velocidadveh; ?> 
         </td>
             <td valign="top" align=center>
           <?php echo $velocidadmax; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $fecha; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $hora; ?> 
         </td>
         
         </td>
         <td valign="top" align=center>
         
        <img src="img/temp_alerta.jpg" width=80 height=80>           
       
         </td>
 	     </tr>
<?php
}
?>

     </body>
   </html>
   
   
   