<!DOCTYPE html>
<html>
  <head>
    <title>Formulario de comentarios</title>
    <link rel="stylesheet" href="menuham.css">
<header>
      <button class="menu-btn">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="menu-container">
        <ul>      
          <li><a href="registro.php">Registrate</a></li>
          <li><a href="loginERAHTML.php">Inicia sesion</a></li>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="aporteusuario.php">Foro recetas</a></li>
          <li><a href="generarplanilla.php">Tus recetas</a></li>
          <li><a href="listacompra.php">Lista de la compra</a></li>
          <li><a href="somos.php">Quienes somos</a></li>
          <li><a href="contacto.html">Contacto</a></li>
          <li><a href="excluir_alimentos.php">Actualiza tus alimentos</a></li>
          <li><button id="cerrar-menu">Cerrar menú</button></li>
        </ul>
      </div>
      <?php
        session_start();
        if (isset($_SESSION['email'])) {
          $usuarioingresado = $_SESSION["email"];
          echo "<h1>Bienvenido: $usuarioingresado</h1>";
          echo "<form method='POST' action='cerrarsesion.php'>
                <input type='submit' value='cerrarsesion' name='btncerrar'/>
              </form>";
        } else {
          echo "<h3>Debes iniciar sesión para acceder al contenido</h3>";
        }
      ?>
    </header>
    <script src="menuham.js "></script>