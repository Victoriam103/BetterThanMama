<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="planilla.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Menú Semanal</title>
</head>
<header>
 
 <?php include "menuham.php"; ?>
</header>
<body>

<?php
require_once 'recetas.php';
require_once 'almuerzocena.php';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
  die("Error de conexión: " . mysqli_connect_error());
}

$dias_semana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
$comidas = ["Desayuno", "Almuerzo", "Merienda", "Cena"];
$recetas_semanales = [];

// Almacenar los resultados en arrays
$desayunos = [];
$almuerzos_cenas = [];

// Comprueba si hay resultados en la consulta
$sql_desayuno = "SELECT * FROM menu_semanal WHERE grupo='$group' AND Email NOT IN (SELECT id_alimento FROM alimentos_excluidos WHERE Email='$usuarioingresado') ORDER BY RAND() LIMIT 14";
$result_desayuno = mysqli_query($conn, $sql_desayuno);
if (!$result_desayuno) {
  die("Error en la consulta SQL: " . mysqli_error($conn));
}
if (mysqli_num_rows($result_desayuno) > 0) {
  // Itera a través de los resultados y muestra las recetas
  while ($row = mysqli_fetch_assoc($result_desayuno)) {
    $desayunos[] = [
      "nombre" => $row["nombre"],
      "grupo" => $row["grupo"],
      "calorias" => $row["calorias"],
      "proteinas" => $row["proteinas"],
      "carbohidratos" => $row["carbohidratos"],
      "grasas" => $row["grasas"]
    ];
  }
} else {
  echo "No se encontraron recetas en la base de datos de desayunos y meriendas.";
}
$sql_almuerzo = "SELECT * FROM menu_semanal2 WHERE grupo='$group' AND Email NOT IN (SELECT id_alimento FROM alimentos_excluidos WHERE Email='$usuarioingresado') ORDER BY RAND() LIMIT 14";
$result_almuerzo = mysqli_query($conn, $sql_almuerzo);

// Comprueba si hay resultados en la consulta
if (mysqli_num_rows($result_almuerzo) > 0) {
  // Itera a través de los resultados y muestra las recetas
  while ($row = mysqli_fetch_assoc($result_almuerzo)) {
    $almuerzos_cenas[]=[
      "nombre" => $row["nombre"],
      "grupo" => $row["grupo"],
      "calorias" => $row["calorias"],
      "proteinas" => $row["proteinas"],
      "carbohidratos" => $row["carbohidratos"],
      "grasas" => $row["grasas"]
    ];
  }
} else {
  echo "No se encontraron recetas en la base de datos de almuerzos y cenas";
}

// Crea la matriz de recetas semanales
for ($i = 0; $i < 7; $i++) {
  $recetas_semanales[$i] = [
    "Desayuno" => $desayunos[$i*2],
    "Almuerzo" => $almuerzos_cenas[$i*2+1],
    "Merienda" => $desayunos[$i*2],
    "Cena" => $almuerzos_cenas[$i*2+1],
  ];
}

    
    // Muestra la tabla de recetas semanales
    echo "<table border='1'>";
    echo "<tr><th></th>";
    
    foreach ($dias_semana as $dia) {
    echo "<th>{$dia}</th>";
    }
    
    echo "</tr>";
    
    foreach ($comidas as $comida) {
    echo "<tr>";
    echo "<td>{$comida}</td>";
    
    foreach ($dias_semana as $dia) {
    echo "<td>" . $recetas_semanales[array_search($dia, $dias_semana)][$comida]["nombre"] . "</td>";
    }
    
    echo "</tr>";
    }
    
    echo "</table>";
    
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
    ?>
    </body>
    <script>
    
    const menuBtn = document.querySelector(".menu-btn");
    const menuContainer = document.querySelector(".menu-container");
    
    menuBtn.addEventListener("click", () => {
    menuContainer.classList.toggle("hidden");
    });
    </script>
    <script src="cookie.js"></script>
    <div id="cookieBanner" style="position:fixed;bottom:0;left:0;width:100%;background-color:#f1f1f1;padding:10px;text-align:center;z-index:10000;display:none;">
      Utilizamos cookies para mejorar su experiencia en nuestro sitio web. Al continuar utilizando nuestro sitio, acepta nuestra política de cookies.
      <button onclick="aceptarCookies();">Aceptar</button>
      <button onclick="rechazarCookies();">Rechazar</button>
    </div>
    </html>
