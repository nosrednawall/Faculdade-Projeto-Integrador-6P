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
    $meta_energia_whatts = '';

    // recebe as variaveis do javascript
    $solicitacaoCalculo = json_decode(file_get_contents("php://input"));

    //verifica se a solicitacao não está vazia
    if(isset($solicitacaoCalculo) && !empty($solicitacaoCalculo)){   
        //atribui as variaveis os valores informados pelo usuário
        $meta_energia_whatts = $solicitacaoCalculo->potenciaTotalEmWatts;
        $area_informada = $solicitacaoCalculo->areaInformada;
        $valor_maximo =$solicitacaoCalculo->valorMaximo;

        //efetua o solver de cada painel
        $resultadoPlaca250 = resolverSolver($painel250, $meta_energia_whatts,$area_informada);
        $resultadoPlaca270 = resolverSolver($painel270, $meta_energia_whatts,$area_informada);
        $resultadoPlaca325 = resolverSolver($painel325, $meta_energia_whatts,$area_informada);
        $resultadoPlaca330 = resolverSolver($painel330, $meta_energia_whatts,$area_informada);

        //verifica qual é o melhor resultado
        $melhorResultado = verificaQualEOAMelhorSolucao($valor_maximo,$inversor,$resultadoPlaca250,$resultadoPlaca270,$resultadoPlaca325,$resultadoPlaca330);
        
        //gera o inversor necessário
        $inversor = new Inversor($meta_energia_whatts);
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
    function resolverSolver($painelEscolhido,$meta_energia_whatts,$area_informada){
        $solucao = shell_exec('python solver-python.py '.$painelEscolhido->preco.' '.$area_informada.' '.
                                $painelEscolhido->tamanho_painel.' '.$meta_energia_whatts.' '.$painelEscolhido->potencia);
        
        $solucaoUtf = utf8_encode($solucao);
        $solucaoDecode = json_decode($solucaoUtf);
        return $solucaoDecode;
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
 ?>
