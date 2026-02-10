<?php 

class Calculadora_imc{
  private $peso;
  private $altura;

  public function __construct($peso, $altura){

    $this->peso = $peso;
    $this->altura = $altura;  

  }

  public function calcular_imc(){

    $alturaMetros = $this->altura / 100; // Converter altura em metros
    $imc = $this->peso / ($alturaMetros * $alturaMetros); // Fórmula do IMC
    return round($imc, 2); // Arredondar para 2 casas decimais

  }

  public function classificar_imc(){

    $imc = $this->calcular_imc();

    if ($imc < 18.5) return "Abaixodo peso";
    if ($imc < 24.9) return "Peso normal";
    if ($imc < 29.9) return "Sobrepeso";  
    return "Obesidade";

  }

}




?>