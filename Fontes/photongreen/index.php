
<?php include("template/cabecalho.php"); ?>
<article class="container">
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <div class="principal">
                    <h1>Titulo Site</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <form class="form" action="calculo-inicial.php" method="post">

                <div class="form-group">
                    <input type="text" name="consumo-mensal" id="consumoMensal" placeholder="Qual é o seu Consumo mensal?" class="form-control"/>
                </div>
                <div class="form-group">
                    <input type="text" name="qtda-dispositivos" id="qtdaDispositivos" placeholder="Quantos dispositivos possui?"  class="form-control"/>
                </div>
                <div class="form-group">
                    <input type="text" name="cep" id="cep" placeholder="Informe seu CEP" class="form-control"/>
                </div>
                <input type="submit" value="Calcular" class="btn" />
                
            </form>
        </div>
    </div>
</article>
<?php include("template/rodape.php"); ?>
