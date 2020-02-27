<?php
session_start();
include("conexion.php");
include_once 'sesion.php';
$sesion = new sesion ();

$currentUser = $sesion->getCurrentUser();

 ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="css/styles.css" rel="stylesheet">
    <title>Inicio</title>
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

<div class="top_Image">
  <img src="img/principal.jpg" alt="">
</div>

<div class="info">



<?php  try {
   $con = new PDO("mysql:host=$hostBD; dbname=$dataBD", $userBD, $passBD);
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $stmt = $con->prepare('SELECT *  FROM usuarios WHERE id_u = :id_u');
   $stmt->execute(
     array(
     'id_u' =>  $currentUser)
   );

   while( $datos = $stmt->fetch()){

     echo '<h2> Bienvenido </h2>' . $datos[1] ;
     echo  "&nbsp;" . $datos[2] ;
     echo "&nbsp;" . $datos[3] ;
     echo "<br/>". "Estas inscrito al curso: " . $datos[7];

   }




 } catch(PDOException $e) {
   echo 'Error: ' . $e->getMessage();
 }
 ?>

</div>


<div class="band">

  <div class="item-1">
    <a href="#" class="card">
      <article>
        <h1>Nuevo Curso</h1>
      </article>

      <div class="thumb" style="background-image: url(img/moon.jpeg)"> </div>
      <article>
        <h1>Diseño de videojuegos 2D</h1>
      </article>
    </a>
  </div>

  <p class="principal">Aprende a diseñar y codificar videojuegos en 2D completamente funcionales con nuestro curso de "Diseño de videojuegos en 2D"</p>

</div>

<div class="titulo_Principal">
  <h1>Ultimas Noticias</h1>
</div>


<div class="band">
  <div class="item-1">
    <a href="#" class="card">
      <div class="thumb" style="background-image: url(img/evo_videojuegos.jpg)"> </div>
      <article>
        <h1>La proxima evolucion de los videojuegos</h1>
      </article>
    </a>
  </div>

  <div class="item-2">
    <a href="#" class="card">
      <div class="thumb" style="background-image: url(img/R_aumentada.jpg)"> </div>
      <article>
        <h1>Aumenta el consumo de realidad aumentada</h1>
      </article>
    </a>
  </div>

  <div class="item-3">
    <a href="#" class="card">
      <div class="thumb" style="background-image: url(img/pokemon_go.jpg)"> </div>
      <article>
        <h1>Pokemon Go tiene ganancias por mas de 800 millones</h1>
      </article>
    </a>
  </div>

</div>





  </body>


  <footer id="colophon" class="site-footer" role="contentinfo">
  <div class="social-wrapper">
    <ul>
      <li>
        <a href="https://twitter.com/?lang=es" target="_blank">
          <img src="https://cdn1.iconfinder.com/data/icons/logotypes/32/twitter-128.png" alt="Twitter Logo" class="twitter-icon"></a>
      </li>
      <li>
        <a href="https://es-la.facebook.com/" target="_blank">
          <img src="http://www.iconarchive.com/download/i54037/danleech/simple/facebook.ico" alt="Facebook Logo" class="facebook-icon"></a>
      </li>
      <li>
        <a href="https://www.youtube.com/?gl=MX&hl=es-419" target="_blank">
          <img src="https://lh3.googleusercontent.com/j_RwVcM9d47aBDW5DS1VkdxUYCkDUCB6wZglv4x-9SmsxO0VaFs7Csh-FmKRCWz9r_Ef=w170" alt="Youtube Logo" class="youtube-icon"></a>
      </li>
    </ul>
  </div>


</footer>




</html>
