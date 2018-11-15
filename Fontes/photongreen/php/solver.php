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

    //verifica se a solicitacao não está vazia
    if(isset($solicitacaoCalculo) && !empty($solicitacaoCalculo))
    {   
        //atribui as variaveis os valores informados pelo usuário
        $meta_energia = $solicitacaoCalculo->valorKw;
        $area_informada = $solicitacaoCalculo->areaInformada;
        $valor_maximo =$solicitacaoCalculo->valorMaximo;

        //efetua o solver preliminar de cada painel
        $resultadoPlaca250 = resolverSolver($painel250, $meta_energia,$area_informada);
        $resultadoPlaca270 = resolverSolver($painel270, $meta_energia,$area_informada);
        $resultadoPlaca325 = resolverSolver($painel325, $meta_energia,$area_informada);
        $resultadoPlaca330 = resolverSolver($painel330, $meta_energia,$area_informada);



        //gera o json de retorno para o javascript
        $saida = array(
            '250' => $resultadoPlaca250,
            '270' => $resultadoPlaca270,
            '325' => $resultadoPlaca325,
            '330' => $resultadoPlaca330
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
        $solucao = shell_exec('python solver-preliminar.py '.$painelEscolhido->preco.' '.$area_informada.' '.
                                $painelEscolhido->tamanho_painel.' '.$meta_energia.' '.$painelEscolhido->potencia);
        return $solucao;
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
