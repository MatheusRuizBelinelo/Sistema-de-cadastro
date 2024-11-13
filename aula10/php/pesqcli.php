<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pesquisa de Cliente</title>
</head>
<body>
	<form method="POST" action="pesqcli.php">
		<label for="nomecli">Nome do Cliente:</label>
		<input type="text" name="nomecli" maxlength="40" placeholder="Digite o nome">
		<input type="submit" value="Pesquisar" name="botao">
	</form>

	<?php 
	if (isset($_POST["botao"])) {
		require("conecta.php");

		// Verifica se a conexão com o banco foi estabelecida
		if ($mysqli->connect_error) {
			die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
		}

		// Preparando a consulta para evitar SQL Injection
		$nomecli = "%" . $_POST["nomecli"] . "%";
		$stmt = $mysqli->prepare("SELECT idcli, cpfcli, nomecli FROM tb_clientes WHERE nomecli LIKE ?");
		$stmt->bind_param("s", $nomecli);
		$stmt->execute();
		$result = $stmt->get_result();

		// Exibindo os resultados
		if ($result->num_rows > 0) {
			echo "
			<table border='1' width='400'>
				<tr>
					<th>ID</th>
					<th>CPF</th>
					<th>Nome do Cliente</th>
				</tr>
			";
			while ($tabela = $result->fetch_assoc()) {
				echo "
				<tr>
					<td align='center'>{$tabela['idcli']}</td>
					<td align='center'>{$tabela['cpfcli']}</td>
					<td align='center'>{$tabela['nomecli']}</td>
				</tr>
				";
			}
			echo "</table>";
		} else {
			echo "<p>Nenhum cliente encontrado.</p>";
		}
		// Fecha a declaração e a conexão
		$stmt->close();
		$mysqli->close();
	}
	?>
	<br>
	<a href='clientes.php'>Voltar</a>
</body>
</html>
