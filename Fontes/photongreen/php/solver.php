 <?php
    require_once('painel-solar.php');
    


    $saida = array(
        'mensagem' => "ola mundo",
        'paineis' => "60",
        'preco' => "12370.89"
    );
    echo json_encode($saida);
 ?>
