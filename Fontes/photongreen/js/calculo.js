var app = angular.module('myApp', []);

app.controller('myCtrl', function($scope,$http) {		

	// estados
	$scope.EstadosSG = [
		{model: "PR", id: "1"}
	];

	//cidades
	$scope.CidadesEstado = [
		{model: "São José dos Pinhais", id: "1", idEstado: "1", incidencia: "4.4"},
		{model: "Curitiba", 			id: "2", idEstado: "1", incidencia: "5.2"},

	];	

	$scope.EfetuarCalculo = function(){ 
		// verifica se os campos foram preenchidos
		if ($scope.vlGastoMensalKw == undefined || $scope.vlGastoMensalKw == undefined || $scope.nmCidade == undefined || $scope.sgEstado == undefined){

			alert('Por favor preencha todos os campos.');

		}else{
			//parte 1: preparando os dados

			//eficiencia em 80%
			var EficienciaPlaca = 0.80;

			var tempoExposicao = $scope.nmCidade.incidencia;

			//descobrindo a meta de watts que deve ser gerado
			//primeiro multiplica por mil para tornar  kwatts em watts, e depois divide por 30 para coseguir a quantidade de consumo de um dia
			var valorConsumidoAoDia = ($scope.vlGastoMensalKw * 1000 )/30;
			valorConsumidoAoDia = parseFloat(valorConsumidoAoDia).toFixed(2);

			//agora divide pela multiplicacao do tempo de exposiçao da placa e a eficiencia da placa, para conseguir a quantidade necessária para gerar em durante o período de exposicao do local
			var potenciaTotalEmWatts = valorConsumidoAoDia / (tempoExposicao*EficienciaPlaca)
			potenciaTotalEmWatts = parseFloat(potenciaTotalEmWatts).toFixed(2);

			//area informada ou disponivel
			var areaInformada = $scope.areaDisponivel;
			areaInformada = parseFloat(areaInformada).toFixed(2);

			//valor maximo de capital
			var valorMaximo = $scope.capitalInformado;
			valorMaximo = parseFloat(valorMaximo).toFixed(2);

			// ________________________________________________________________________

			//efetua o solver e imprime na tela
			$scope.Solver(potenciaTotalEmWatts,areaInformada,valorMaximo);

		}
	}
	
	//funcao que efetua o envio assincrono dos dados para o servidor
	$scope.Solver = function(potenciaTotalEmWatts,areaInformada,valorMaximo){
		$http({
			url:'./php/solver.php',
			method:'POST',
			data: {'potenciaTotalEmWatts': potenciaTotalEmWatts,'areaInformada':areaInformada,'valorMaximo':valorMaximo}
		})
		.then(function(response) {
			//o que retornar será impresso na tela
			$scope.resposta =  response.data;
		}, 
		function(erro) { // optional
			console.log("Falhou " + erro.data);
		});
	}
});
