<?php 
include "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $data_nascimento = trim($_POST['dn'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    $confirmsenha = trim($_POST['confirmsenha'] ?? '');

    // Função para remover pontos e traços do CPF
    function formatCPF($cpf) {
        return preg_replace('/[^0-9]/', '', $cpf);
    }

    $cpf = formatCPF($cpf);

    // Verificação se algum campo está vazio
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmsenha)) {
        echo "<script>alert('Todos os campos são obrigatórios'); window.location.href = '../cadastro.php';</script>";
        exit;
    }

    // Verificação se as senhas coincidem
    if ($senha !== $confirmsenha) {
        echo "<script>alert('As senhas não coincidem'); window.location.href = '../cadastro.php';</script>";
        exit;
    }

    // Verificação se o e-mail já existe
    $sql_email = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result_email = mysqli_query($conn, $sql_email);

    if (mysqli_num_rows($result_email) > 0) {
        echo "<script>alert('E-mail já cadastrado'); window.location.href = '../cadastro.php';</script>";
        exit;
    }

    // Verificação se o CPF já existe
    $sql_cpf = "SELECT * FROM `user` WHERE `cpf` = '$cpf'";
    $result_cpf = mysqli_query($conn, $sql_cpf);

    if (mysqli_num_rows($result_cpf) > 0) {
        echo "<script>alert('CPF já cadastrado'); window.location.href = '../cadastro.php';</script>";
        exit;
    }

    // Inserção do novo usuário
    $sql = "INSERT INTO `user` (`nome`, `cpf`, `data_nascimento`, `email`, `senha`) VALUES ('$nome', '$cpf', '$data_nascimento', '$email', '$senha')";

    if (mysqli_query($conn, $sql)) {
        header("location: ../index.php");
    } else {
        echo "<script>alert('Erro ao inserir usuário: " . mysqli_error($conn) . "'); window.location.href = '../cadastro.php';</script>";
    }

    $conn->close();
}

