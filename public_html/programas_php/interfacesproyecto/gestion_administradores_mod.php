<?php

// PROGRAMA DE MENU ADMINISTRADORES
include "conexion.php";
$mysqli = new mysqli($host, $user, $pw, $db);


session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: /../../index.php?mensaje=4');
    }


?>


    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
          <link rel="stylesheet" href="css/estilos_virtual.css" 			type="text/css">
           <title> Gestion Administradores</title>
        </head>
       <body>
        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    	   <tr>
       
           <td valign="top" align=left>
               <img src="img/bus.jpg" border=0 width=350 height=120> 
           </td>
           <td valign="top" align=right>
           <!--    <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php // echo "Nombre Usuario</u>:   ".$_SESSION["nombre_usuario"];?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php // echo "Tipo Usuario</u>:   ".$_SESSION["tipo_usuario"];?> </b></font><br>  
              <font FACE="arial" SIZE=2 color="#00FFFF"> <b><u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></b></font>    -->

           </td>
	     </tr>
<?php


if ((isset($_POST["enviado"])))
  {
  
    /*
   //echo "grabar cambios modificación";
   $id_usu_enc = $_POST["id_usu"];
   $nombre_usuario = $_POST["nombre_usuario"];
   $nombre_usuario = str_replace("ñ","n",$nombre_usuario);
   $nombre_usuario = str_replace("Ñ","N",$nombre_usuario);
   $num_id = $_POST["num_id"];
   $tipo_usuario = $_POST["tipo_usuario"];
   $direccion = $_POST["direccion"];
   $activo = $_POST["activo"];
   $password = $_POST["password"];
   $id_tarjeta = $_POST["id_tarjeta"];
   $login = $_POST["login"];
   */
  
  
   $nombre = $_POST["nombre"];
   $cedula =  $_POST["cedula"];
   $estado =  $_POST["estado"];
   $login =  $_POST["login"];
   $password =  $_POST["password"];
   $id_admin_enc = $_POST["id_admin"];
   
 
   
   $mysqli = new mysqli($host, $user, $pw, $db);
   
   $sqlu1 = "UPDATE info_administradores set nombre_completo='$nombre' where id='$id_admin_enc'"; 
   $resultsqlu1 = $mysqli->query($sqlu1);
   $sqlu2 = "UPDATE info_administradores set cedula='$cedula' where id='$id_admin_enc'"; 
   $resultsqlu2 = $mysqli->query($sqlu2);
   $sqlu3 = "UPDATE info_administradores set estado='$estado' where id='$id_admin_enc'"; 
   $resultsqlu3 = $mysqli->query($sqlu3);
   $sqlu4 = "UPDATE info_administradores set login='$login' where id='$id_admin_enc'"; 
   $resultsqlu4 = $mysqli->query($sqlu4);

   
   if ($password != "")
     {
     $password = md5($password);
     $sqlu5 = "UPDATE info_administradores set passwd='$password' where id='$id_admin_enc'"; 
     $resultsqlu5 = $mysqli->query($sqlu5);
     }
   else
     {
      $resultsqlu5=1;
     }
   
     /*
	 $sqlu1 = "UPDATE usuarios set nombre_completo='$nombre_usuario' where id='$id_usu_enc'"; 
   $resultsqlu1 = $mysqli->query($sqlu1);
	 $sqlu2 = "UPDATE usuarios set login='$login' where id='$id_usu_enc'"; 
   $resultsqlu2 = $mysqli->query($sqlu2);
   $sqlu3 = "UPDATE usuarios set identificacion='$num_id' where id='$id_usu_enc'"; 
   $resultsqlu3 = $mysqli->query($sqlu3);
   $sqlu4 = "UPDATE usuarios set tipo_usuario='$tipo_usuario' where id='$id_usu_enc'"; 
   $resultsqlu4 = $mysqli->query($sqlu4);
   $sqlu5 = "UPDATE usuarios set direccion='$direccion' where id='$id_usu_enc'"; 
   $resultsqlu5 = $mysqli->query($sqlu5);
   $sqlu6 = "UPDATE usuarios set id_tarjeta='$id_tarjeta' where id='$id_usu_enc'"; 
   $resultsqlu6 = $mysqli->query($sqlu6);
   $sqlu7 = "UPDATE usuarios set activo='$activo' where id='$id_usu_enc'"; 
   $resultsqlu7 = $mysqli->query($sqlu7);
  
   
   if ($password != "")
     {
     $password_enc = md5($password);
     $sqlu9 = "UPDATE usuarios set passwd='$password_enc' where id='$id_usu_enc'"; 
     $resultsqlu9 = $mysqli->query($sqlu9);
     }
      */
   
   
   if (($resultsqlu1 == 1) && ($resultsqlu2 == 1) && ($resultsqlu3 == 1) && ($resultsqlu4 == 1) && 
       ($resultsqlu5 == 1)) 
         header('Location: gestion_administradores.php?mensaje=1');
   else
         header('Location: gestion_administradores.php?mensaje=2');
   
}

else

{

// Consulta el nombre y demás datos del usuario a modificar
   $id_admin_enc = $_GET["id_admin"];
   $mysqli = new mysqli($host, $user, $pw, $db);
   $sqlenc = "SELECT * from info_administradores";
   $resultenc = $mysqli->query($sqlenc);
   while($rowenc = $resultenc->fetch_array(MYSQLI_NUM))
    {  
      $id_admin  = $rowenc[0];
      if (md5($id_admin) == $id_admin_enc)
        $id_admin_enc = $id_admin;
    }
   $sql1 = "SELECT * from info_administradores where id='$id_admin_enc'";
   $result1 = $mysqli->query($sql1);
   $row1 = $result1->fetch_array(MYSQLI_NUM);
   
    $id= $row1[0];
    $nombre_completo= $row1[1];
    $cedula=$row1[2];
    $estado= $row1[3];
    $login=$row1[4];
   
   
   
   /*
   $nombre_usuario  = $row1[1];
   $tipo_usuario  = $row1[7];
   $num_id = $row1[2];
   $direccion= $row1[3];
   $activo= $row1[9];
   $id_tarjeta= $row1[8];
   $login= $row1[5];
     if ($activo == 1)
      $desc_activo = "S (Activo)";
   else
      $desc_activo = "N (Inactivo)";

     
   $sql3 = "SELECT * from tipo_usuario where id='$tipo_usuario'";
   $result3 = $mysqli->query($sql3);
   $row3 = $result3->fetch_array(MYSQLI_NUM);
   $desc_tipo_usuario = $row3[1];
    */

   ?>
	
	   <tr valign="top">
                <td width="50%" height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
			    <font FACE="arial" SIZE=2 color=blue> <b><h1>Gestion Administradores </h1>  Modificando administrador de nombre: <u><?php echo $nombre_completo; ?></u></b></font>  
          

		       </td>
	          <td width="50%" height="20%" align="right" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
		   
		       </td>
		     </tr>
   	     <tr>
                  <td colspan=2 width="25%" height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">

                   <form method=POST action="gestion_administradores_mod.php">
                   
                    <table width=50% border=1 align=center>
			    <tr>	
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Nombre Completo</b></font>  
				</td>	
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="text" name=nombre value="<?php echo $nombre_completo; ?>" required>  
				</td>	
        </tr>
         <tr>
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Cedula</b></font>  
				</td> 	
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="number" name=cedula value="<?php echo $cedula; ?>" required>  
				</td>	
		</tr>
        <tr>
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Estado</b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
			    <select name=estado required> 
                <option value="habilitado">habilitado  </option>
                <option value="deshabilitado">deshabilitado  </option>            
                </select>
				</td>	
		</tr>
	     <tr>
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Login</b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <input  type="text" name=login value="<?php echo $login; ?>" required>  
				</td>	
	     </tr>
          <tr>
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Password (Si no desea cambiar, dejelo vacio)</b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="password" name=password value="">  
				</td>	
			  </tr>
      </table>
         </br>
         <input type="hidden" value="S" name="enviado">
         <input type="hidden" value="<?php echo $id_admin_enc; ?>" name="id_admin">
         <table width=50% align=center border=0>
           <tr>  
             <td width=50%></td>                                                                       
             <td align=center><input style="background-color: #DBA926" type=submit color= blue value="Modificar" name="Modificar">
                  </form> 
             </td>  
             <td align=left>
                  <form method=POST action="gestion_administradores.php">                   
                  <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">              
                  </form> 
             </td>  
           </tr>
                   </table>
                  </form> 
<br><br><hr>
                  </td>
                </tr>  

<?php
 }
?>

        </table>
        
       </body>
      </html>


   
