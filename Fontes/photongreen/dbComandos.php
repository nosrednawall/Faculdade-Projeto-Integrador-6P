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
		$idUF = $_GET['idUF'];

		$sql = "SELECT IDCIDADE, NMCIDADE, IDUF, NOINCIDENCIA FROM CADCIDADES WHERE IDUF = $idUF";
		
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