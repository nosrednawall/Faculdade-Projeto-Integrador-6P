<?php
require_once 'painel-solar.php';
 
$painel = new PainelSolar("0");
echo $painel->potencia;
echo $painel->descricao;
echo $painel->altura;


// class AcessaPainel{
//     function imprimeUsuario(){
//         $painel = new PainelSolar("330");
//         echo $painel->potencia;
//         echo $painel->descricao;
//         echo $painel->altura;
//     }
// }

// echo"ola mundo<br>";
//   $resultadoEmJson = shell_exec('python teste.py');
//   echo "$resultadoEmJson";
  
//   $resultado($resultadoEmJson);
  
//   print_r($resultadoEmJson);



?> 
