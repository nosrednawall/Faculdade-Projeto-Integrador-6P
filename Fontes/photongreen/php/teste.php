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

$p = "1500";
$resultadoEmJson = shell_exec('python solver.py '. $p);
echo $resultadoEmJson;
// $resultado = json_decode($resultadoEmJson);
// echo"$resultado";
?> 
