<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<title>Calculo</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include("template/css.php"); ?>
</head>
	
<body ng-controller="myCtrl">

	<?php include("template/menu.php"); ?>

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
					<input id="consumo-informado" class="form-control" ng-model="vlGastoMensalKw" pattern="[0-9]+" placeholder="Ex:10">		
				</div>

				<div class="form-group">
					<label for="area-disponivel" class="descricao">Informe a sua área disponível em m² para instalação das placas</label>
					<input id="area-disponivel" class="form-control" ng-model="areaDisponivel" pattern="[0-9]+" placeholder="Ex:10">
				</div>
				<div class="row">
					<button ng-click="EfetuarCalculo()" class="btn btn-success btn-lg col col-sm-4 col-xs-12" data-toggle="modal" data-target="#exampleModal">Calcular</button>
					<div class="col col-sm-4 col-xs-12"></div>
					<input type="reset" value="Limpar" class="btn  btn-default btn-lg col col-sm-4 col-xs-12" >
				</div>
			</form>
		
		</article>
		<div class="col-2 col-sm-2"></div>
	</section><!--/row -->

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-if="sgEstado && nmCidade && vlGastoMensalKw && areaDisponivel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title" id="exampleModalLabel">Resultado</h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="resultado">
						<h4 class="tituloResultado">Placa Fotovoltaica</h4>
						<label>Incidência solar da região</label>: {{noIncidencia}}<br>
						<label>Comsumo gasto kWh/Dia:</label> {{calculokWh}}<br>
						<label>Potencia gerado kWp/Dia:</label> {{calculokWp}}<br>
						<label>Quantidade de placas fotovotaicas:</label> {{qtPaineis}}<br>
						<label>Potencia do painel:</label> {{noPotenciaPainel}}W
					</div>
					<hr>		
					<div class="resultado">
						<h4 class="tituloResultado">Inversor sugerido</h4>
						<label>Potência mínima:</label> {{noPotenciaMinima}}<br>
						<label>Potência máxima:</label> {{noPotenciaMaxima}}<br>
						<label>Recomendado:</label> {{noPotenciaRecomendada}}<br>
					</div>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->


	<?php include("template/rodape.php"); ?>

</body>
</html>
