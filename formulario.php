<!DOCTYPE html>
<html lang="es" dir="ltr">
<header>
  <?php
  include "menuham.php";
  ?>
<body>
<?php
if(isset($_POST['email'])) {

    $email_to = "cowandsword@gmail.com";
    $email_subject = "Contacto desde better than mamma";
    
    if(!isset($_POST['nombre']) ||
    !isset($_POST['email']) ||
    !isset($_POST['telefono']) ||
    !isset($_POST['mensaje'])) {
    
    echo "<b>Ocurrio un error y el formulario no ha sido enviado. </b><br />";
    echo "Por favor, vuelva atras y verifique la información ingresada<br />";
    die();
    }
    
    $email_message = "Detalles del formulario de contacto:\n\n";
    $email_message .= "Nombre: " . $_POST['nombre'] . "\n";
    $email_message .= "E-mail: " . $_POST['email'] . "\n";
    $email_message .= "Teléfono: " . $_POST['telefono'] . "\n";
    $email_message .= "Comentarios: " . $_POST['mensaje'] . "\n\n";
    
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    
    echo "¡El formulario se ha enviado con éxito!";
    }
    ?>

</body>
<script src="cookie.js"></script>
<script src="menuham.js"></script>

<div id="cookieBanner" style="position:fixed;bottom:0;left:0;width:100%;background-color:#f1f1f1;padding:10px;text-align:center;z-index:10000;display:none;">
  Utilizamos cookies para mejorar su experiencia en nuestro sitio web. Al continuar utilizando nuestro sitio, acepta nuestra política de cookies.
  <button onclick="aceptarCookies();">Aceptar</button>
  <button onclick="rechazarCookies();">Rechazar</button>
</div>
</html>