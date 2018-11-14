 <?php
    header('Cache-Control: no-cache, must-revalidate');
    require_once('painel-solar.php');
    //cria as os paineis
    $painel250 = new PainelSolar("250");
    $painel270 = new PainelSolar("270");
    $painel325 = new PainelSolar("325");
    $painel330 = new PainelSolar("330");

    // recebe as variaveis do javascript

    $payload = var_dump(file_get_contents('php://input'));
    // $payload = json_decode(file_get_contents('php://input'));

    // echo "$payload";
    // $potenciaEmKwts = $payload->valorkW;

    // echo $potenciaEmKwts;
    

    //executa os solvers

    //verifica qual é o melhor

    // envia os dados para o javascript via ajax
    $saida = array(
        'potencia' => 'teste'
    );
    echo json_encode($saida);
 ?>
