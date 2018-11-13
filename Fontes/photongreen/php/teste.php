<?php

// echo"ola mundo<br>";
//   $resultadoEmJson = shell_exec('python teste.py');
//   echo "$resultadoEmJson";
  
//   $resultado($resultadoEmJson);
  
//   print_r($resultadoEmJson);


require_once 'painel-solar.php';
 
class AcessaPainel{
    function imprimeUsuario(){
        $painel = new PainelSolar("250");
        echo $painel->potencia;
        echo $usuario->descricao;
        echo $usuario->altura;
    }
}

?> 
