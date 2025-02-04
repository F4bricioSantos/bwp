<?php
include "../conexao.php";
session_start();

// Função para validar e limpar dados de entrada
function limparEntrada($dados) {
    return htmlspecialchars(strip_tags(trim($dados)));
}

// Inicializar variáveis
$codigoRastreio = '';
$mostrarStatus = false;
$stmt = null;
$stmtRastreamento = null;

// Verificar se o formulário foi enviado e se o código de rastreamento está presente
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['codigoRastreio'])) {
    $codigoRastreio = limparEntrada($_POST['codigoRastreio']);
    $mostrarStatus = true;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rastreamento de Pedido - Alcance | Logística S.A.</title>
    <link rel="stylesheet" href="../css/rastrear_pedidos.css">
</head>
<body>
<?php include "navbar.php";?>
    <div class="container">
        <h1>Rastreamento de Encomenda</h1>
        <form action="rastrear_pedido.php" method="POST">
            <label for="codigoRastreio">Código de Rastreamento:</label>
            <input type="text" id="codigoRastreio" name="codigoRastreio" value="<?= htmlspecialchars($codigoRastreio) ?>" required>
            <input type="submit" value="Buscar">
        </form>

        <?php if ($mostrarStatus && !empty($codigoRastreio)): ?>
            <?php
            $sql = "SELECT * FROM pedidos WHERE codigo_rastreio = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $codigoRastreio);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $pedido = $result->fetch_assoc();
                echo "<div class='status'>";
                echo "<h2>Status da Encomenda:</h2>";
                echo "<p><strong>Código de Rastreamento:</strong> " . htmlspecialchars($pedido['codigo_rastreio']) . "</p>";
                echo "<p><strong>Origem:</strong> " . htmlspecialchars($pedido['cep_origem']) . "</p>";
                echo "<p><strong>Destino:</strong> " . htmlspecialchars($pedido['cep_destino']) . "</p>";
                echo "<p><strong>Altura:</strong> " . htmlspecialchars($pedido['altura']) . " cm</p>";
                echo "<p><strong>Largura:</strong> " . htmlspecialchars($pedido['largura']) . " cm</p>";
                echo "<p><strong>Comprimento:</strong> " . htmlspecialchars($pedido['comprimento']) . " cm</p>";
                echo "<p><strong>Peso:</strong> " . htmlspecialchars($pedido['peso']) . " kg</p>";
                echo "<p><strong>Valor do objeto:</strong> R$ " . number_format(htmlspecialchars($pedido['valor_objeto']), 2, ',', '.') . "</p>";
                echo "</div>";

                // Consultar o histórico de rastreamento
                $sqlRastreamento = "SELECT * FROM rastreamento WHERE codigo_rastreio = ? ORDER BY data_evento DESC";
                $stmtRastreamento = $conn->prepare($sqlRastreamento);
                $stmtRastreamento->bind_param("s", $codigoRastreio);
                $stmtRastreamento->execute();
                $resultRastreamento = $stmtRastreamento->get_result();

                if ($resultRastreamento->num_rows > 0) {
                    echo "<div class='historico'>";
                    echo "<h3>Histórico de Rastreamento:</h3>";
                    echo "<ul>";
                    while ($row = $resultRastreamento->fetch_assoc()) {
                        echo "<li><strong>" . htmlspecialchars($row['data_evento']) . ":</strong> " . htmlspecialchars($row['evento']) . "</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                } else {
                    echo "<p>Sem histórico de rastreamento.</p>";
                }

            } else {
                echo "<div class='status'>";
                echo "<h2>Erro:</h2>";
                echo "<p>Código de rastreamento não encontrado. Por favor, verifique o código e tente novamente.</p>";
                echo "</div>";
            }

            // Fechar declarações e conexão
            if ($stmt) $stmt->close();
            if ($stmtRastreamento) $stmtRastreamento->close();
            $conn->close();
            ?>
        <?php endif; ?>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
