<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro de Clientes</title>
</head>
<body>
	<h2>Cadastro de Clientes</h2>
	<a href="adcli.php"><button>Adicionar</button></a>
	<a href="pesqcli.php"><button>Pesquisar</button></a>
	<br /><br />
	<table border="1" width="400">
		<tr>
			<th>ID</th>
			<th>CPF</th>
			<th>Nome</th>
			<th>Ação</th>
		</tr>
		
		<?php 
			// Conexão com o banco de dados
			require("conecta.php");

			// Consulta registros da tabela
			$query = $mysqli->query("SELECT * FROM tb_clientes");
			echo $mysqli->error;

			// Carrega consulta de registros
			while ($tabela = $query->fetch_assoc()) {
				$idcli = htmlspecialchars($tabela['idcli']);
				$cpfcli = htmlspecialchars($tabela['cpfcli']);
				$nomecli = htmlspecialchars($tabela['nomecli']);
				
				echo "
				<tr>
					<td align='center'>{$idcli}</td>
					<td align='center'>{$cpfcli}</td>
					<td align='center'>{$nomecli}</td>
					<td width='120'>
						<a href='exccli.php?excluir={$idcli}' onclick='return confirm(\"Tem certeza que deseja excluir este cliente?\");'>[excluir]</a>
						<a href='altcli.php?alterar={$idcli}'>[alterar]</a>
					</td>
				</tr>
				";
			}

			// Fecha a conexão
			$mysqli->close();
		?>
	</table>
</body>
</html>
