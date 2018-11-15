 <?php
    require_once('painel-solar.php');

    //cria as os paineis
    $painel250 = new PainelSolar("250");
    $painel270 = new PainelSolar("270");
    $painel325 = new PainelSolar("325");
    $painel330 = new PainelSolar("330");

    //cria as variaveis que serão utilizadas para guardar as constantes enviadas pelo usuário
    $valor_maximo = '';
    $area_informada = '';
    $meta_energia = '';

    // recebe as variaveis do javascript
    $solicitacaoCalculo = json_decode(file_get_contents("php://input"));
    if(isset($solicitacaoCalculo) && !empty($solicitacaoCalculo))
    {   
        // $solicitacaoCalculo  = json_decode($solicitacaoCalculoJson);

        $meta_energia = $solicitacaoCalculo->valorKw;
        $area_informada = $solicitacaoCalculo->areaInformada;
        $valor_maximo =$solicitacaoCalculo->valorMaximo;

        $resultadoPlaca250 = resolverSolver($painel250, $meta_energia,$area_informada,$valor_maximo);
        $resultadoPlaca270 = resolverSolver($painel270, $meta_energia,$area_informada,$valor_maximo);
        $resultadoPlaca325 = resolverSolver($painel325, $meta_energia,$area_informada,$valor_maximo);
        $resultadoPlaca330 = resolverSolver($painel330, $meta_energia,$area_informada,$valor_maximo);

        $saida = array(
            '250' => $resultadoPlaca250,
            '270' => $resultadoPlaca270,
            '325' => $resultadoPlaca325,
            '330' => $resultadoPlaca330
        );
        echo json_encode($saida);
    }else{
        $saida = array(
            'erro' => "Nao conseguiu ler a variavel"
        );
        echo json_encode($saida);
    }
    //executa os solvers
     


    // $tamanho_painel = 1.8;
    // $valor_painel = $painel250->preco;
    // $potencia_painel = $painel250->potencia;

    function resolverSolver($painelEscolhido,$meta_energia,$area_informada,$valor_maximo){
        $solucao = shell_exec('python solver.py '. $valor_maximo .' '.$painelEscolhido->preco.' '.$area_informada.' '.
                                $painelEscolhido->tamanho_painel.' '.$meta_energia.' '.$painelEscolhido->potencia);
        return $solucao;
    }

    // $resultadoPlaca250 = shell_exec('python solver.py '. $valor_maximo .' '.$valor_painel.' '.$area_informada.' '.
    //                             $tamanho_painel.' '.$meta_energia.' '.$potencia_painel);
    // echo $resultadoPlaca250;

    // $valor_painel = $painel270->preco;
    // $potencia_painel = $painel270->potencia;

    // $resultadoPlaca270 = shell_exec('python solver.py '. $valor_maximo .' '.$valor_painel.' '.$area_informada.' '.
    //                             $tamanho_painel.' '.$meta_energia.' '.$potencia_painel);

    // $valor_painel = $painel325->preco;
    // $potencia_painel = $painel325->potencia;

    // $resultadoPlaca325 = shell_exec('python solver.py '. $valor_maximo .' '.$valor_painel.' '.$area_informada.' '.
    //                                  $tamanho_painel.' '.$meta_energia.' '.$potencia_painel);

    // $valor_painel = $painel330->preco;
    // $potencia_painel = $painel330->potencia;

    // $resultadoPlaca330 = shell_exec('python solver.py '. $valor_maximo .' '.$valor_painel.' '.$area_informada.' '.
    //                                 $tamanho_painel.' '.$meta_energia.' '.$potencia_painel); 

    echo $resultadoPlaca250;

    // echo $resultadoPlaca270;

    // echo $resultadoPlaca325;

    // echo $resultadoPlaca330;
    //verifica qual é o melhor

    // envia os dados para o javascript via ajax

 ?>
