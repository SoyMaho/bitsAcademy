<?php
session_start();
include("conexion.php");
include_once 'sesion.php';

$sesion = new sesion ();
$currentUser = $sesion->getCurrentUser();
if(isset($_POST['btn-signup']))
{
  $curso = trim($_POST['curso']);

  $data = [
  'curso'=> $curso,
  'id_u' => $currentUser,
                ];

  $connect = new PDO("mysql:host=$hostBD; dbname=$dataBD", $userBD, $passBD);
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = "UPDATE usuarios SET curso = :curso WHERE id_u = :id_u";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  echo '<script language="javascript">';
  echo 'alert("Registro del curso realizado con exito")';
  echo '</script>';

}



 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="css/styles.css" rel="stylesheet">
    <title>Incribete a un curso</title>
  </head>
  <body>

    <div class="">
      <nav>
            <ul class="menu">
              <li class="item"><a href="home.php"> Inicio</a> </li>
              <li class="item" ><a href="cursos.html">Cursos</a> </li>
              <li class="item" ><a href="talleres.html">Talleres</a></li>
              <li class="item"><a href="nosotros.html">Nosotros</a></li>
              <li class="item"><a href="contactos.html">Contacto</a></li>
              <li class="item"><a href="registro.php">Registrarse</a></li>
              <li class="item"><a href="inscribirse.php">Incribirme</a></li>
              <li class="item"><a href="logout.php">Salir</a></li>
            </ul>
      </nav>
    </div>

    <Center>
      <form method="post">
        <tr>
        <td><input type="text" name="curso" placeholder="Curso" value="" /></td>
        </tr>
        <tr>
        <td><button type="submit" name="btn-signup">Registrarme</button></td>
        </tr>
      </form>
    </center>

  </body>
</html>
