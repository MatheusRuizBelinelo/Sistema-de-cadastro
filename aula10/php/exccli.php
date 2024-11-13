<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Exclusão de Cliente</title>
</head>
<body>
	<?php 
	// Verifica se o parâmetro "excluir" foi passado via GET
	if (isset($_GET["excluir"])) {
		$idcli = intval($_GET["excluir"]); // Conversão para inteiro para garantir segurança
		require("conecta.php");

		// Preparando a consulta para evitar SQL Injection
		$stmt = $mysqli->prepare("DELETE FROM tb_clientes WHERE idcli = ?");
		$stmt->bind_param("i", $idcli);
		$stmt->execute();

		// Verifica se houve erro
		if ($stmt->error) {
			echo "Erro ao excluir: " . $stmt->error;
		} else {
			if ($stmt->affected_rows > 0) {
				echo "Excluído com sucesso!<br />";
			} else {
				echo "Registro não encontrado ou já excluído.<br />";
			}
		}

		echo "<a href='clientes.php'>Voltar</a>";

		// Fecha a declaração e a conexão
		$stmt->close();
		$mysqli->close();
	} else {
		echo "Parâmetro inválido.";
	}
	?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<?php 
	// GET - leitura - parametro idcli passado pela url
	if(isset($_GET["excluir"])){

		$idcli = htmlentities($_GET["excluir"]);
		require("conecta.php");
		$mysqli->query("delete from tb_clientes where idcli = '$idcli'");
		echo $mysqli->error;
		if ($mysqli->error==""){
			echo "Excluido com Sucesso<br />";
			echo "<a href='clientes.php'>Voltar</a>";
		}
	}
	?>
</body>
</html>