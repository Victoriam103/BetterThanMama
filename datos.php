<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<header>


</header>
<?php
// Conexión a la base de datos
$dbhost="localhost";
$dbuser="admin";
$dbpass="admin";
$dbname="Usuarios";

// Verificar la conexión
// Conectarse a la base de datos
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
  die("Error de conexión: " . mysqli_connect_error());
}

// Consulta SQL con filtrado por email 
$sql = "SELECT edad, genero, altura, peso FROM datos WHERE Email = '$usuarioingresado'";

// Ejecutar la consulta
$resultado = mysqli_query($conn, $sql);

// Verificar si la consulta devolvió algún resultado
if (mysqli_num_rows($resultado) > 0) {

  // Obtener los datos en un array
  $datos = mysqli_fetch_assoc($resultado);

  // Imprimir los datos
  echo "<p>Tu edad es: " . $datos["edad"] . "</p><br>";
  echo "<p>Tu genero es: " . $datos["genero"] . "</p><br>";
  echo "<p>Esta es tu altura: " . $datos["altura"] . "</p><br>";
  echo "<p>Este es tu peso: " . $datos["peso"] . "</p><br>";

  // Calcular las necesidades según el género
  if ($datos["genero"] == 'h') {
    $s = 5;
  } elseif ($datos["genero"] == 'm') {
    $s = -161;
  } elseif ($datos["genero"] == 'nsnc') {
    $s = 5;
  }

  $necesidades = ((10 * $datos["peso"]) + (6.25 * $datos["altura"]) - (5 * $datos["edad"]) + $s + 200);

  echo "<p>Tus necesidades calóricas diarias son: $necesidades kcal</p><br>";
}
  // Sentencia para obtener los datos de la tabla datos
  $sql= "SELECT objetivo FROM datos WHERE Email='$usuarioingresado'";

  // Ejecutar la consulta
  $resultado = mysqli_query($conn, $sql);

  // Verificar si la consulta devolvió algún resultado
  if (mysqli_num_rows($resultado) > 0) {

    // Obtener los datos en un array
    $datos = mysqli_fetch_assoc($resultado);

    echo "<p>Tu objetivo es: " . $datos["objetivo"] . "<br></p>";
    switch($datos["objetivo"]) {
      case "perder":
        $kcaldieta=$necesidades-200;
        echo "<p>TTu objetivo diario es de $kcaldieta kcal al día</p>";
        break;
      case "ganar":
        $kcaldieta=$necesidades+250;
        echo "<p>Tu objetivo diario es de $kcaldieta kcal al día</p>";
        break;
      case "mantener":
        $kcaldieta=$necesidades;
        echo "<p>Tu objetivo diario es el mismo que tus necesidades diarias</p>";
        break;
    }
  }

  $desayuno= $kcaldieta * 0.1875;
  $almuerzo=$kcaldieta*31.25;
  $merienda=$kcaldieta*0.1875;
  $cena=$kcaldieta*31.25;
  
  ?>
  </body>
  </html>