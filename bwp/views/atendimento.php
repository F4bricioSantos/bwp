<?php 
include "../conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $assunto = $conn->real_escape_string($_POST['assunto']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $mensagem = $conn->real_escape_string($_POST['mensagem']);
    $consentimento = isset($_POST['consentimento']) ? 1 : 0;

    // Inserção dos dados no banco de dados
    $sql = "INSERT INTO atendimentos (nome, email, assunto, telefone, mensagem, consentimento) VALUES ('$nome', '$email', '$assunto', '$telefone', '$mensagem', $consentimento)";

    if ($conn->query($sql) === TRUE) {
        //echo "Dados enviados com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte - Alcance | Logística S.A</title>
    <link rel="stylesheet" href="../css/atendimento.css">
</head>
<body>
<?php include "navbar.php";?>
<div class="container">
    <div>
        <p>Olá, Somos da Equipe de Suporte da Alcance Logística, estamos aqui para lhe ajudar a resolver a sua situação o mais rápido e eficiente possível.</p>
    </div>
    <h4>Central de Atendimento
        
    </h4>
    <form action="atendimento.php" method="POST">
    <div class="grupo">
        <div class="coluna">
            <label for="nome">Nome Completo</label>
            <input type="text" name="nome" placeholder="Seu nome" required>
        </div>
        <div class="coluna">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Seu email" required>
        </div>
    </div>
    <div class="grupo">
        <div class="coluna">
            <label for="assunto">Assunto</label>
            <input type="text" name="assunto" placeholder="Dúvidas ou sugestões" required>
        </div>
        <div class="coluna">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" placeholder="(xx) x xxxx-xxxx">
        </div>
    </div>
    <hr>
    <label for="mensagem">Mensagem</label>
    <input type="text" name="mensagem" class="msm" placeholder="Escreva sua mensagem" required>
    <div class="aceite">
        <p>Ao preencher este formulário, você consente com o tratamento dos seus dados pessoais para o uso da Alcance,<br> especialmente para: (i) envio de comunicações acerca dos negócios Alcance e/ou (ii) atendimento às solicitações<br> dos nossos formulários.</p>
        <div>
            <input type="checkbox" name="consentimento" class="marcar" required>
            <p class="termo">Estou de acordo com o Termo de Consentimento & Privacidade. Conheça nossa <a href="#" style="color:#043865;">política de privacidade</a></p>
        </div>
    </div>
    <input type="submit" value="ENVIAR" class="butao">
</form>

    <h6>Tel: (xx) xxxx-xxxx</h6>
</div>
<?php include"footer.php"; ?>
</body>
</html>