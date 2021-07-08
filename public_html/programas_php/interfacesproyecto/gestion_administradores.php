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
           <title> Gestion De Administradores </title>
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
                     <h1><font color=blue>Gestion de Administradores </font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <!--<td valign="top" align=right>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php // echo "Nombre Usuario</u>:   ".$_SESSION["nombre_usuario"];?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php // echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>  
              <font FACE="arial" SIZE=2 color="#00FFFF"> <b><u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></b></font>  

           </td>-->
	     </tr>
     </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
      <tr>
       <td align=left width=50%>
        <form action="gestion_administradores.php" method="POST">
         <table border=0 width=100%>   
          <tr>
           <td align=left >
             <font FACE="arial" SIZE=2 color="#000000">Consultar por cedula: <input type="text" name=cedula value=""></font>
           </td>
          </tr>
         </table>
        </td>
       <td align=left width=50%>
         <table border=0 width=100%>   
          <tr>
           <td align=right width=50%>
             
             

       <font FACE="arial" SIZE=2 color="#000000">Consultar por nombre: <input type="text" name=nombre value=""></font>
 
           </td>
           <td align=center width=50%>
             <font FACE="arial" SIZE=2 color="#000000"><input type="submit" name=Consultar value="Consultar"></font>
           </td>
          </tr>
         </table>
          <input type="hidden" value="1" name="enviado">
         </form>
        </td>
        <td align=left>
                  <form method=POST action="InicialAdmin.php">
                  <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">              
                  </form> 
             </td> 
      </tr>
       

      <tr>
       <td>
         &nbsp;&nbsp;&nbsp;
       </td>
      <td align=center>
        <a href="gestion_administradores_add.php"> <b>Agregar Nuevo Administrador</b></a>    
      </td>
      </tr>
     <?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>
      
  		     <tr>
             <td> </td>
             <td height="20%" align="left">
                  <table width=60% border=1>
                   <tr>
                    <?php 
                       if ($mensaje == 1)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Administrador actualizado correctamente.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Administrador no fue actualizado correctamente.";
                       if ($mensaje == 3)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Administrador creado correctamente.";
                       if ($mensaje == 4)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Administrador no fue creado. Se presento un inconveniente";
                       if ($mensaje == 5)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Administrador no fue creado. Ya existe administrador con la misma cedula.";

             echo "</td></tr>
                  </table>
              </td>
    		     </tr>";

            }
           }   
            ?>                         

	  	     <tr>
                  <td colspan=2 height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">

     <table width=80% border=1 align=center>
			 <tr>	
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>id</b></font>  
				</td>	
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Nombre de Usuario </b></font>  
				</td> 	
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Cedula</b></font>  
				</td> 	
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>estado</b></font>  
				</td>
				<td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Login</b></font>  
				</td>
			
   	            <td bgcolor="#3377FF" align=center> 
				  <font FACE="arial" SIZE=2 color=white> <b>Modificar</b></font>  
				</td>
			</tr>
				  
<?php
         /*$mysqli = new mysqli($host, $user, $pw, $db);
		     if ((isset($_POST["enviado"])))
         {
           $id_con = $_POST["id_con"];
           $nombre_con = $_POST["nombre_con"];
           $estado = $_POST["estado"];
           $sql1 = "SELECT * from usuarios order by nombre_completo";
           if (($id_con == "") and ($nombre_con == ""))
             {
              if ($estado != "2")
                $sql1 = "SELECT * from usuarios where activo='$estado' order by nombre_completo";
             }
           if (($id_con != "") and ($nombre_con == ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from usuarios where identificacion='$id_con'";
              else
                $sql1 = "SELECT * from usuarios where identificacion='$id_con' and activo='$estado'";
             }
           if (($id_con == "") and ($nombre_con != ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from usuarios where nombre_completo LIKE '%$nombre_con%' order by nombre_completo";
              else
                $sql1 = "SELECT * from usuarios where nombre_completo LIKE '%$nombre_con%' and activo='$estado' order by nombre_completo";
              }
           if (($id_con != "") and ($nombre_con != ""))
             {
              if ($estado == "2")
                 $sql1 = "SELECT * from usuarios where nombre_completo LIKE '%$nombre_con%' and identificacion='$id_con'";
              else
                $sql1 = "SELECT * from usuarios where nombre_completo LIKE '%$nombre_con%' and identificacion='$id_con' and activo='$estado'";
             }      
          }
         else
             $sql1 = "SELECT * from usuarios order by nombre_completo";
             
         //echo "sql1 es...".$sql1;
         
         $result1 = $mysqli->query($sql1);
         while($row1 = $result1->fetch_array(MYSQLI_NUM))
         {
			    $id_usu  = $row1[0];
			    $id_usu_enc = md5($id_usu);
			    $nombre_usuario  = $row1[1];
	     	  $num_id = $row1[2];
	     	  $direccion = $row1[3];
	     	  $usuario= $row1[5];
          $tipo_usuario  = $row1[7];
          $id_tarjeta = $row1[8];
	     	  $activo= $row1[9];
			    if ($activo == 1)
				    $desc_activo = "S";
			    else
				    $desc_activo = "N";

     	    $sql3 = "SELECT * from tipo_usuario where id='$tipo_usuario'";
          $result3 = $mysqli->query($sql3);
          $row3 = $result3->fetch_array(MYSQLI_NUM);
                $desc_tipo_usuario = $row3[1];*/
                

?>
<?php
 if ((isset($_POST["enviado"])))
 {
   $cedula= $_POST["cedula"];
   $nombre = $_POST["nombre"];
   $sql1 = "SELECT * from info_administradores order by id";
   if (($cedula == "") and ($nombre == ""))
     {
        $sql1 = "SELECT * from info_administradores order by id";
     }
   if (($cedula != "") and ($nombre == ""))
     {
        $sql1 = "SELECT * from info_administradores where cedula='$cedula'";
     }
   if (($cedula == "") and ($nombre != ""))
     {
        $sql1 = "SELECT * from info_administradores where nombre_completo LIKE '%$nombre%' order by nombre_completo";
      }
   if (($cedula != "") and ($nombre != ""))
     {
     
         $sql1 = "SELECT * from info_vehiculos where cedula='$cedula' and nombre_completo LIKE '%$nombre%'";
      
     }   
     $result1 = $mysqli->query($sql1);
// la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
// tenga alg�n registro resultante. Como la consulta arroja 5 resultados, los �ltimos que tenga la tabla, se ejecutar� 5 veces el siguiente ciclo while.
// el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente

while($row2 = $result1->fetch_array(MYSQLI_NUM))
{


$id = $row2[0];
$id_admin_enc= md5($id);
$nombre_completo = $row2[1];
$cedula = $row2[2];
$estado = $row2[3];
$login = $row2[4];
$password = $row2[5]; 
?>
    	 <tr>
         <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $id; ?></b></font>  
				</td>
                <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $nombre_completo; ?></b></font>  
				</td>
                <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $cedula; ?></b></font>  
				</td>
                <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $estado; ?></b></font>  
				</td>
                <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $login; ?></b></font>  
				</td>
                     
        <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <a href="gestion_administradores_mod.php?id_admin=<?php echo $id_admin_enc; ?>"> <img src="img/icono_editar.jpg" border=0 width=40 height=30></a></font>  
				</td>
	     </tr>
		     
	     	         
<?php
			   }   
  }
  else{
// la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
$sql1 = "SELECT * from info_administradores order by id"; // Aqu� se ingresa el valor recibido a la base de datos.
// la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
$result1 = $mysqli->query($sql1);
// la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
// tenga alg�n registro resultante. Como la consulta arroja 5 resultados, los �ltimos que tenga la tabla, se ejecutar� 5 veces el siguiente ciclo while.
// el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente

while($row2 = $result1->fetch_array(MYSQLI_NUM))
{


$id = $row2[0];
$id_admin_enc= md5($id);
$nombre_completo = $row2[1];
$cedula = $row2[2];
$estado = $row2[3];
$login = $row2[4];
$password = $row2[5];  
?>
    	 <tr>
         <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $id; ?></b></font>  
				</td>
                <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $nombre_completo; ?></b></font>  
				</td>
                <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $cedula; ?></b></font>  
				</td>
                <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $estado; ?></b></font>  
				</td>
                <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <b><?php echo $login; ?></b></font>  
				</td>
                      
        <td bgcolor="#EEEEEE" align=center> 
				  <font FACE="arial" SIZE=2 color="#000000"> <a href="gestion_administradores_mod.php?id_admin=<?php echo $id_admin_enc; ?>"> <img src="img/icono_editar.jpg" border=0 width=40 height=30></a></font>  
				</td>
	     </tr>
		     
	     	         
<?php
               }
            }
?>


                   </table>
<br><br><hr>
                  </td>
                </tr>  
        </table>
        
       </body>
      </html>


   
