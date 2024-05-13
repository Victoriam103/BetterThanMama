<!DOCTYPE html>
<html>
<link rel="stylesheet" href="planilla.css">
<header>
  <?php include "menuham.php"; ?>
</header>
<body>
<?php
include "conexion.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"]; // Obtiene el email del usuario
    $comentario = $_POST["comentario"];}
    $recipe = $_POST["recipe"];

// Prepara la consulta SQL
$sql = "INSERT INTO comentarios (nombre, email, comentario, recipe) VALUES ('$nombre', '$email', '$comentario', '$recipe')";

// Ejecuta la consulta
if (mysqli_query($conn, $sql)) {
  echo "¡Gracias por tu comentario!";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$result = mysqli_query($conn, "SELECT comentarios.nombre, recipes.recipe AS nombre_receta, comentarios.comentario, comentarios.timestamp FROM comentarios INNER JOIN recipes ON comentarios.recipe = recipes.id ORDER BY comentarios.timestamp DESC");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<table>";
    echo "<tr><td><b>Nick:</b></td><td>" . $row["nombre"] . "</td></tr>";
    echo "<tr><td><b>Receta:</b></td><td>" . $row["nombre_receta"] . "</td></tr>";
    echo "<tr><td><b>Comentario:</b></td><td>" . $row["comentario"] . "</td></tr>";
    echo "<tr><td><b>Fecha de publicacion:</b></td><td>" . $row["timestamp"] . "</td></tr>";
    echo "</table>";
}

// Cierra la conexión a la base de datos
mysqli_close($conn);
?>
</body>
</html>