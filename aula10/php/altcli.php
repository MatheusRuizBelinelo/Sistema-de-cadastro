<?php 
	require("conecta.php");

	$cpfcli = "";
	$nomecli = "";
	$idcli = "";

	// GET - Leitura do parâmetro idcli passado pela URL
	if (isset($_GET["alterar"])) {
		$idcli = htmlentities($_GET["alterar"]);

		// Usar prepared statement para a consulta
		$stmt = $mysqli->prepare("SELECT cpfcli, nomecli FROM tb_clientes WHERE idcli = ?");
		$stmt->bind_param("i", $idcli);
		$stmt->execute();
		$result = $stmt->get_result();
		$tabela = $result->fetch_assoc();

		$cpfcli = htmlspecialchars($tabela["cpfcli"]);
		$nomecli = htmlspecialchars($tabela["nomecli"]);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alterar Cliente</title>
</head>
<body>
	<h2>Alterar Dados do Cliente</h2>
	<form method="POST" action="altcli.php">
		<input type="hidden" name="idcli" value="<?php echo htmlspecialchars($idcli); ?>">
		<label>CPF:</label>
		<input type="text" name="cpfcli" value="<?php echo $cpfcli; ?>"><br/><br/>
		<label>Nome:</label>
		<input type="text" name="nomecli" value="<?php echo $nomecli; ?>"><br/><br/>
		<input type="submit" value="Salvar" name="botao">
	</form>
	<a href="clientes.php">Voltar</a>
	<br/>
</body>
</html>

<?php 
	// Processamento da atualização após o envio do formulário
	if (isset($_POST["botao"])) {
		$idcli = htmlentities($_POST["idcli"]);
		$cpfcli = htmlentities($_POST["cpfcli"]);
		$nomecli = htmlentities($_POST["nomecli"]);

		// Usar prepared statement para a atualização
		$stmt = $mysqli->prepare("UPDATE tb_clientes SET cpfcli = ?, nomecli = ? WHERE idcli = ?");
		$stmt->bind_param("ssi", $cpfcli, $nomecli, $idcli);
		$stmt->execute();

		if ($stmt->error == "") {
			echo "Alterado com sucesso!";
		} else {
			echo "Erro ao atualizar: " . $stmt->error;
		}
	}
?>
