<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.

session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: /../../index.php?mensaje=4');
    }




$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.




// LAs siguientes son líneas de código HTML simple, para crear una página web
// tiempo de refresco de la pagina 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
        	<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
      <title> Estado actual vehiculos
		  </title>
   <!--   <meta http-equiv="refresh" content="10" /> -->
    </head>
    <body>
      <table border=0 width=100%>
       <tr> <td align=left>
         
                  <form method="POST" action="gestion_administradores.php">
                  <input type=submit value="Gestionar Administradores" name="Gestionar Administradores"> 
                  </form>
        
             </td> 
             <td align=left>
                  <form method="POST" action="gestion_vehiculos.php">
                  <input type=submit value="Gestionar Vehiculos" name="Gestionar Vehiculos"> 
                  </form>
             </td>
             <td align=left>
                  <form method="POST" action="limitesdevelocidad.php">
                  <input type=submit value="Limites de Velocidad" name="Limites de Velocidad"> 
                  </form>
             </td>
             <td align=left>
                  <form method="POST" action="interfaz_alertas.php">
                  <input type=submit value="Consultar Alertas" name="Consultar Alertas"> 
                  </form>
             </td>
              <td align=left>
                  <form method="POST" action="historialUbicaciones.php">
                  <input type=submit value="Historial de Ubicaciones" name="Historial de Ubicaciones"> 
                  </form>
             </td>
              <td align=left>
                  <form method="POST" action="../../index.php">
                  <input type=submit value="Cerrar Sesion" name="Cerrar Sesion"> 
                  </form>
             </td>
             </table>
             <br>
      
      <table width="100%" align=center cellpadding=2 border=1 bgcolor="#FFFFFF">
    	 <tr>
         <td valign="top" align=center width=1000& colspan=11 bgcolor="3377FF"">  
           <img src="img/bus.jpg" width=900 height=250>
         </td>
 	     </tr>
 	     <tr>
         <td valign="top" align=center width=1000& colspan=11 bgcolor="3377FF"">
           <h1> <font color=white>Estado de los vehiculos </font></h1>
           <div id="seccionRecargar"></div>
           
           
         </td>
 	     </tr>
 	     
 	   
      </table>
     </body>
   </html>
   
   
   <script type="text/javascript">
	$(document).ready(function(){
		setInterval(
				function(){
					$('#seccionRecargar').load('interfaz_GPS_admin.php');
				},10000
			);
	});
</script>
   
   