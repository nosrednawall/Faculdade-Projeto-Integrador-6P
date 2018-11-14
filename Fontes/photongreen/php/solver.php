 <?php
    header('Cache-Control: no-cache, must-revalidate');
    require_once('painel-solar.php');
    //cria as os paineis
    $painel250 = new PainelSolar("250");
    $painel270 = new PainelSolar("270");
    $painel325 = new PainelSolar("325");
    $painel330 = new PainelSolar("330");

    // recebe as variaveis do javascript
    $solicitacaoCalculoJson = file_get_contents("php://input");
    if(isset($solicitacaoCalculoJson) && !empty($solicitacaoCalculoJson))
    {   
        $solicitacaoCalculo  = json_decode($solicitacaoCalculoJson);

        
    }
    //executa os solvers

    //verifica qual é o melhor

    // envia os dados para o javascript via ajax
    $saida = array(
        'potencia' => 'teste'
    );
    echo json_encode($saida);
 ?>
