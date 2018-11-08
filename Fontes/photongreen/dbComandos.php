<?php
	header('Content-Type: text/html; charset=utf-8');
	
	$acao = $_GET['acao'];

	switch ($acao) {
		case 'SelectCidades':
			sqlSelectCidades();
			break;
		
		default:
			
			break;
	}	


	function sqlSelectCidades() {
		include ('dbConexao.php');

		$sql = "SELECT DISTINCT dbParana.MUNICIPIO FROM `incidencia_solar_parana` dbParana WHERE 1 ORDER BY MUNICIPIO";
		
		$tabela = $conexao->prepare($sql);

		if($tabela->execute()){
		    while($row = $tabela->fetch(PDO::FETCH_ASSOC)) {
		        $data[] = $row;
		    }
		} else {
		    echo "0 results";
		}
		echo json_encode($data);
	}
	
?>
