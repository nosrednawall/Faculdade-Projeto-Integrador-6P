<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<title>Calculo</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/calcular.css"/>
</head>
	
<body ng-controller="myCtrl" class="container-fluid">

	<?php include("template/cabecalho.php"); ?>

	<section class="row">
		<div class="col-2 col-sm-2"></div>
		<article class="col-8 col-sm-8" >
			
			<h2>SIMULADOR SOLAR - CALCULADORA SOLAR FOTOVOLTAICA</h2>
			<!-- Vai verificar se utilizar a geolocalização ou pelos bairros -->
			<form>
				<div class="form-group">
					<label for="estado-escolhido" class="descricao">Informe seu estado</label>			
					<select id="estado-escolhido" class="form-control" ng-model="sgEstado" ng-options="x.model for x in EstadosSG"></select>
				</div>

				<div class="form-group">
					<label for="cidade-escolhida" class="descricao">Informe sua cidade</label>
					<select id="cidade-escolhida" class="form-control" ng-model="nmCidade" ng-options="x.model for x in CidadesEstado | filter:{idEstado:sgEstado.id}" enabled="false"></select>		
				</div>

				<div class="form-group">
					<label for="consumo-informado" class="descricao">Consumo médio mensal kWh/Mês?</label>
					<input id="consumo-informado" class="form-control" ng-model="vlGastoMensalKw">		
				</div>

				<div class="form-group">
					<label for="area-disponivel" class="descricao">Informe a sua área disponível para instalação das placas</label>
					<input id="area-disponivel" class="form-control" ng-model="areaDisponivel" >
				</div>

				<button ng-click="EfetuarCalculo()" class="btn btn-primary btn-lg">Calcular</button>	
			</form>

			
			<div class="resultado">
				<div class="tituloResultado">PLACA FOTOVOTAICA</div>
				Incidência solar da região: {{noIncidencia}}<br>
				Comsumo gasto kWh/Dia: {{calculokWh}}<br>
				Potencia gerado kWp/Dia: {{calculokWp}}<br>
				Quantidade de placas fotovotaicas: {{qtPaineis}}<br>
				Potencia do painel: {{noPotenciaPainel}}W
			</div>		
			<div class="resultado">
				<div class="tituloResultado">ESCOLHA DO INVERSOR</div>
				Potência mínima: {{noPotenciaMinima}}<br>
				Potência máxima: {{noPotenciaMaxima}}<br>
				Recomendado: {{noPotenciaRecomendada}}<br>
			</div>
			<div class="resultado">
				<div class="tituloResultado">Recomendação da Placa</div>
				Potência da placa recomendada: {{potenciaPlacaRecomendada}}<br>
			</div>	
			<div class="resultado">
				<div class="tituloResultado">Recomendação da Placa</div>
				Potência da placa recomendada: {{testeA}}<br>
			</div>
		
		</article>
		<div class="col-2 col-sm-2"></div>
	</section><!--/row -->

	<!-- Scripts -->
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="./js/angular.min.js"></script>
	<script type="text/javascript" src="./js/jquery.min.js"></script>
	<script type="text/javascript" src="./js/calculo.js"></script>

	<?php include("template/rodape.php"); ?>

</body>
</html>
