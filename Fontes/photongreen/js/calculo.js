var app = angular.module('myApp', []);

app.controller('myCtrl', function($scope,$http) {		

	var classeAlertaBootstrapInicial = "alert";
	var classeAlertaBootstrapScundaria = "alert-danger";

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
		$scope.erro = false;

		// verifica se os campos foram preenchidos
		if ($scope.vlGastoMensalKw == undefined || $scope.areaDisponivel == undefined || $scope.capitalInformado == undefined || $scope.nmCidade == undefined || $scope.sgEstado == undefined){

			var erros = validaInputs(null,null,null);
			exibeMensagensErro(erros);

		}else{
			//parte 1: preparando os dados
			//limpa o array de erros quando inicia
			var ul = document.querySelector("#mensagens-erro");
			ul.innerHTML = "";
			//removendo o bootstrap desse elemento
			removeClasse(ul,classeAlertaBootstrapInicial,classeAlertaBootstrapScundaria);

			//parte 2 validando os inputs
			var erros = validaInputs($scope.vlGastoMensalKw,$scope.areaDisponivel,$scope.capitalInformado);

			if(	erros.length > 0){
				$scope.erro = true;
				exibeMensagensErro(erros);
			}else{
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
				//parte 3  efetua o solver

				console.log("potencia "+potenciaTotalEmWatts+" area "+areaInformada+ " valor " +valorMaximo);

				$scope.Solver(potenciaTotalEmWatts,areaInformada,valorMaximo);
			}
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
			console.log(response.data);
			$scope.resposta =  response.data;
		}, 
		function(erro) { // optional
			console.log("Falhou " + erro.data);
		});
	}

	//função gera o array de erros que serão impressos na tela
	function validaInputs(valorConsumidoAoDia,areaInformada,valorMaximo){
		var erros = [];
		if(valorConsumidoAoDia == undefined && areaInformada == undefined && valorMaximo == undefined){
			if($scope.sgEstado == undefined) erros.push("Escolha um estado");
			if($scope.nmCidade == undefined) erros.push("Escolha uma cidade");
			if($scope.vlGastoMensalKw == undefined) erros.push("O valor de consumo mensal não pode ficar em branco");
			if($scope.capitalInformado == undefined ) erros.push("O capital informado não pode ficar em branco");
			if($scope.areaDisponivel == undefined) erros.push("A área disponível não pode ficar em branco");
		}else{
			if(valorConsumidoAoDia < 1000) erros.push("Informe um valor de consumo mensal acima de 1000kwatts");
			if(areaInformada < 10) erros.push("Informe uma área acima de 10 metros quadrados");
			if(valorMaximo < 1000) erros.push("Valor mínimo de investimento é de R$ 1000,00");
		}
		return erros;
	}

	// funcao recebe um array de erros e os adiciona no frontend dentro do elemento ul
	function exibeMensagensErro(erros){
		var ul = document.querySelector("#mensagens-erro");
		ul.innerHTML = "";
		adicionaClasse(ul,classeAlertaBootstrapInicial,classeAlertaBootstrapScundaria);

		erros.forEach(function(erro) {
			var li = document.createElement("li");
			li.textContent = erro;
			ul.appendChild(li);
		});
	}

	// autoexplicativo
	function adicionaClasse(elemento,classeInicial,classeSecundaria){
		elemento.classList.add(classeInicial);
		elemento.classList.add(classeSecundaria);
	}
	function removeClasse(elemento,classeInicial,classeSecundaria){
		elemento.classList.remove(classeInicial);
		elemento.classList.remove(classeSecundaria);
	}
});
