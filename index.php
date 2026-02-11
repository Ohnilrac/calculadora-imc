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
  <link rel="stylesheet" href="Assets/CSS/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  <title>Calculadora IMC</title>
</head>
<body>
  <div class="container">

    <header>
      <h1><span class="verde">Calculadora</span> IMC</h1>
      <p>Acompanhe suas métricas de saúde de forma simples.</p>
    </header>

    <form action="" method="POST">
      <label for="peso">Peso (KG)</label>
      <input type="number" name="peso" placeholder="Informe seu peso" value="<?= $peso ?>" required>
      <label for="altura">Altura (CM)</label>
      <input type="number" name="altura" placeholder="Informe sua altura" value="<?= $altura ?>" required>
      <button type="submit">Calcular</button>
    </form>

    <div class="resultado">

      <?php if ($resultado !== null): ?>
        <h3>Seu resultado:</h3>
        <span> <?= $resultado ?> </span>
      <?php endif; ?>

    </div>

    <div class="infos">
      <div div class="container-barra">
        <div class="barra">
            <div class="segmento abaixo-peso"></div>
            <div class="segmento normal"></div>
            <div class="segmento sobrepeso"></div>
            <div class="segmento obeso"></div>
        </div>

        <?php 
        $posicaoPonteiro = null;

        if ($resultado === null) {
          $posicaoPonteiro = '50%';
        } elseif ($resultado < 18.5) {
          $posicaoPonteiro = '12.5%';
        } elseif ($resultado < 25) {
          $posicaoPonteiro = '37.5%';
        } elseif ($resultado < 30) {
          $posicaoPonteiro = '62.5%';
        } else {
          $posicaoPonteiro = '87.5%';
        }

        ?>

        <div class="ponteiro" style="left: <?= $posicaoPonteiro ?>">▲</div>
      </div>
    
      <div class="legendas">
        <p>Abaixo do peso</p>
        <p>Normal</p>
        <p>Sobrepeso</p>
        <p>Obeso</p>
      </div>
    </div>
  </div>
</body>
</html>