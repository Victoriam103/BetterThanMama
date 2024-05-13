<?php
include 'datos.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
  die("Error de conexión: " . mysqli_connect_error());
}
//Hacemos consultas de insercion, creamos la receta y la guardamos en la basee de datos SOLO PARA DESAYUNO Y MERIENDA
$desaymer = array(
  array('id' => '1','nombre' => 'Manzana','grupo' => 'frutas','calorias' => '52','proteinas' => '0','grasas' => '0','carbohidratos' => '14','fibra' => '2','protagonista' => 'verdurafruta','tipo' => ''),
  array('id' => '2','nombre' => 'pera','grupo' => 'frutas','calorias' => '57','proteinas' => '0','grasas' => '0','carbohidratos' => '15','fibra' => '2','protagonista' => 'verdurafruta','tipo' => ''),
  array('id' => '3','nombre' => 'platano','grupo' => 'frutas','calorias' => '89','proteinas' => '1','grasas' => '0','carbohidratos' => '23','fibra' => '3','protagonista' => 'verdurafruta','tipo' => ''),
  array('id' => '10','nombre' => 'pan integral','grupo' => 'cereales','calorias' => '250','proteinas' => '8','grasas' => '4','carbohidratos' => '24','fibra' => '3','protagonista' => 'hidratos','tipo' => ''),
  array('id' => '11','nombre' => 'aguacate','grupo' => 'frutas','calorias' => '160','proteinas' => '2','grasas' => '12','carbohidratos' => '45','fibra' => '6','protagonista' => 'verdurafruta','tipo' => ''),
  array('id' => '12','nombre' => 'melon','grupo' => 'frutas','calorias' => '34','proteinas' => '1','grasas' => '0','carbohidratos' => '9','fibra' => '6','protagonista' => 'verdurafruta','tipo' => ''),
  array('id' => '13','nombre' => 'ciruela','grupo' => 'frutas','calorias' => '46','proteinas' => '1','grasas' => '0','carbohidratos' => '11','fibra' => '2','protagonista' => 'verdurafruta','tipo' => ''),
  array('id' => '19','nombre' => 'tomate','grupo' => 'verdura','calorias' => '19','proteinas' => '1','grasas' => '0','carbohidratos' => '4','fibra' => '1','protagonista' => 'verdurafruta','tipo' => ''),
  array('id' => '22','nombre' => 'pavofrio','grupo' => 'carnes','calorias' => '81','proteinas' => '14','grasas' => '2','carbohidratos' => '1','fibra' => '0','protagonista' => 'proteinas','tipo' => 'primario')
);



// Definimos las calorías que debe tener la receta
; // El 18% de las calorías totales

// Calculamos cuántas calorías deben ser de proteínas, carbohidratos y grasas
$protein_calories = $desayuno * 0.5;
$carb_calories = $desayuno * 0.35;
$fat_calories = $desayuno * 0.15;

// Convertimos las calorías de cada macronutriente en gramos
$protein_grams = $protein_calories / 4; // 1 g de proteína tiene 4 kcal
$carb_grams = $carb_calories / 4; // 1 g de carbohidratos tiene 4 kcal
$fat_grams = $fat_calories / 9; // 1 g de grasa tiene 9 kcal

// Generamos una receta aleatoria
$recipe = array();

while (count($recipe) < 4) { 
    $ingredient = $desaymer[array_rand($desaymer)]; // Seleccionamos un ingrediente aleatorio del array $desaymer
    $ingredient_grams = rand(50, 150); // Escogemos una cantidad aleatoria de gramos entre 50 y 150
    $calories = $ingredient['calorias'] * $ingredient_grams / 100; // Calculamos las calorías del ingrediente en función de los gramos
    $protein = $ingredient['proteinas'] * $ingredient_grams / 100; // Calculamos las proteínas del ingrediente en función de los gramos
    $carbs = $ingredient['carbohidratos'] * $ingredient_grams / 100; // Calculamos los carbohidratos del ingrediente en función de los gramos
    $fat = $ingredient['grasas'] * $ingredient_grams / 100; // Calculamos las grasas del ingrediente en función de los gramos
    
    // Comprobamos si la receta ya tiene algún ingrediente del mismo grupo que el ingrediente actual
    $group = $ingredient['grupo'];
    $group_ingredients = array_column($recipe, 'grupo');
    if (!in_array($group, $group_ingredients)) {
        // Si no tiene ningún ingrediente del mismo grupo, añadimos el ingrediente a la receta
        $recipe[] = array(
            'nombre' => $ingredient['nombre'],
            'grupo' => $group,
            'cantidad' => $ingredient_grams,
            'calorias' => $calories,
            'proteinas' => $protein,
            'carbohidratos' => $carbs,
            'grasas' => $fat
        );
     }
}

// Mostramos la receta generada
echo "Receta para desayunar:\n";
foreach ($recipe as $ingredient) {
    echo "{$ingredient['cantidad']} g de {$ingredient['nombre']} ({$ingredient['grupo']})\n";
}

// Definir la clase MenuSemanal
class MenuSemanal{
  public $nombre;
  public $grupo;
  public $cantidad;
  public $calorias;
  public $proteinas;
  public $carbohidratos;
  public $grasas;

 
  function __construct($dbhost, $dbuser, $dbpass, $dbname) {
    $this->conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$this->conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
  }
  
  function insertarReceta($receta) {
    $usuarioingresado = $_SESSION["email"];
    $query = "INSERT INTO menu_semanal ( Email, nombre, grupo, calorias, proteinas, grasas, carbohidratos) 
          VALUES ( '$usuarioingresado', '{$receta['nombre']}', '{$receta['grupo']}', '{$receta['calorias']}', '{$receta['proteinas']}', '{$receta['grasas']}', '{$receta['carbohidratos']}')";

    if (mysqli_query($this->conn, $query)) {
        return true;
    } else {
        return false;
    }
  }
}

// Crear una instancia de la clase MenuSemanal
$menu = new MenuSemanal($dbhost, $dbuser, $dbpass, $dbname);

// Generar una receta aleatoria
$recipe= array(
          
            'nombre' => $ingredient['nombre'],
            'grupo' => $group,
            'cantidad' => $ingredient_grams,
            'calorias' => $calories,
            'proteinas' => $protein,
            'carbohidratos' => $carbs,
            'grasas' => $fat
);

// Insertar la receta en la tabla menu_semanal
if ($menu->insertarReceta($recipe)) {
  echo "La receta se ha insertado correctamente. <br>";
} else {
  echo "Error al insertar la receta: " . mysqli_error($menu->conn);
}



// Cerrar la conexión a la base de datos
mysqli_close($menu->conn);






?>
