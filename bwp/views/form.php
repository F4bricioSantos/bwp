<?php
include "../conexao.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $idade = intval($_POST['idade']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $cidade = $conn->real_escape_string($_POST['cidade']);
    $area = $conn->real_escape_string($_POST['area']);
    $salario = $conn->real_escape_string($_POST['salario']);
    $marca = $conn->real_escape_string($_POST['marca']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $eletrico = $conn->real_escape_string($_POST['eletrico']);
    $motivo = $conn->real_escape_string($_POST['motivo']);
    $termo = isset($_POST['termo']) ? 1 : 0;

    // Processando o upload do arquivo
    $anexo = $_FILES['anexo'];
    $anexo_nome = $conn->real_escape_string(basename($anexo['name']));
    $anexo_caminho = 'uploads/' . $anexo_nome;

    if (move_uploaded_file($anexo['tmp_name'], $anexo_caminho)) {
        // Inserção dos dados no banco de dados
        $sql = "INSERT INTO candidatos (nome, idade, email, telefone, cidade, area, salario, marca, modelo, eletrico, motivo, anexo, termo) VALUES ('$nome', $idade, '$email', '$telefone', '$cidade', '$area', '$salario', '$marca', '$modelo', '$eletrico', '$motivo', '$anexo_caminho', $termo)";

        if ($conn->query($sql) === TRUE) {
            echo "Dados enviados com sucesso!";
        } else {
            echo "Erro: " . $conn->error;
        }
    } else {
        echo "Erro ao fazer upload do arquivo.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Aplicação - Alcance | Logística S.A</title>
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <?php include "navbar.php";?>
    <div class="content">
         
        <div class="header-section">
            <div class="header-text">
                <h2>Trabalhe com a Gente</h2>
                <h3>Descubra porque aqui na Alcance a gente movimenta carreiras, sonhos e histórias.</h3>
                <h2>Somos feitos para quem quer crescer e se desenvolver</h2>
                <h3>No nosso movimento tem espaço para inovar, para abrir novos caminhos e trilhar sua carreira com autonomia e apoio de uma liderança que inspira. Gente como a gente que nunca deixa um problema pra depois e resolve com eficiência e muita responsabilidade. Valorizamos a vida e não baixamos a guarda quando o assunto é segurança. Um jogo que nunca está ganho, e nós, nunca satisfeitos. E aí, se enxergou nesse movimento?</h3>
            </div>
            <div class="header-image">
                <img src="../img/form.jpeg" alt="Imagem de Cabeçalho">
            </div>
        </div>
        <div class="container">
            <h2>Formulário de Aplicação</h2>
            <form action="form.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome" style="margin-top: 44px;">Nome completo:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="idade">Idade:</label>
                    <input type="number" id="idade" name="idade" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Número para contato:</label>
                    <input type="text" id="telefone" name="telefone" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade onde reside:</label>
                    <input type="text" id="cidade" name="cidade" required>
                </div>
                <div class="form-group">
                    <label for="area">Área que planeja atuar:</label>
                    <input type="text" id="area" name="area" required>
                </div>
                <div class="form-group">
                    <label for="salario">Faixa salarial que planeja ganhar:</label>
                    <input type="text" id="salario" name="salario" required>
                </div>
                <div class="form-group inline">
                    <div>
                        <label for="marca">Marca do seu veículo:</label>
                        <input type="text" id="marca" name="marca" required>
                    </div>
                    <div>
                        <label for="modelo">Modelo do veículo:</label>
                        <input type="text" id="modelo" name="modelo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="eletrico">É Elétrico ou não poluente:</label>
                    <select id="eletrico" name="eletrico" required>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="motivo">Porque quer trabalhar na Alcance | Logística S.A:</label>
                    <textarea id="motivo" name="motivo" required></textarea>
                </div>
                <div class="form-group attachment">
                    <label for="anexo">Envie um anexo com total visão interior e exterior do veículo:</label>
                    <input type="file" id="anexo" name="anexo" accept="image/*" required>
                </div>
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="termo" name="termo" required>
                    <label for="termo">Estou de acordo com o Termo de Consentimento & Privacidade.</label>
                </div>
                <div class="button-container">
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
    <?php include "footer.php";?>
</body>
</html>
