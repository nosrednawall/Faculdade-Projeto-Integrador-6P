var app = angular.module('myApp', []);

app.controller('myCtrl', function($scope,$http) {		
		

	// estados
	$scope.EstadosSG = [
		{model: "PR", id: "1"}
	];
	// $scope.EstadosSG = [
	// 	{model: "PR", id: "1"},
	// 	{model: "SC", id: "2"},
	// 	{model: "SP", id: "3"},
	// 	{model: "RS", id: "4"},
	// 	{model: "RJ", id: "5"},
	// 	{model: "CE", id: "6"}
	// ];

	//cidades
	$scope.CidadesEstado = [
		{model: "São José dos Pinhais", id: "1", idEstado: "1", incidencia: "4.4"},
		{model: "Curitiba", 			id: "2", idEstado: "1", incidencia: "5.2"},

	];	
	// $scope.CidadesEstado = [
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
	

	$scope.EfetuarCalculo = function(){ 
		// verifica se os campos foram preenchidos
		if ($scope.vlGastoMensalKw == '' && $scope.vlGastoMensalKw == undefined){
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
	

			$scope.noPotenciaMinima = PotenciaMinima + 'kW';
			$scope.noPotenciaMaxima = PotenciaMaxima + 'kW';
			$scope.noPotenciaRecomendada = valorkW + 'kW';
			$scope.nopotenciaPlacaRecomendada =  PotenciaPLacaRecomendada ;
			console.log(PotenciaPLacaRecomendada);

			

		}
	}
	




	function solver($texto){
		console.log($texto);

		$http.post('./php/solver.php', {texto:$texto })
			.then(function (textoDoMundo) {
				console.log("Entrou no deu certo");
				console.log(textoDoMundo);
				return textoDoMundo;

			}, function (erro) {
				console.log('Esse é o erro de login ' + erro);
				console.log('Entrou em deu errado')

				// $scope.usuario = {};
				// $scope.mensagem = 'Login ou senha inválidos!';
			}
		);

	}
	
	

	$scope.CarregarDados = function(id){
		$.ajax({
			type: "POST",
			url: "/corte/tblCidades.php",
			dataType: "json",
			error: function (xhr, ajaxOptions, thrownError) {
				alert('Verificar a linha na conexao: $this->banco->debug = false;' + 
					'\n\nErro: "'+ xhr.status + '"\nMensagem: " ' + thrownError +'"');
			},				
			beforesend: function (){
				$("#dados").html("Carregando...");
			},
			data: {
				codigo: id
			},
			success: function(Dados){
				obj = JSON.parse(Dados);
				
				for (var i = 0; i < obj.records.length; i++) {
					Qtd = obj.records[0].noQuantidade;	
					Altura = obj.records[0].noAltura;
					Largura = obj.records[0].noLargura;
				
					for (var qtd = 0; qtd < obj.records[i].noQuantidade; qtd++) {
						document.getElementById("qtd").value = 1;
						
						var altura = parseFloat(obj.records[i].noAltura);	
						var largura = parseFloat(obj.records[i].noLargura);							
						
						document.getElementById("altura").value = altura.toString();
						document.getElementById("largura").value = largura.toString();
						//alert("Altura: " + obj.records[i].noAltura + ' - Largura: ' + obj.records[i].noLargura);
						$scope.CriarCorte2(altura, largura);
					}
				}
				
				//var canvas = document.getElementById("MinhaChapa");
				document.getElementById('MinhaChapa').src = 'corte.png';
				
				document.getElementById("demo").innerHTML += '<br>' + 
					registros.cortes[1].altura + " x " + registros.cortes[1].largura;
			}
		});
	}



	$scope.EfetuarTesteCalculo = function(id){
		alert("começou");
		$url= "./php/solver.php";
		$http.get($url)
		.then(function(oDados) {
			console.log(oDados.data.mensagem);
			console.log(oDados.data.paineis);
			console.log(oDados.data.preco);
			
			alert(oDados.data.mensagem);
		}, 
		function(response) { // optional
			console.log("Falhou "+response);
		});

	}

});