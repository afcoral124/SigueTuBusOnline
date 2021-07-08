<?php

// PROGRAMA DE MENU ADMINISTRADOR
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
           <title>  Adicionar Nuevo Administrador: </title>
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
                     <h1><font color=blue>Sistema de Seguimiento de Vehiculo de Transporte Publico </font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <td valign="top" align=right>
             <!-- <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php // echo "Nombre Usuario</u>:   ".$_SESSION["nombre_usuario"];?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php // echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>  
              <font FACE="arial" SIZE=2 color="#00FFFF"> <b><u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></b></font> --> 
           </td>
	     </tr>
<?php



if ((isset($_POST["enviado"])))
  {
   //echo "grabar cambios modificaci�n";
   $nombre = $_POST["nombre"];
   $nombre = str_replace("ñ","n",$nombre);
   $nombre = str_replace("Ñ","N",$nombre);
   $cedula =  $_POST["cedula"];
   $estado =  $_POST["estado"];
   $login =  $_POST["login"];
   $password =  $_POST["password"];
   $password_enc = md5($password);
   
   $mysqli = new mysqli($host, $user, $pw, $db);
   $sqlcon = "SELECT * from info_administradores where cedula='$cedula'";
   $resultcon = $mysqli->query($sqlcon);
   $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
   $numero_filas = $resultcon->num_rows;
  
   if ($numero_filas > 0)
     { 
     
         header('Location: gestion_administradores.php?mensaje=5');
     }
   
      else
    {
    
      $sql = "INSERT INTO info_administradores(nombre_completo, cedula, estado, login, passwd) 
      VALUES ('$nombre','$cedula','$estado','$login','$password_enc')";
      //echo "sql es...".$sql;
      $result1 = $mysqli->query($sql);
      
      if ($result1 == 1) 
        {
          header('Location: gestion_administradores.php?mensaje=3');
        }
      else
         header('Location: gestion_administradores.php?mensaje=4');
     } 
    
}

else

{

   ?>
	
	   <tr valign="top">
                <td width="50%" height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
			    <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Gestion Administradores </h1>  Adicion Administrador</b></font>  
          

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

                   <form method=POST action="gestion_administradores_add.php">
                   <table width=50% border=1 align=center>
			    <tr>	
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Nombre Completo</b></font>  
				</td>	
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="text" name=nombre value="" required>  
				</td>	
       </tr>
       <tr>	
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Cedula</b></font>  
				</td>	
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="number" name=cedula value="" required>  
				</td>	
       </tr>

			     </tr>
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
				  <input type="text" name=login value="" required>  
				</td>	
	     </tr>
         <tr>
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Password</b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
				  <input type="password" name=password value="" required>  
				</td>	
	     </tr>

      </table>
         </br>
         <input type="hidden" value="S" name="enviado">
         <table width=50% align=center border=0>
           <tr>  
             <td width=50%></td>                                                                       
             <td align=center><input style="background-color: #DBA926" type=submit color= blue value="Grabar" name="Modificar">
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


   
