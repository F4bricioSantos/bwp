<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Serviços e Pedidos - Alcance | Logística S.A.</title>
    <link rel="stylesheet" href="../css/servicos.css">
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container">
        <h1>Bem-vindo ao portal de serviços e pedidos da Alcance | Logística S.A.</h1>
        <p>Aqui você preencherá as informações do pedido, saberá valores, prazos e acompanhará a logística do seu pedido! Fique com a gente, aqui a gente RESOLVE não deixa pra depois.</p>
        <p>Entregue sua encomenda em uma de nossas agências.</p>
        <form action="processar_pedido.php" method="post">
            <label for="cepOrigem">Origem</label>
            <input type="text" id="cepOrigem" name="cepOrigem" placeholder="Informe o CEP" required>

            <label for="cepDestino">Destino</label>
            <input type="text" id="cepDestino" name="cepDestino" placeholder="Informe o CEP" required>

            <label for="altura">Altura (A) <span class="note">(Entre 1 e 400cm)</span></label>
            <input type="number" id="altura" name="altura" min="1" max="400" required>

            <label for="largura">Largura (L) <span class="note">(Entre 8 e 300cm)</span></label>
            <input type="number" id="largura" name="largura" min="8" max="300" required>

            <label for="comprimento">Comprimento (C) <span class="note">(Entre 13 e 500cm)</span></label>
            <input type="number" id="comprimento" name="comprimento" min="13" max="500" required>

            <label for="peso">Peso <span class="note">(Entre 1g e 700kg)</span></label>
            <input type="number" id="peso" name="peso" min="1" max="700000" required>

            <label for="valorObjeto">Valor do objeto</label>
            <input type="number" id="valorObjeto" name="valorObjeto" required>

            <input type="submit" value="Postar pedido">
        </form>
        <button><a href="rastrear_pedido.php">Rastreio</a></button>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
