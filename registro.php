<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Únete a nosotros</title>
    <link rel="stylesheet" href="registro.css"/>
    
  </head>
  <header>  
    <?php
    include "menuham.php"; ?>
  </header>
  <body>
    <h1> Bienvenido a la cocina!  </h1>
    <h2> Comienza rellenando tus datos para ir conociéndonos</h2>
    <form action="autentificacion.php" method="POST">
  <div class="wrapper">
 <ul>
  <ol>
    <label for="name">Nombre:</label>
    <input type="text"  name="nombre">
  </ol>
  <ol>
    <label for="Apellidos">Apellidos:</label>
    <input type="text"  name="apellidos">
  </ol>
  <ol>
    <label for="edad">Edad:</label>
    <input type="number"  name="edad">
  </ol>
    <ol>
      <label for="Sexo">Genero:</label>
    <input type="radio" name="genero" value="h"> Hombre
    <input type="radio" name="genero" value="m"> Mujer
    <input type="radio" name="genero" value="nsnc"> prefiero no decirlo
    </ol>
    <ol>
      <label for="mail">Correo electrónico:</label>
      <input type="email"  name="email">
    </ol>
    <ol>
      <label for="peso">Peso en Kg:</label>
      <input type="number" name="peso">
    </ol>
    <ol>
      <label for="altura">altura en cm"</label>
      <input type="number" name="altura">
    </ol>
    <ol>
      <label for="objetivo">Objetivos:</label>
    <input type="radio" name="objetivo" value="ganar"> ganar peso
    <input type="radio" name="objetivo" value="perder"> perder peso
    <input type="radio" name="objetivo" value="mantener"> mantener mi peso
    </ol>
  </form>

 </ul>

    <ol>Contraseña: <input type="password" name="clave1" size="8">
    <br> </ol>
  <ol> Repite contraseña: <input type="password" name="clave2" size="8">
    <br> </ol>
    <input type="submit" name="enviar" value="enviar">
  </form>
</div>
</body>
</html>

