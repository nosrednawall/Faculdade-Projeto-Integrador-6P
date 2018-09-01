
<?php 
include("template/cabecalho.php"); 
?>

<p class="alert alert-success"> <?php 
echo 'Hello ' . htmlspecialchars($_POST["consumo-mensal"]) . '!';
?></p>

<?php include("template/rodape.php"); ?>