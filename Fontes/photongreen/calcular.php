<!DOCTYPE html>
<html ng-app="myApp">
	<title>Calculo</title>
	<meta charset="utf-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script type="text/javascript" src="./js/angular.min.js"></script>
	<script type="text/javascript" src="./js/jquery.min.js"></script>
	
	<script type="text/javascript" src="./js/calculo.js"></script>	
	<link rel="stylesheet" type="text/css" href="calcular.css"/>
	
<body ng-controller="myCtrl">
	<div style="text-align: center;">
		<div class="titulo">SIMULADOR SOLAR - CALCULADORA SOLAR FOTOVOLTAICA</div>

			<label for="name" class="descricao">Informe seu estado</label>	<br>		
			<select class="campo" ng-model="sgEstado" ng-options="x.model for x in EstadosSG " style="width: 60px"></select><br><br>
			<label for="name" class="descricao">Informe sua cidade</label><br>			
			<select class="campo" ng-model="nmCidade" ng-options="x.model for x in CidadesEstado | filter:{idEstado:sgEstado.id}" style="width: 250px" enabled="false"></select><br>			
			<label for="name" class="descricao">Consumo médio mensal kWh/Mês?</label><br>
			<input class="campo" ng-model="vlGastoMensalKw" style="width: 70px; text-align: center;"><br>
			<button ng-click="EfetuarCalculo()" class="button">Calcular</button>	

			
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
	
	
</body>
</html>

