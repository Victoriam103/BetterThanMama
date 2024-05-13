<?php
$dbhost="localhost";
  $dbuser="admin";
  $dbpass="admin";
  $dbname="Usuarios";

  $conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  if(!conn)
  {
    die("no hay conexion".mysqli_connect_error());
  }
?>