<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<title>Calculo</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include("template/css.php"); ?>
</head>
	
<body ng-controller="myCtrl">

	<?php include("template/cabecalho.php"); ?>

	<section class="row container-fluid" >
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

				<button ng-click="EfetuarCalculo()" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Calcular</button>	
			</form>



		
		</article>
		<div class="col-2 col-sm-2"></div>
	</section><!--/row -->

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->


	<?php include("template/rodape.php"); ?>

</body>
</html>
