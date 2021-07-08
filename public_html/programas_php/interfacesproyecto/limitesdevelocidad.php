<?php
include "conexion.php";  // Conexi?n tiene la informaci?n sobre la conexi?n de la base de datos.


session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: /../../index.php?mensaje=4');
    }
    
    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

  <html>
    <head>

      <title> Definir limites de velocidad
		  </title>
    </head>
    <body>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	 <tr>
         <td valign="top" align=center width=80& colspan=6 bgcolor="3377FF"">
           <img src="img/bus.jpg" width=800 height=250>
         </td>
 	     </tr>
 	     <tr>
         <td valign="top" align=center width=80& colspan=6 bgcolor="3377FF"">
           <h1> <font color=white>Limite de velocidad maxima</font></h1>
         </td>
 	     </tr>
<?php

 if ((isset($_POST["enviado"])))  // Ingresa a este if si el formulario ha sido enviado..., al ingresar actualiza los datos ingresados en el formulario, en la base de datos.
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
          $vel_max = $_POST["vel_max"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial

          $mysqli = new mysqli($host, $user, $pw, $db); // Aqu? se hace la conexi?n a la base de datos.
          // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. 
          // se actualiza la tabla de valores m?ximos
          $sql1 = "UPDATE datos_maximos set maximo='$vel_max' where id=1";  
          // la siguiente l?nea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexi?n a la base de datos mysqli
          $result1 = $mysqli->query($sql1);

       
          // la siguiente l?nea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexi?n a la base de datos mysqli
      

          if (($result1 == 1))
             $mensaje = "Datos actualizados correctamente";
          else
             $mensaje = "Inconveniente actualizando datos";
   
          header('Location:limitesdevelocidad.php?mensaje='.$mensaje);

    } // FIN DEL IF, si ya se han recibido los datos del formulario
   }  // FIN DEL IF, si la variable enviado existe, que es cuando ya se env?o el formulario
  


// CONSULTA VELOCIDAD MAXIMA
$mysqli = new mysqli($host, $user, $pw, $db); // Aqu? se hace la conexi?n a la base de datos.
$sql1 = "SELECT * from datos_maximos where id=1"; 
// la siguiente l?nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi?n a la base de datos mysqli
$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$vel_max = $row1[2];  



if ((isset($_GET["mensaje"])))
   {
   $mensaje = $_GET["mensaje"];
 	 echo '<tr>	
      		<td bgcolor="#EEEEFF" align=center colspan=2> 
			   	  <font FACE="arial" SIZE=2 color="#000044"> <b>'.$mensaje.'</b></font>  
				  </td>	
	     </tr>';
   }
?>    

     <form method=POST action="limitesdevelocidad.php">
 	     <tr>	
      		<td bgcolor="#94B7FC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#000044"> <b>Ingrese el limite de velocidad (km/h): </b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="number" name="vel_max" value="<?php echo $vel_max; ?>" required>  
          </td>	
	     </tr>
       <tr>	
				  <td bgcolor="#EEEEEE" align=center colspan=2> 
				    <input type="hidden" name="enviado" value="S1">  
				    <input type="submit" value="Guardar" name="Guardar">  
          </form>
         	
                  <br>
                  <form method="POST" action="InicialAdmin.php">
                  <input type=submit value="Volver" name="Volver"> 
                  </form>
            </td>  
	     </tr>
      	  
                                 
       </table>
     </body>
   </html>