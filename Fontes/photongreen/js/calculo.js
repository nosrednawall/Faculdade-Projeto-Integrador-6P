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
		if ($scope.vlGastoMensalKw == '' || $scope.vlGastoMensalKw == undefined || $scope.nmCidade == undefined || $scope.sgEstado == undefined){
			alert('Por favor preencha todos os campos.');			
		}else{
			//eficiencia da placa travada em 80%
			var EficienciaPlaca = 0.80; //80
			//verifica qual é o valor gasto diário de KWs/h
			var valorkWh = $scope.vlGastoMensalKw / 30;
			valorkWh = parseFloat(valorkWh).toFixed(2)

			//identifica a quantidade de KW que a placa deverá atingir
			var valorkW = (valorkWh) / ($scope.nmCidade.incidencia * EficienciaPlaca);
			valorkW = parseFloat(valorkW).toFixed(2);

			// ________________________________________________________________________

			// MEU NORTE
			// x1 = painel
			// x2 = inversor
			// x3 = custos adicionais

			// função objetivo : Z(MAX) = ???x1 + ???x2 + ???x3
			// restrição 1 valor: ???x1 + ???x2 + ???x3 <= capital informado
			// restrição 2 espaco: ???x1 <= espaco informado
			// restrição 3 inversor: ???x2 = inteiro 

			// x1 = painel1
			// x2 = painel2
			// x3 = painel3
			// x4 = painel4

			// 121


			// restrição 1 qtda kwts para ser gerada:	


			// x1 = painel
			// x2 = inversor

			// função objetivo : Z(MAX) = ???x1 + ???x2 + ???x3

			// restrição 2 valor: 						???x1 + ???x2  <= capital informado
			// restrição 3 espaco: 						???x1 <= espaco informado
			// restrição 4 inversor: 					???x2 = inteiro


			function solver(){	
		
				$url= "./php/solver.php";
				$http.post($url,{'valorKw':valorkW})
				.then(function(resposta) {
					console.log(resposta.data);
					
					alert(resposta.data);
				}, 
				function(erro) { // optional
					console.log("Falhou "+erro.data);
				});
		
			}


			//começa a ciranda das placas
			var PotenciaPlaca = 265;
			var QuantidadePlacas = (valorkW / PotenciaPlaca) * 1000;
			QuantidadePlacas = parseFloat(QuantidadePlacas).toFixed(1);
			

			// ________________________________________________________________________
			// inicia a impressão dos dados no frontend

			$scope.noIncidencia = $scope.nmCidade.incidencia;
			$scope.calculokWh = valorkWh
			$scope.calculokWp = valorkW;
			$scope.qtPaineis = QuantidadePlacas;
			$scope.noPotenciaPainel = PotenciaPlaca;

			var margem = (valorkW * 20) / 100;

			var PotenciaMinima = parseFloat(valorkW) - parseFloat(margem);
			PotenciaMinima = parseFloat(PotenciaMinima).toFixed(2);	

			var PotenciaMaxima = parseFloat(valorkW) + parseFloat(margem);
			PotenciaMaxima = parseFloat(PotenciaMaxima).toFixed(2);	
			
			//fazer aqui por enquanto
			var PotenciaPLacaRecomendada = solver("haha");
	

			$scope.noPotenciaMinima = PotenciaMinima + ' kW';
			$scope.noPotenciaMaxima = PotenciaMaxima + ' kW';
			$scope.noPotenciaRecomendada = valorkW + ' kW';
			$scope.nopotenciaPlacaRecomendada =  PotenciaPLacaRecomendada ;
			console.log(PotenciaPLacaRecomendada);

			

		}
	}
	




	function solver($texto){
		console.log($texto);

		$url= "./php/solver.php";
		$http.get($url)
		.then(function(resposta) {
			console.log(resposta.data.mensagem);
			console.log(resposta.data.paineis);
			console.log(resposta.data.preco);
			
			// alert(resposta.data.mensagem);
		}, 
		function(response) { // optional
			console.log("Falhou "+response.data);
		});

	}
	
	$scope.EfetuarTesteCalculo = function(id){
		alert("começou");
		$url= "./php/solver.php";
		$http.get($url)
		.then(function(resposta) {
			console.log(resposta.data.mensagem);
			console.log(resposta.data.paineis);
			console.log(resposta.data.preco);
			
			alert(resposta.data.mensagem);
		}, 
		function(response) { // optional
			console.log("Falhou "+response.data);
		});

	}

	// $scope.EstadosSG = [
	// 	{model: "PR", id: "1"},
	// 	{model: "SC", id: "2"},
	// 	{model: "SP", id: "3"},
	// 	{model: "RS", id: "4"},
	// 	{model: "RJ", id: "5"},
	// 	{model: "CE", id: "6"}
	// ];

	// 	{model: "São José dos Pinhais", id: "1", idEstado: "1", incidencia: "4.4"},
	// 	{model: "Curitiba", 			id: "2", idEstado: "1", incidencia: "5.2"},
	// 	{model: "São Paulo", 			id: "3", idEstado: "3", incidencia: "6"},
	// 	{model: "Florianopolis", 		id: "4", idEstado: "2", incidencia: "5.8"},
	// 	{model: "Itajai", 				id: "5", idEstado: "2", incidencia: "6.5"},
	// 	{model: "Blumenau", 			id: "6", idEstado: "2", incidencia: "6.9"},
	// 	{model: "Campinas", 			id: "7", idEstado: "3", incidencia: "5.1"},
	// 	{model: "Guarulhos", 			id: "8", idEstado: "3", incidencia: "5.7"},
	// 	{model: "Porto Alegre", 		id: "9", idEstado: "4", incidencia: "4.3"},
	// 	{model: "Rio de Janeiro", 		id: "10", idEstado: "5", incidencia: "5.4"},
	// 	{model: "Fortaleza", 			id: "11", idEstado: "6", incidencia: "5.56"}
	// ];	

});