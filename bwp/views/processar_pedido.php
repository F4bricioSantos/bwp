<?php
include "../conexao.php";

// Função para gerar um código Pix fictício
function gerarCodigoPix() {
    return '00020126580014br.gov.bcb.pix0136' . bin2hex(random_bytes(16)) . '0236' . bin2hex(random_bytes(16));
}

// Função para validar e limpar dados de entrada
function limparEntrada($conn, $dados) {
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags(trim($dados))));
}

// Inicializar variáveis
$valor = 0.0;
$codigoPix = gerarCodigoPix();
$codigoRastreio = ''; // Variável para armazenar o código de rastreamento

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpar e validar os dados recebidos
    $cepOrigem = limparEntrada($conn, $_POST['cepOrigem']);
    $cepDestino = limparEntrada($conn, $_POST['cepDestino']);
    $altura = (int) limparEntrada($conn, $_POST['altura']);
    $largura = (int) limparEntrada($conn, $_POST['largura']);
    $comprimento = (int) limparEntrada($conn, $_POST['comprimento']);
    $peso = (int) limparEntrada($conn, $_POST['peso']);
    $valorObjeto = limparEntrada($conn, $_POST['valorObjeto']);

    // Calcular o valor do pedido
    $valor = (7.60 * $valorObjeto) / 100;

    // Gerar um código de rastreio
    $codigoRastreio = 'AV' . strtoupper(bin2hex(random_bytes(8))) . 'BR';

    // Inserir dados na tabela `pedidos`
    $sqlPedidos = "INSERT INTO pedidos (cep_origem, cep_destino, altura, largura, comprimento, peso, valor_objeto, codigo_rastreio, data_criacao) 
                   VALUES ('$cepOrigem', '$cepDestino', '$altura', '$largura', '$comprimento', '$peso', '$valorObjeto', '$codigoRastreio', NOW())";

    if (mysqli_query($conn, $sqlPedidos)) {
        // Inserir dados na tabela `rastreamento`
        date_default_timezone_set('America/Sao_Paulo');
        $evento = "Pedido criado"; // Evento inicial
        $dataEvento = date("Y-m-d H:i:s");
        $sqlRastreamento = "INSERT INTO rastreamento (codigo_rastreio, evento, data_evento) 
                            VALUES ('$codigoRastreio', '$evento', '$dataEvento')";

        if (!mysqli_query($conn, $sqlRastreamento)) {
            echo "Erro ao inserir rastreamento: " . mysqli_error($conn);
        }
    } else {
        echo "Erro ao inserir pedido: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento via Pix</title>
    <link rel="stylesheet" href="../css/pix.css">
</head>
<body>
    <div class="navbar">
    </div>
    <div class="container">
        <h2>Pagamento via Pix</h2>
        <div class="valor">Valor: R$ <?= number_format($valor, 2, ',', '.') ?></div>
        <div class="qr-code">
            <img src="https://th.bing.com/th/id/R.ef11902a952d7b33b2d1c0d65d0131c5?rik=0TuPU44WfKDPPA&pid=ImgRaw&r=0" alt="QR Code Pix" width="120px" height="120px">
        </div>
        <div class="codigo-pix" id="codigoPix">
            Código Pix:<br>
            <?= strtoupper($codigoPix) ?>
        </div>
        <div>
            <button class="btn btn-link" style="margin-bottom: 16px;" onclick="copiarCodigoPix()">Copiar código</button>
        </div>
        <form action="rastrear_pedido.php" method="POST">
            <input type="hidden" name="codigoRastreio" value="<?= htmlspecialchars($codigoRastreio) ?>">
            <input type="submit" value="Finalizar pagamento" class="btn btn-primary">
        </form>
    </div>
    <div class="footer">
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function copiarCodigoPix() {
            const codigoPix = document.getElementById('codigoPix').innerText.replace('Código Pix:', '').trim();
            navigator.clipboard.writeText(codigoPix).then(() => {
                alert('Código Pix copiado para a área de transferência!');
            }).catch(err => {
                console.error('Erro ao copiar o código Pix: ', err);
            });
        }
    </script>
</body>
</html>
