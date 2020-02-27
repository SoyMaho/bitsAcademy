<?php
ob_start();

session_start();
include("conexion.php");
include("sesion.php");
 try
 {
      $connect = new PDO("mysql:host=$hostBD; dbname=$dataBD", $userBD, $passBD);
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if(isset($_POST["login"]))
      {
           if(empty($_POST["id_u"]) || empty($_POST["upass"]))
           {
                $message = '<label>Todos los campos son requeridos</label>';
           }
           else
           {
                $query = "SELECT * FROM usuarios WHERE id_u = :id_u AND upass = :upass";
                $statement = $connect->prepare($query);
                $statement->execute(
                     array(
                          'id_u'     =>     $_POST["id_u"],
                          'upass'     =>     $_POST["upass"]
                     )
                );
                $count = $statement->rowCount();
                if($count > 0)
                {
                     $_SESSION["id_u"] = $_POST["id_u"];
                     $message = "Exito";
                     $sesion = new sesion ();
                     $sesion -> setCurrentUser($_POST["id_u"]);
                     echo $sesion->getCurrentUser();
                     echo '<script language="javascript">';
                     echo 'alert("Acceso autorizado")';
                     echo '</script>';
                     header('Location: ../home.php');
                }
                else
                {
                     $message = '<label>Datos incorrectos</label>';
                }
           }
      }
 }
 catch(PDOException $error)
 {
      $message = $error->getMessage();
 }?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Ingreso de usuarios</title>
<link rel="stylesheet" href="css/styles.css" type="text/css" />


</head>

<body>


<header>

</header>


<div class="container">
  <h3 class="mt-5">Ingreso de usuarios</h3>
  <hr>
  <div class="row">


           <br />
                <?php
                if(isset($message))
                {
                     echo '<label class="text-danger">'.$message.'</label>';
                }
                ?>
                <div id="login-form">

                </div>

                <center>
                  <div id="login-form">
                    <form method="post">
                      <table align="center" width="30%" border="0">

                      <tr>
                      <td><input type="text" name="id_u" placeholder="ID" value="" /> </td>
                      </tr>

                      <tr>
                      <td><input type="password" name="upass" placeholder="Contraseña"  /></td>
                      </tr>

                      <tr>
                      <td><button type="submit" name="login">Ingresar</button></td>
                      </tr>

                    </table>
                    </form>
                  </div>

                </center>






  </div>







</div>

</body>
</html>

<?php
ob_end_flush();
?>
