<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Autentificacion</title>
</head>
<body>
<?php
//base de datos
$servername="localhost";
$database="Usuarios";
$username="admin";
$contrasena="admin";
//obtencion de datos del cliente
$nombre= $_POST['nombre'];
$apellidos=$_POST['apellidos'];
$edad=$_POST['edad'];
$genero=$_POST['genero'];
$email=$_POST['email'];
$clave=$_POST['clave1'];
$claveconfirm=$_POST['clave2'];
$peso=$_POST["peso"];
$altura=$_POST["altura"];
$objetivo=$_POST["objetivo"];

//confirmar que las claves son iguales

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $clave = $_POST['clave1'];
  $claveconfirm = $_POST['clave2'];

  if ($clave != $claveconfirm) {
    echo "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
    header('Location: formulario.php');
    exit;
  }
}
  // Procesar los datos del formulario si la confirmación de contraseña es correcta.

//conectarse a la base de datos
$conexion= mysqli_connect($servername, $username, $contrasena, $database);

// Verificar la conexión
if (!$conexion) {
  die("Error de conexión: " . mysqli_connect_error());
}

//Insertando valores en la tabla 
$sql= "INSERT INTO datos (NombreCompleto, apellidos, edad, genero, email, contrasena, peso, altura, objetivo) values
 ('$nombre', '$apellidos', '$edad', '$genero', '$email', '$clave', '$peso', '$altura', '$objetivo')";
if (mysqli_query($conexion, $sql)) {
  echo "Registro agregado correctamente";
} else {
  echo "Error al agregar el registro: " . mysqli_error($conexion);
}

?>
<button><a href="excluir_alimentos.php"> Completa tu información </button>


</body>
</html>