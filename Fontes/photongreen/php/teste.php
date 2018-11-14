<?php
// require_once 'painel-solar.php';
 
// $painel = new PainelSolar("330");
// echo $painel->potencia;
// echo $painel->descricao;
// echo $painel->altura;
// echo " ";
// echo $painel->preco;

// class AcessaPainel{
//     function imprimeUsuario(){
//         $painel = new PainelSolar("330");
//         echo $painel->potencia;
//         echo $painel->descricao;
//         echo $painel->altura;
//     }
// }

$valor_maximo = 15000;
$valor_painel = 690;
$area_informada = 20;
$tamanho_painel = 1.6;
$meta_energia = 2000;
$potencia_painel = 250;

$resultadoEmJson = shell_exec('python solver.py '. $valor_maximo .' '.$valor_painel.' '.$area_informada.' '.
                                $tamanho_painel.' '.$meta_energia.' '.$potencia_painel);
echo $resultadoEmJson;
// $resultado = json_decode($resultadoEmJson);
// echo"$resultado";
?> 
