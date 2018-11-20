<!DOCTYPE html>
<!-- inicia o app do angular aqui -->
<html ng-app="myApp">
<head>
	<title>Calculo</title>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- invoca os arquivos css -->
    <?php include("template/css.php"); ?>
</head>
<!-- inicia o controlar dessa página -->	
<body ng-controller="myCtrl">
	<!-- invoca o menu da página -->
	<?php include("template/menu.php"); ?>
	<!-- aplica o conceito de linhas e colunas do bootstrap, aqui é inciado uma linha(row), e dentro dessa linha estará 3 colunas, a primeira e a tereira serão colunas em branco, já na segunda estará todo o conteúdo do site; a classe container-fluid é responsável por "esticar" os componentes de forma que preencham toda a coluna -->
	<section class="row container-fluid" >
		<!-- atribuido o tamanho 2 para essa coluna, ela sempre será o tamanho 2 que é referente ao tamanho da tela -->
		<div class="col-2 col-sm-2"></div>
		<!-- atribuido o tamanho 8 para essa coluna, ela sempre será o tamanho 8 que é referente ao tamanho da tela -->
		<article class="col-8 col-sm-8" >
			
			<h2>SIMULADOR SOLAR - CALCULADORA SOLAR FOTOVOLTAICA</h2>
			<!-- os atributos que estiverem dentro de ng-model são os nomes das variáveis dentro angular -->
			<form>
				<!-- classe do bootstrap para grupos de formularios label e input -->
				<div class="form-group">
					<label for="estado-escolhido" class="descricao">Informe seu estado</label>			
					<select id="estado-escolhido" class="form-control" ng-model="sgEstado" ng-options="x.model for x in EstadosSG"></select>
				</div>

				<div class="form-group">
					<label for="cidade-escolhida" class="descricao">Informe sua cidade</label>
					<select id="cidade-escolhida" class="form-control" ng-model="nmCidade" ng-options="x.model for x in CidadesEstado | filter:{idEstado:ssgEstado.id}" enabled="false"></select>		
				</div>

				<div class="form-group">
					<label for="consumo-informado" class="descricao">Consumo médio mensal kWh/Mês?</label>
					<input id="consumo-informado" class="form-control" ng-model="vlGastoMensalKw" pattern="[0-9]+" placeholder="Ex:10" autocomplete="off">		
				</div>

				<div class="form-group">
					<label for="area-disponivel" class="descricao">Informe a sua área disponível em m² para instalação das placas</label>
					<input id="area-disponivel" class="form-control" ng-model="areaDisponivel" pattern="[0-9]+" placeholder="Ex:10" autocomplete="off">
				</div>

				<div class="form-group">
					<label for="capital-informado" class="descricao">Estimativa de investimento</label>
					<div class="input-group">
						<span class="input-group-addon">R$</span>
						<input id="capital-informado" class="form-control" ng-model="capitalInformado" pattern="[0-9]+" placeholder="Ex: 14000" autocomplete="off" >
						<!-- <span class="input-group-addon">,00</span> -->
					</div>
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

	<!-- model que é invocado para mostrar a resposta ao clicar em calcular -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-if="sgEstado && nmCidade && vlGastoMensalKw && areaDisponivel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h2 class="modal-title" id="exampleModalLabel">Resultado</h2>
				</div>
				<div class="modal-body">
					<div class="resultado">
						<h4 class="tituloResultado">Placa Fotovoltaica sugerida</h4>
						<label>Potência</label> {{resposta.painel.placaPotencia}}<br>
						<label>Quantidade</label> {{resposta.painel.placaQuantidade}}<br>
						<label>Area de instalação necessária</label> {{resposta.painel.placaArea}}<br>
						<label>Preço unitário estimado</label> {{resposta.painel.placaPrecoUnitario}}<br>
						<label>Preço total estimado</label> {{resposta.painel.placaPrecoTotal}}<br>
					</div>
					<hr>		
					<div class="resultado">
						<h4 class="tituloResultado">Inversor sugerido</h4>		
						<label>Potência mínima:</label> {{resposta.painel.inversorMinimo}}<br>
						<label>Potência máxima:</label> {{resposta.painel.inversorMaximo}}<br>
						<label>Potência Recomendado:</label> {{resposta.painel.inversorRecomendado}}<br>
						<label>Descrição do inversor recomendado</label> {{resposta.inversor.descricao}}<br>
						<label>Quantidade Recomendada</label> {{resposta.painel.inversorQuantidade}}<br>
						<label>Preço unitario estimado</label> {{resposta.inversor.preco}}<br>
						<label>Preço total estimado</label> {{resposta.inversor.precoTotal}}<br>
					</div>
					<hr>
					<div class="resultado">
						<h4 class="tituloResultado">Total investimento: {{resposta.investimentoTotal}}</h4>
					</div>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Scripts invocados -->
	<?php include("template/rodape.php"); ?>
</body>
</html>
