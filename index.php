<?php
require_once 'config/database.php';
require_once 'classes/calculadora.php';

$resultado = null;
$classificacao = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $peso = $_POST['peso'];
  $altura = $_POST['altura'];

  $calculadora = new Calculadora_imc($peso, $altura);
  $resultado = $calculadora->calcular_imc();
  $classificacao = $calculadora->classificar_imc();

  $sql = "INSERT INTO resultados_imc (peso , altura, valor_imc, classificacao) VALUES (:peso, :altura, :valor_imc, :classificacao)";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':peso' => $peso,
    ':altura' => $altura,
    ':valor_imc' => $resultado,
    ':classificacao' => $classificacao
  ]);
}

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

    <form action="" method="POST">
      <input type="number" name="peso" placeholder="Peso (kg)" value="<?= $peso ?>">
      <input type="number" name="altura" placeholder="Altura (cm)" value="<?= $altura ?>">
      <button type="submit">Calcular</button>
    </form>

    <div class="resultado">

      <h3>Seu resultado:</h3>
      <?php if ($resultado !== null): ?>
        <span> <?= $resultado ?> </span>
        <p> <?= $classificacao ?></p>
      <?php endif; ?>

    </div>

    <div class="infos">
      <div class="barra"></div>
      <p>Abaixo do peso</p>
      <p>Normal</p>
      <p>Sobrepeso</p>
      <p>Obeso</p>
    </div>
  </div>
</body>
</html>