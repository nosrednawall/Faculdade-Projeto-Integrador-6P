 <?php
    require_once('painel-solar.php');
    require_once('inversor.php');

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

    //verifica se a solicitacao não está vazia
    if(isset($solicitacaoCalculo) && !empty($solicitacaoCalculo)){   
        //atribui as variaveis os valores informados pelo usuário
        $meta_energia = $solicitacaoCalculo->valorKw;
        $area_informada = $solicitacaoCalculo->areaInformada;
        $valor_maximo =$solicitacaoCalculo->valorMaximo;


        //efetua o solver preliminar de cada painel
        $resultadoPlaca250Json = resolverSolver($painel250, $meta_energia,$area_informada);
        $resultadoPlaca270Json = resolverSolver($painel270, $meta_energia,$area_informada);
        $resultadoPlaca325Json = resolverSolver($painel325, $meta_energia,$area_informada);
        $resultadoPlaca330Json = resolverSolver($painel330, $meta_energia,$area_informada);

        //aplica o encode de utf8
        $resultadoPlaca250Utf = utf8_encode($resultadoPlaca250Json);
        $resultadoPlaca270Utf = utf8_encode($resultadoPlaca270Json);
        $resultadoPlaca325Utf = utf8_encode($resultadoPlaca325Json);
        $resultadoPlaca330Utf = utf8_encode($resultadoPlaca330Json);

        //efetua o decode
        $resultadoPlaca250 = json_decode($resultadoPlaca250Utf);
        $resultadoPlaca270 = json_decode($resultadoPlaca270Utf);
        $resultadoPlaca325 = json_decode($resultadoPlaca325Utf);
        $resultadoPlaca330 = json_decode($resultadoPlaca330Utf);

        //verifica qual é o melhor resultado
        $melhorResultado = verificaQualEOAMelhorSolucao($valor_maximo,$inversor,$resultadoPlaca250,$resultadoPlaca270,$resultadoPlaca325,$resultadoPlaca330);
        
        //gera o inversor necessário
        $inversor = new Inversor($meta_energia);
        $inversor->quantidade = $melhorResultado->inversorQuantidade;
        $inversor->precoTotal = $inversor->quantidade * $inversor->preco;

        $investimentoTotal = $inversor->preco + $melhorResultado->placaPrecoTotal;

        //gera o json de retorno para o javascript
        $saida = array(
            'painel' => $melhorResultado,
            'inversor' => $inversor,
            'investimentoTotal' => $investimentoTotal
        );

        //envia os dados para o javascript  
        echo json_encode($saida);

    }else{
        //caso dê erro envia json informando o erro
        $saida = array(
            'erro' => "Nao conseguiu ler a variavel"
        );
        echo json_encode($saida);
    }
    
    //funcao que efetua o solver enviando os dados para o script em python
    function resolverSolver($painelEscolhido,$meta_energia,$area_informada){
        $solucao = shell_exec('python solver-python.py '.$painelEscolhido->preco.' '.$area_informada.' '.
                                $painelEscolhido->tamanho_painel.' '.$meta_energia.' '.$painelEscolhido->potencia);
        return $solucao;
    }

    //um monte de ifs, tenho que melhorar
    function verificaQualEOAMelhorSolucao($valor_maximo,$inversor,$resultadoPlaca250,$resultadoPlaca270,$resultadoPlaca325,$resultadoPlaca330){
        
        if(($resultadoPlaca250->placaPrecoTotal + $inversor->preco)< $valor_maximo){
            return $resultadoPlaca250;

        }else if(($resultadoPlaca270->placaPrecoTotal + $inversor->preco)< $valor_maximo){
            return $resultadoPlaca270;

        }else if(($resultadoPlaca325->placaPrecoTotal + $inversor->preco)< $valor_maximo){
            return $resultadoPlaca325;

        }else if(($resultadoPlaca330->placaPrecoTotal + $inversor->preco)< $valor_maximo){
            return $resultadoPlaca330;
        }else {
            return "ERRO AO GERAR O RESULTADO";
        }
    }





    //historico de tentativas

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

    // echo $resultadoPlaca250;

        
    // $tamanho_painel = 1.8;
    // $valor_painel = $painel250->preco;
    // $potencia_painel = $painel250->potencia;

    // echo $resultadoPlaca270;

    // echo $resultadoPlaca325;

    // echo $resultadoPlaca330;
    //verifica qual é o melhor

    // envia os dados para o javascript via ajax


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

// $valor_maximo = 15000;
// $valor_painel = 690;
// $area_informada = 20;
// $tamanho_painel = 1.6;
// $meta_energia = 2000;
// $potencia_painel = 250;

// $resultadoEmJson = shell_exec('python solver.py '. $valor_maximo .' '.$valor_painel.' '.$area_informada.' '.
//                                 $tamanho_painel.' '.$meta_energia.' '.$potencia_painel);
// echo $resultadoEmJson;
// $resultado = json_decode($resultadoEmJson);
// echo"$resultado";
 ?>
