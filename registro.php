<?php
session_start();
include("conexion.php");
if(isset($_POST['btn-signup']))
{
  $id_u = trim($_POST['id_u']);
  $uname = trim($_POST['uname']);
  $u_Apellido_P = trim($_POST['u_Apellido_P']);
  $u_Apellido_M = trim($_POST['u_Apellido_M']);
  $email = trim($_POST['email']);
  $mno = trim($_POST['mno']);
  $upass = trim($_POST['upass']);

  if(empty($id_u))
  {
   $error = "Por favor ingresa un ID";
   $code = 1;
  }
  else if(!is_numeric($id_u))
  {
   $error = "Solo se admiten numeros";
   $code = 1;
  }
   else if(empty($uname))
   {
    $error = "Ingresa tu nombre";
    $code = 2;
   }
   else if(!ctype_alpha($uname))
   {
    $error = "Solo se admiten letras";
    $code = 2;
   }
   else if(empty($u_Apellido_P))
   {
    $error = "Ingresa tu apellido Paterno";
    $code = 5;
   }
   else if(!ctype_alpha($u_Apellido_P))
   {
    $error = "Solo se admiten letras en este campo";
    $code = 5;
   }
   else if(empty($u_Apellido_M))
   {
    $error = "Ingresa tu apellido Materno";
    $code = 6;
   }
   else if(!ctype_alpha($u_Apellido_M))
   {
    $error = "Solo se admiten letras en este campo";
    $code = 6;
   }
   else if(empty($email))
   {
    $error = "Ingresa tu Correo electronico";
    $code = 3;
   }
   else if(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email))
   {
    $error = "La direccion de correo no es valida";
    $code = 3;
   }
   else if(empty($mno))
   {
    $error = "Ingresa tu numero telefonico";
    $code = 4;
   }
   else if(!is_numeric($mno))
   {
    $error = "Solo se admiten numeros";
    $code = 4;
   }
   else if(strlen($mno)!=10)
   {
    $error = "Solo se admiten 10 caracteres";
    $code = 4;
   }

   else if(empty($upass))
   {
    $error = "Ingresa una contraseña";
    $code = 7;
   }
   else if(strlen($upass) < 8 )
   {
    $error = "El password debe contener al menos 8 caracteres";
    $code = 7;
   }
   else if(!preg_match("/^[zA-Z-]/i", $upass))
   {
    $error = "La contraseña debe incluir una letra al principio";
    $code = 7;
   }

   else if(!preg_match("/[A-Z]+[0-9]/i", $upass))
   {
    $error = "La contraseña debe incluir letras y numeros";
    $code = 7;
   }

    else if(preg_match("/(\s)/", $upass))
    {
     $error = "No se permite que la contraseña tenga espacios";
     $code = 7;
    }

   else
   {

// Inicio Script para los ingresos de datos

      try
      {

        $connect = new PDO("mysql:host=$hostBD; dbname=$dataBD", $userBD, $passBD);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM usuarios WHERE id_u = :id_u";
        $statement = $connect->prepare($query);
        $statement->execute(
             array(
                  'id_u'     =>     $_POST["id_u"],

             )
        );
        $count = $statement->rowCount();
        if($count > 0)
        {
          echo '<script language="javascript">';
          echo 'alert("El usuario ya esta registrado")';
          echo '</script>';
        }
        else
        {


          $_SESSION["id_u"] = $_POST["id_u"];
          $message = "Exito";


          $data = [
          'id_u' => $id_u,
          'uname' => $uname,
          'u_Apellido_P' => $u_Apellido_P,
          'u_Apellido_M' => $u_Apellido_M,
          'email' => $email,
          'mno' => $mno,
          'upass' => $upass,
                        ];

          $connect = new PDO("mysql:host=$hostBD; dbname=$dataBD", $userBD, $passBD);
          $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $query = "INSERT INTO usuarios (id_u, uname, u_Apellido_P, u_Apellido_M, email, mno, upass) VALUES (:id_u, :uname, :u_Apellido_P, :u_Apellido_M, :email, :mno, :upass)";
          $statement = $connect->prepare($query);
          $statement->execute($data);

          echo '<script language="javascript">';
          echo 'alert("Usuario Registrado")';
          echo '</script>';

        }



      }
      catch(PDOException $error)
      {
           $message = $error->getMessage();
      }


     // <!-- Fin del script para conexion e ingreso de usuarios. -->




        
 }
}
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrar Usuario</title>
<link rel="stylesheet" href="css/styles.css" type="text/css" />
<style type="text/css">
<?php
if(isset($error))
{
 ?>
 input:focus
 {
  border:solid red 1px;
 }
 <?php
}
?>
</style>
</head>
<body>
  <div class="">
    <nav>
          <ul class="menu">
            <li class="item"><a href="index.html"> Inicio</a> </li>
            <li class="item" ><a href="cursos.html">Cursos</a> </li>
            <li class="item" ><a href="talleres.html">Talleres</a></li>
            <li class="item"><a href="nosotros.html">Nosotros</a></li>
            <li class="item"><a href="contactos.html">Contacto</a></li>
            <li class="item"><a href="registro.php">Registrarse</a></li>
            <li class="item"><a href="ingresar.php">Ingresar</a></li>
          </ul>
    </nav>
  </div>


<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<?php
if(isset($error))
{
 ?>
    <tr>
    <td id="error"><?php echo $error; ?></td>
    </tr>
    <?php
}
?>

<tr>
<td><input type="text" name="id_u" placeholder="ID" value="<?php if(isset($id_u)){echo $id_u;} ?>"  <?php if(isset($code) && $code == 1){ echo "autofocus"; }  ?> /></td>
</tr>
<tr>
<td><input type="text" name="uname" placeholder="Nombre" value="<?php if(isset($uname)){echo $uname;} ?>"  <?php if(isset($code) && $code == 2){ echo "autofocus"; }  ?> /></td>
</tr>
<tr>
<td><input type="text" name="u_Apellido_P" placeholder="Apellido Paterno" value="<?php if(isset($u_Apellido_P)){echo $u_Apellido_P;} ?>"  <?php if(isset($code) && $code == 5){ echo "autofocus"; }  ?> /></td>
</tr>
<tr>
<td><input type="text" name="u_Apellido_M" placeholder="Apellido Materno" value="<?php if(isset($u_Apellido_M)){echo $u_Apellido_M;} ?>"  <?php if(isset($code) && $code == 6){ echo "autofocus"; }  ?> /></td>
</tr>
<tr>
<td><input type="text" name="email" placeholder="Email"  value="<?php if(isset($email)){echo $email;} ?>" <?php if(isset($code) && $code == 3){ echo "autofocus"; }  ?> /></td>
</tr>
<tr>
<td><input type="text" name="mno" placeholder="Celular" value="<?php if(isset($mno)){echo $mno;} ?>" <?php if(isset($code) && $code == 4){ echo "autofocus"; }  ?> /></td>
</tr>
<tr>
<td><input type="password" name="upass" placeholder="Contraseña" <?php if(isset($code) && $code == 7){ echo "autofocus"; }  ?> /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Registrarme</button></td>
</tr>
</table>
</form>
</div>



</center>





</body>
</html>
