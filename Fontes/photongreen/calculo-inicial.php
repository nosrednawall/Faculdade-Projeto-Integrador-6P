
<?php include("template/cabecalho.php"); ?>

<?php 

    for($i= 0; $i <10; $i++){
        echo"</br><input type='submit' value='Olá eu sou apenas um botão' class='btn' />";
        echo $i;
        echo"</br>";
    }

?>

<?php include("template/rodape.php"); ?>
<?php 
$cep = $_POST("cep");
echo $cep;
$consumoMensal = $_POST("consumo-mensal");
$qtdaDispositivos = $_POST("qtda-dispositivos");

?>

<p class="alert alert-success" role="alert">
    O seu CEP é: <?= $cep?>, Consumo mensal é: <?= $consumoMensal?> e a quantidade de dispositivos são: <?= $qtdaDispositivos?> 
</p>

<?php include("template/rodape.php"); ?>