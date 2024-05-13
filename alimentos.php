<?php
class Alimento {
  private $id;
  private $nombre;
  private $grupo;
  private $calorias;
  private $proteinas;
  private $grasas;
  private $carbohidratos;
  private $Fibra;

  public function __construct($id, $nombre, $grupo, $calorias, $proteinas, $grasas, $carbohidratos, $Fibra) {
    $this->id=$id;
    $this->nombre = $nombre;
    $this->grupo=$grupo;
    $this->calorias = $calorias;
    $this->proteinas = $proteinas;
    $this->grasas = $grasas;
    $this->carbohidratos = $carbohidratos;
    $this->Fibra=$Fibra;
  }


  // Método para insertar el alimento en la base de datos
  public function insertarEnBD() {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "Alimentos";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
      die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para insertar el alimento


    $sql = "INSERT INTO alimentos (id, nombre, grupo, calorias, proteinas, grasas, carbohidratos, Fibra)
            VALUES ('$this->id', '$this->nombre', '$this->grupo', '$this->calorias', '$this->proteinas', '$this->grasas', '$this->carbohidratos', '$this->Fibra')";
    

    // Ejecutar consulta
    if ($conn->query($sql) === TRUE) {
      echo "El alimento se ha insertado correctamente en la base de datos.";
    } else {
      echo "Error al insertar alimento: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
  }
}

$alimento = new Alimento(19, "tomate", "verdura", 19, 0.9, 0.1, 3.5, 1);
;$alimento->insertarEnBD();
?>