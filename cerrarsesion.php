


<?php
session_start();


if (isset($_SESSION['email'])) {
  unset($_SESSION['email']); // Elimina la variable de sesión 'email'
  session_destroy(); // Destruye de sesión activa
  header('Location: index.php'); // Redirige al usuario a la página de inicio de sesión
  exit();
}


?>

