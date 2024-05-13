<!DOCTYPE html>
<html>
  <head>
    <title>Formulario de comentarios</title>
    <link rel="stylesheet" href="comentarios.css">
  </head>
  <body>
    <header>
      <?php include "menuham.php"; ?>
    </header>
    <main>
      <h1>¡Comenta tus recetas favoritas!</h1>
      <form method="post" action="guardar_comentario.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $usuarioingresado; ?>">
        <label for="recipe">Receta:</label>
        <select id="recipe" name="recipe">
          <?php
            include "conexion.php";
            $sql = "SELECT id, name, recipe FROM recipes";
            $recipe = mysqli_query($conn, $sql);

            // Genera el código HTML para el menú desplegable con las opciones de recetas
            while ($row = mysqli_fetch_assoc($recipe)) {
              echo "<option value=\"" . $row["id"] . "\">" . $row["name"] . " - " . $row["recipe"] . "</option>";
            }

            mysqli_close($conn);
          ?>
        </select>
        <label for="comentario">Comentario:</label>
        <textarea id="comentario" name="comentario"></textarea>
        <input type="submit" value="Enviar">
      </form>
    </main>
    <script src="cookie.js"></script>
  </body>
</html>
