<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Venda</title>
</head>
<body>
    <h1>Cadastro de Venda</h1>
    <form action="processa_venda.php" method="POST">
        <label>Nome do Cliente:</label>
        <input type="text" name="cliente_nome" required><br><br>

        <label>Celular do Cliente:</label>
        <input type="text" name="cliente_celular" required><br><br>

        <label>Email do Cliente:</label>
        <input type="email" name="cliente_email" required><br><br>

        <h2>Dados do Produto</h2>
        <label>Nome do Produto:</label>
        <input type="text" name="produto_nome" required><br><br>

        <label>Preço:</label>
        <input type="number" step="0.01" name="preco" required><br><br>

        <label>Quantidade:</label>
        <input type="number" name="quantidade" required><br><br>

        <label>Frete:</label>
        <select name="frete" required>
            <option value="standard">Padrão</option>
            <option value="express">Expresso</option>
            <option value="overnight">Entrega no Dia Seguinte</option>
        </select><br><br>

        <button type="submit">Registrar Venda</button>
    </form>
</body>
</html>
