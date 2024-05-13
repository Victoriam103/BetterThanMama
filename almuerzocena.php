<?php

$cenayalmuerzo = array(
    array('id' => '4','nombre' => 'carne de res magra','grupo' => 'carnes y aves','calorias' => '250','proteinas' => '26.1','grasas' => '15.5','carbohidratos' => '0'),
    array('id' => '5','nombre' => 'pechuga de pollo','grupo' => 'carnes y aves','calorias' => '165','proteinas' => '31','grasas' => '3.6','carbohidratos' => '0'),
    array('id' => '6','nombre' => 'atun','grupo' => 'pescado y marisco','calorias' => '90','proteinas' => '20','grasas' => '0.5','carbohidratos' => '0'),
    array('id' => '7','nombre' => 'lentejas','grupo' => 'legumbres','calorias' => '353','proteinas' => '24','grasas' => '1.1','carbohidratos' => '63.4'),
    array('id' => '8','nombre' => 'garbanzos','grupo' => 'legumbres','calorias' => '364','proteinas' => '19','grasas' => '6','carbohidratos' => '61'),
    array('id' => '9','nombre' => 'arroz integral','grupo' => 'cereales','calorias' => '111','proteinas' => '2.6','grasas' => '0.9','carbohidratos' => '8'),
    array('id' => '10','nombre' => 'pan integral','grupo' => 'cereales','calorias' => '250','proteinas' => '8','grasas' => '4','carbohidratos' => '23.5'),
    array('id' => '14','nombre' => 'alubia blanca','grupo' => 'legumbres','calorias' => '67','proteinas' => '6','grasas' => '0.7','carbohidratos' => '13'),
    array('id' => '15','nombre' => 'pavo filetes','grupo' => 'carnes y aves','calorias' => '110','proteinas' => '23','grasas' => '2','carbohidratos' => '0'),
    array('id' => '16','nombre' => 'merluza','grupo' => 'pescado y marisco','calorias' => '72','proteinas' => '11.93','grasas' => '2.5','carbohidratos' => '0'),
    array('id' => '17','nombre' => 'quinoa','grupo' => 'cereales','calorias' => '370','proteinas' => '14','grasas' => '1.1','carbohidratos' => '64'),
    array('id' => '18','nombre' => 'patata','grupo' => 'verdura','calorias' => '88','proteinas' => '2.2','grasas' => '0.3','carbohidratos' => '15.2'),
    array('id' => '19','nombre' => 'tomate','grupo' => 'verdura','calorias' => '19','proteinas' => '0.9','grasas' => '0.1','carbohidratos' => '3.5'),
    array('id' => '20','nombre' => 'pasta integral','grupo' => 'cereales','calorias' => '347','proteinas' => '13.4','grasas' => '2.5','carbohidratos' => '66.2')
  );
  
  // Calculamos cuántas calorías deben ser de proteínas, carbohidratos y grasas
$protein_calories = $almuerzo * 0.5;
$carb_calories = $almuerzo * 0.35;
$fat_calories = $almuerzo * 0.15;

// Convertimos las calorías de cada macronutriente en gramos
$protein_grams = $protein_calories / 4; // 1 g de proteína tiene 4 kcal
$carb_grams = $carb_calories / 4; // 1 g de carbohidratos tiene 4 kcal
$fat_grams = $fat_calories / 9; // 1 g de grasa tiene 9 kcal

// Generamos una receta aleatoria
$recipe = array();

while (count($recipe) < 4) { 
  $ingredient = $cenayalmuerzo[array_rand($cenayalmuerzo)]; // Seleccionamos un ingrediente aleatorio del array $cenayalmuerzo
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
 class MenuSemanal3{
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
  $query = "INSERT INTO menu_semanal2 ( Email, nombre, grupo, calorias, proteinas, grasas, carbohidratos) 
        VALUES ( '$usuarioingresado', '{$receta['nombre']}', '{$receta['grupo']}', '{$receta['calorias']}', '{$receta['proteinas']}', '{$receta['grasas']}', '{$receta['carbohidratos']}')";

  if (mysqli_query($this->conn, $query)) {
      return true;
  } else {
      return false;
  }
}
}

// Crear una instancia de la clase MenuSemanal
$menu = new MenuSemanal3($dbhost, $dbuser, $dbpass, $dbname);

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
  
