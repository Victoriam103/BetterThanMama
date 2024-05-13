<?php
include "conexion.php";


// Procesar el formulario cuando se envía

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Eliminar todas las exclusiones existentes para este cliente
    $conn->query("DELETE FROM alimentos_excluidos WHERE Email = '$email'");

    // Insertar nuevas exclusiones
    if (isset($_POST['alimentos_excluidos'])) {
        foreach ($_POST['alimentos_excluidos'] as $id_alimento) {
            $sql = "INSERT INTO alimentos_excluidos (Email, id_alimento) VALUES ('$email', $id_alimento)";
            $conn->query($sql);
        }
    }
}


// Consulta SQL para seleccionar todos los alimentos
$sql = "SELECT * FROM desaymer 
UNION 
SELECT * FROM cenayalmuerzo";
$result = $conn->query($sql);
if (!$result) {
    echo "Error en la consulta: " . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Excluir alimentos</title>
 
  <style>
    a, p{
        font-style: italic;
        align-content: center;
        font-weight: bold;
        color: purple;
        border: 1px solid black;
        padding: 10px;
        background-color: #fff;
    }
    body{
        padding:20px;
        background-image: url("https://cdn.pixabay.com/photo/2020/04/21/04/18/fruit-5070732_1280.png");
        
    }
.checkboxes-container {
  background-color: #f2f2f2;
  padding: 20px;
  border: 1px solid #fff;
  border-radius: 5px;
}

/* Estilo para los checkboxes */
.checkboxes-container input[type="checkbox"] {
  margin-right: 10px;
}

/* Estilo para la etiqueta de cada checkbox */
.checkboxes-container label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
}

/* Estilo para el recuadro alrededor del formulario de checkboxes */
.checkboxes-container fieldset {
  border: 1px solid #fff;
  border-radius: 5px;
  padding: 10px;
  margin: 0;
}

/* Estilo para la leyenda del formulario de checkboxes */
.checkboxes-container legend {
  font-size: 1.2em;
  font-weight: bold;
  margin-bottom: 10px;
}
</style>
</head>
<body>
  <p>Selecciona los alimentos que deseas excluir</p>
  <div class="checkboxes-container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>
    <?php while ($row = $result->fetch_assoc()): ?>
        <input type="checkbox" name="alimentos_excluidos[]" value="<?php echo $row["id"]; ?>">
        <label><?php echo $row["nombre"]; ?></label><br>
    <?php endwhile; ?>
    <input type="submit" value="Excluir alimentos">
   
</form>
    </div>
    <a href="index.php">Ir a la página principal</a>

</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
