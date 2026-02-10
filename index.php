<?php 
require_once 'config/database.php';
require_once 'classes/calculadora.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Calculadora IMC</title>
</head>
<body>
  <div class="container">

    <h1>Calculadora IMC</h1>
    <p>Acompanhe suas métricas de saúde de forma simples.</p>

    <form action="calcular.php" method="POST">
      <input type="number" name="peso" placeholder="Peso (kg)">
      <input type="number" name="altura" placeholder="Altura (cm)">
      <button type="submit">Calcular</button>
    </form>


    <h3>Seu resultado:</h3>
    <span>20</span>
    <p>Peso Normal</p>

    <div class="infos">
      <div>barra</div>
      <p>Desnutrido</p>
      <p>Normal</p>
      <p>Alguma coisa</p>
      <p>Obeso</p>
    </div>
  </div>
</body>
</html>