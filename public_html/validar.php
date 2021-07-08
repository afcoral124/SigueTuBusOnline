                                                       
<?php

// PROGRAMA DE VALIDACION DE USUARIOS
                                                                    
$login = $_POST["login1"];
$password = $_POST["passwd1"];

$passwd_comp = md5($password);    //pásandola a MD5 (algoritmo de codificacion)
session_start();

//echo "login es...".$login;
//echo "password es...".$passwd;

include ("conexion.php");

$mysqli = new mysqli($host, $user, $pw, $db);
       
$sql = "SELECT * from info_administradores where login = '$login' and estado='habilitado'";
$result1 = $mysqli->query($sql);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$numero_filas = $result1->num_rows;
if ($numero_filas > 0)
  {
   
    $passwdc = $row1[5];
    if ($passwdc == $passwd_comp)
      {
        $_SESSION["autenticado"]= "SIx3";
        $nombre_usuario = $row1[1];
        $_SESSION["nombre_usuario"]= $nombre_usuario;  
        $_SESSION["id_usuario"]= $row1[0];;  
        header("Location: programas_php/interfacesproyecto/InicialAdmin.php");   //Redirecciona a la interfaz del admin
        
      }
       else 
           {
            header('Location: index.php?mensaje=1');   //mensaje es = 1 cuando la contraseña es incorrecta
           }
   }
    else
        {
          header('Location: index.php?mensaje=2');       // mensaje=2 cuando no hay usuarios    con el login
         }
       
       
         // prueba para mostrar mensaje de admin deshabilitado  
        $sql2 = "SELECT * from info_administradores where login = '$login' and estado='deshabilitado'";
        $result2 = $mysqli->query($sql2);
        $row2 = $result2->fetch_array(MYSQLI_NUM);
        $numero_filas2 = $result2->num_rows;
        if ($numero_filas2 > 0)  {        //sería mayor que 0 cuando capture al menos un dato (sí estaría deshabilitado)
        
        header('Location: index.php?mensaje=3');
        
        }   
           
      ?>
