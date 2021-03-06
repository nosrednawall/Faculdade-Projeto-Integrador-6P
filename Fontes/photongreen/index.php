
<!DOCTYPE html>
<html>
<head>
	<title>PhotonGreen</title>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include("template/css.php"); ?>
	<link rel="shortcut icon" href="#">
<head>
<body>
	<?php include("template/menu.php"); ?>
	
		<!-- Header logo da empresa ???-->
	<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
		<img class="w3-image" src="imagens/solar1.jpg" alt="Architecture" width="1500" height="450">
		<div class="w3-display-middle w3-margin-top w3-center">
			<h1 class="w3-xxlarge w3-text-white">
				<span class="w3-padding w3-black w3-opacity-min"><b>PG</b></span> 
				<span class="w3-hide-small w3-text-light-grey">Energia</span>
			</h1>
		</div>
	</header>
	
	<!-- Page content -->
	<section class="w3-content w3-padding" style="max-width:1564px">

		<!-- Project Section -->
		<div class="w3-container w3-padding-32" id="projects">
			<h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Projetos</h3>
		</div>

		<div class="w3-row-padding">
			<div class="w3-col l3 m6 w3-margin-bottom">
				<div class="w3-display-container">
					<div class="w3-display-topleft w3-black w3-padding">Parana</div>
					<img src="imagens/projeto1.png" alt="House" style="width:100%">
				</div>
			</div>
			<div class="w3-col l3 m6 w3-margin-bottom">
				<div class="w3-display-container">
					<div class="w3-display-topleft w3-black w3-padding">São Paulo</div>
					<img src="imagens/projeto2.jpg" alt="House" style="width:100%">
				</div>
			</div>
			<div class="w3-col l3 m6 w3-margin-bottom">
				<div class="w3-display-container">
					<div class="w3-display-topleft w3-black w3-padding">Santa Catarina</div>
					<img src="imagens/projeto3.jpg" alt="House" style="width:100%">
				</div>
			</div>
			<div class="w3-col l3 m6 w3-margin-bottom">
				<div class="w3-display-container">
					<div class="w3-display-topleft w3-black w3-padding">Rio Grande do Sul</div>
					<img src="imagens/projeto4.jpg" alt="House" style="width:100%">
				</div>
			</div>
		</div>


		<!-- About Section -->
		<div class="w3-container w3-padding-32" id="Empresa">
			<h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Empresa</h3>
			<p>Fundada em 2018 no ramo de geração de energias renovaveis.
			</p>
		</div>

		<div><h4>Equipe de colaboradores</h4></div>

		<div class="w3-row-padding w3-grayscale">
			<div class="w3-col l3 m6 w3-margin-bottom">
				<img src="imagens/Office-Customer-Male-Light-icon.png" alt="John" style="width:100%">
				<h3>João Mario</h3>
				<p class="w3-opacity">CEO & Fundador</p>
				<p>Energia renovável é aquela que vem de recursos naturais que são naturalmente reabastecidos, como sol, vento, chuva, marés e energia geotérmica.</p>
				<p><button class="w3-button w3-light-grey w3-block">Contato</button></p>
			</div>
			<div class="w3-col l3 m6 w3-margin-bottom">
				<img src="imagens/Office-Client-Male-Dark-icon.png" alt="Jane" style="width:100%">
				<h3>Marcos Soares</h3>
				<p class="w3-opacity">Arquiteto</p>
				<p>Um arquiteto é o profissional responsável pelo projeto, supervisão e execução de obras de arquitetura.</p>
				<p><button class="w3-button w3-light-grey w3-block">Contato</button></p>
			</div>
			<div class="w3-col l3 m6 w3-margin-bottom">
				<img src="imagens/Occupations-Technical-icon.png" alt="Mike" style="width:100%">
				<h3>Maria Shallon</h3>
				<p class="w3-opacity">Arquiteto</p>
				<p>Um arquiteto é o profissional responsável pelo projeto, supervisão e execução de obras de arquitetura.</p>
				<p><button class="w3-button w3-light-grey w3-block">Contato</button></p>
			</div>
			<div class="w3-col l3 m6 w3-margin-bottom">
				<img src="imagens/Office-Customer-Female-Light-icon.png" alt="Dan" style="width:100%">
				<h3>Jane Malta</h3>
				<p class="w3-opacity">Arquiteto</p>
				<p>Um arquiteto é o profissional responsável pelo projeto, supervisão e execução de obras de arquitetura.</p>
				<p><button class="w3-button w3-light-grey w3-block">Contato</button></p>
			</div>
		</div>


		<!-- Contact Section -->
	 	<div class="w3-container w3-padding-32" id="Contato">
			<h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Contato</h3>
			<p>Preencha o formulario a baixo que entraremos em contato.</p>
			<form action="/action_page.php" target="_blank">
				<input class="w3-input w3-border" type="text" placeholder="Nome" required name="Name">
				<input class="w3-input w3-section w3-border" type="text" placeholder="E-mail" required name="Email">
				<input class="w3-input w3-section w3-border" type="text" placeholder="Mensagem" required name="Subject">
				<input class="w3-input w3-section w3-border" type="text" placeholder="Comentário" required name="Comment">
				<button class="w3-button w3-black w3-section" type="submit">
					<i class="fa fa-paper-plane"></i> Enviar
				</button>
			</form>
		</div>
		
	<!-- End page content -->
	</section>
	<?php include("template/rodape.php"); ?>

</body>
</html>
