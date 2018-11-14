 <?php
    require_once('painel-solar.php');

    //cria as os paineis
    $painel250 = new PainelSolar("250");
    $painel270 = new PainelSolar("270");
    $painel325 = new PainelSolar("325");
    $painel330 = new PainelSolar("330");

    // recebe as variaveis do javascript
    $solicitacaoCalculo = json_decode(file_get_contents("php://input"));
    if(isset($solicitacaoCalculo) && !empty($solicitacaoCalculo))
    {   
        // $solicitacaoCalculo  = json_decode($solicitacaoCalculoJson);

        $valorkW = $solicitacaoCalculo->valorKw;

        $saida = array(
            'potencia' => $valorkW
        );
        echo json_encode($saida);
    }else{
        $saida = array(
            'erro' => "Nao conseguiu ler a variavel"
        );
        echo json_encode($saida);
    }
    //executa os solvers
     
    $valor_maximo = 15000;
    $area_informada = 20;
    $tamanho_painel = 1.8;
    $meta_energia = 2000;

    $valor_painel = $painel250->preco;
    $potencia_painel = $painel250->potencia;


    $resultadoPlaca250 = shell_exec('python solver.py '. $valor_maximo .' '.$valor_painel.' '.$area_informada.' '.
                                $tamanho_painel.' '.$meta_energia.' '.$potencia_painel);
    echo $resultadoPlaca250;

    $valor_painel = $painel270->preco;
    $potencia_painel = $painel270->potencia;

    $resultadoPlaca270 = shell_exec('python solver.py '. $valor_maximo .' '.$valor_painel.' '.$area_informada.' '.
                                $tamanho_painel.' '.$meta_energia.' '.$potencia_painel);

    $valor_painel = $painel325->preco;
    $potencia_painel = $painel325->potencia;

    $resultadoPlaca325 = shell_exec('python solver.py '. $valor_maximo .' '.$valor_painel.' '.$area_informada.' '.
                                     $tamanho_painel.' '.$meta_energia.' '.$potencia_painel);

    $valor_painel = $painel330->preco;
    $potencia_painel = $painel330->potencia;

    $resultadoPlaca330 = shell_exec('python solver.py '. $valor_maximo .' '.$valor_painel.' '.$area_informada.' '.
                                    $tamanho_painel.' '.$meta_energia.' '.$potencia_painel); 

    echo $resultadoPlaca250;

    echo $resultadoPlaca270;

    echo $resultadoPlaca325;

    echo $resultadoPlaca330;
    //verifica qual é o melhor

    // envia os dados para o javascript via ajax

 ?>
