
<html>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>INICIA SESION</title>
        <link rel="stylesheet" href="login.css">

      </head>
        <body>
        <header>
<?php include "menuham.php" ?>
<script src="cookie.js"></script>
</header>
              <div class="wrapper">
                <span class="icon-close"><ion-icon name="close-circle"></ion-icon></span>
              <div class="form-box login">
                <h2>login</h2>
                <form method="POST">
                  <div class="input-box"> 
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" required name="email">
                    <label>Email</label>
                  </div>
                  <div class="input-box"> 
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" required name="contrasena">
                    <label>password</label>
                  </div>
                  <div class="remember-forgot">
                    <label><input type="checkbox">
                      Recordarme</label>
                    <div>
                    <a href="recuperar.php">Te olvidaste la contraseña?</a>
                    </div>
                  </div>
                  <button type="submit" class="btn" name="login">Login</button>
                  <div class="login-register">
                    <p> No tienes cuenta?  <a href="registro.php" class="register-link">Registrate</a></p>
                  </div>
                </form>
              </div>
              </div>
        </body>
      <script> src="script.js"</script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>

<?php
session_start();
if(isset($_SESSION['email']))
{
  header('location: index.php');
}


if (isset($_POST['login'])) 
{
  $dbhost="localhost";
  $dbuser="admin";
  $dbpass="admin";
  $dbname="Usuarios";

  $conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  if(!conn)
  {
    die("no hay conexion".mysqli_connect_error());
  }
  $email=$_POST['email'];
  $pass=$_POST['contrasena'];
  $query=mysqli_query($conn,"SELECT * FROM datos WHERE Email='".$email."' AND contrasena='".$pass."'");
$nr=mysqli_num_rows($query);
if(!isset($_SESSION['email']))
{
  if($nr==1)
  {
    $_SESSION['email']=$email;
    header("location: index.php");
  } 

  else if(nr==0)
  {
    echo "<script>alert('El usuario no existe');window.location='registro.php'</script>";
  }
}
}
?>

