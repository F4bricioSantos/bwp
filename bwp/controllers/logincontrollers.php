<?php  
error_reporting(0);
session_start();

include "../conexao.php";

if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql_user = "SELECT * FROM user WHERE `email` = '$email' AND `senha` = '$senha'";
    $user = mysqli_query($conn, $sql_user);

    if (!$user) {
        die("Erro na consulta SQL: " . mysqli_error($conn));
    }

    $row_user = mysqli_fetch_array($user);

    if ($row_user) {
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $row_user['id'];
        header("location: ../views/home.php");
        exit;
    } else {
        $_SESSION['LoginMensagem'] = "Email ou senha incorretos.";
        header("Location: ../index.php");
        exit;
    }
}
?>
