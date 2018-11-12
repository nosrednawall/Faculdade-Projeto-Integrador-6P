<?php

echo"ola mundo<br>";
  $resultadoEmJson = shell_exec('python teste.py');
  echo "$resultadoEmJson";
  
  $resultado($resultadoEmJson);
  
  print_r($resultadoEmJson);

?> 
