<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> recuperar contrasena</title>
    <link rel="stylesheet" href="recuperar.css"></link>
    <script src="cookie.js"></script>
</head>

<?php
include "conexion.php";
if(!conn)
{
  die("no hay conexion".mysqli_connect_error());
}
// CONFIRMAR QUE EL FORMULARIO SE HA ENVIADO
if (isset($_POST['submit'])) {
    // Get the email address
    $email = $_POST['email'];

    // CONFIRMAR LA EXISTENCIA DEL EMAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Dirección de correo electrónico no válida";
    } else {
        // CONFIRMAR QUE EL EMAIL EXISTE DENTRO DE LA BASE DE DATOS
        $sql = "SELECT * FROM datos WHERE Email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) == 0) {
            $error = "No hay ninguna cuenta registrada con esa dirección de correo electrónico";
        } else {
            //GENERAR LINK DE RESETEO DE CONTRASEÑA
            $reset_password_link = generateResetPasswordLink($email);

            //ENVIAR EL LINK A LOS SEÑORES USUARIOS
            $subject = "Solicitud de restablecimiento de contraseña";
            $message = "Haz clic en el siguiente enlace para restablecer tu contraseña:\n\n" . $reset_password_link;
            $headers = "From: no-reply@example.com";
            if (mail($email, $subject, $message, $headers)) {
                $success = "Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña";
            } else {
                $error = "Error al enviar el correo electrónico. Por favor, inténtalo de nuevo más tarde.";
            }
        }
    }
}

// ESTA FUNCION ES LA QUE NOS VA A GENERAR EL LIINK DE RESETEO DE CONTRASEÑA
function generateResetPasswordLink($email) {
    // GENERAR TOKEN UNICO
    $token = bin2hex(random_bytes(16));

    // GUARDA UN TOKEN TEMPORALMENTE EN LA BASE DE DATOS
    $sql = "UPDATE users SET reset_password_token = ? WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $token, $email);
    mysqli_stmt_execute($stmt);

    // GENERAR LINK DE RESETEO
    $reset_password_link = "http://www.example.com/reset_password.php?token=" . $token;
    return $reset_password_link;
    }
    ?>
    <h1> RECUPERACION DE CONTASEÑA </h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="email" name="email" placeholder="Ingresa tu dirección de correo electrónico">
        <input type="submit" name="submit" value="Enviar enlace de restablecimiento de contraseña">
    </form>
   <?php if(isset ($success)): echo "$success";
   endif;
   if(isset ($error)): echo "$error";
endif; ?>
 <script src="cookie.js"></script>

</html>
