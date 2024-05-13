

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="aporteusuario.css">
  <link rel="stylesheet" href="menuham.css">
  <!-- PARA EL ICONO DE AÑADIR RECETA -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
<style>
.recipe-post {
  background-color: lightcoral;
  padding: 20px;
  border: 2px solid #00FF00;
  border-radius: 10px;
  margin-bottom: 30px;
  position: relative;
  clear: both;
}

.recipe-post::after {
  content: "";
  position: absolute;
  bottom: -20px;
  left: 20px;
  right: 20px;
  height: 1px;
  background-color: green;
}

.recipe-name {
  color: #00FF00;
  font-size: 24px;
  margin-bottom: 20px;
}

.recipe-ingredients, .recipe-instructions {
  color: #800080;
  font-size: 18px;
  margin-bottom: 20px;
}

</style>
</head>
<?php
include "menuham.php"?>
<body>
<?php
$dbhost="localhost";
$dbuser="admin";
$dbpass="admin";
$dbname="Usuarios";
 $conn=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
 
 
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $receta = $_POST['receta'];
    $ingredients = implode("\n", $_POST['ingredient']);
    $descripcion = $_POST['descripcion'];
    $recipe = "nombre:$nombre\nreceta:$receta\ningredientes:$ingredients\ndescripcion:$descripcion\n";
    file_put_contents('recipe.txt', $recipe, FILE_APPEND);
    $sql = "INSERT INTO recipes (name, recipe, ingredients, description) VALUES ('$nombre', '$receta', '$ingredients', '$descripcion')";
    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
  // Mostrar las recetas en una tabla
$sql = "SELECT * FROM recipes";
$result = mysqli_query($conn, $sql);

echo '<div class="recipe-posts"><div class="recipe-post">';

while ($row = mysqli_fetch_assoc($result)) {
  echo '<h2 class="recipe-name"> Usuario: ' . $row['name'] . '</h2>';
  echo '<div class="recipe-instructions"> Receta: ' . $row['recipe'] . '</div>';
  echo '<div class="recipe-ingredients"> Ingredientes: ' . $row['ingredients'] . '</div>';
  echo '<div class="recipe-instructions">Descripcion: ' . $row['description'] . '</div>';
  echo '<div class="recipe-instructions">Me gusta:' . $row['rating'] . '</div>';
  echo "<div><a href='aporteusuario.php?vote=true&id=" . $row['id'] . "'>Me gusta:</a></div>";
  echo "<div><a href='comentarios.php'>Comentarios</a></div>";
}

echo '</div>';

if (isset($_GET['vote']) && isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "UPDATE recipes SET rating = rating + 1 WHERE id = '$id'";
  if (mysqli_query($conn, $sql)) {
    echo "Puntuación actualizada correctamente";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
<body>
  <!-- Crea el ícono que el usuario puede hacer clic -->
<i class="fas fa-plus-circle" id="form-icon" style="font-size: 24px; cursor: pointer;"></i>
<div id="form-container" style="display: none;">
<form action="aporteusuario.php" method="post">
  <label for="nombre">Introduce tu nickname</label><br>
  <input type="text" id="nombre" name="nombre"><br>

  <label for="receta">Nombre de la receta</label><br>
  <input type="text" id="receta" name="receta">

  <br><label for="ingredientes">Ingredientes:</label>
  <ol id="ingredientes">
    <li>
      <input type="text" name="ingredient[]">
    </li>
    <li>
      <input type="text" name="ingredient[]">
    </li>
    <button type="button" id="add-ingrediente">Agregar ingrediente</button>
</ol>

  <br><label for="descripcion">Describe la receta</label><br>
  <textarea type="text" id="descripcion" name="descripcion"></textarea>

<br><input type="submit">
</form>
</div>
<script>
  const addIngredientButton = document.querySelector('#add-ingrediente');
  const ingredientsList = document.querySelector('#ingredientes');
  addIngredientButton.addEventListener('click', function() {
    const newIngredient = document.createElement('li');
    newIngredient.innerHTML = '<input type="text" name="ingredient[]">';
    ingredientsList.appendChild(newIngredient);
  });
    </script>

<script src="menuham.js"></script>
<script>
  const formIcon = document.querySelector('#form-icon');
  const formContainer = document.querySelector('#form-container');
  
  formIcon.addEventListener('click', function() {
    if (formContainer.style.display === 'none') {
      formContainer.style.display = 'block';
    } else {
      formContainer.style.display = 'none';
    }
  });
</script>



