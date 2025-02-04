<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/cadastroo.css">
</head>

<body>
  <div class="card">
    <div style="display: flex;
      justify-content: center;
      align-items: center;"><img src="img/1709131075544.jpg" class="login-logo"></div>
    <h2 class="card-title">Cadastro</h2>
    <form action="controllers/cadastrocontrollers.php" method="POST">
      <div class="form-outline">
        <input type="text" id="form2Example3" class="form-control" name="nome" placeholder="Nome"/>
      </div>

      <div class="form-outline">
        <input type="text" id="form2Example3" class="form-control" name="cpf" placeholder="CPF"/>
      </div>

      <div class="form-outline">
        <input type="date" id="form2Example3" class="form-control" name="dn" placeholder="Data de Nascimento"/>
      </div>

      <div class="form-outline">
        <input type="email" id="form2Example1" class="form-control" name="email" placeholder="E-mail"/>
      </div>

      <div class="form-outline">
        <input type="password" id="form2Example2" class="form-control" name="senha" placeholder="Senha"/>
      </div>

      <div class="form-outline">
        <input type="password" id="form2Example4" class="form-control" name="confirmsenha" placeholder="Confirmar Senha"/>
      </div>

      <div style="display: flex;
      justify-content: center;
      align-items: center;">
        <input type="submit" value="cadastrar" class="btn btn-primary btn-block">
      </div>
      <div class="text-center mt-3">
        <p>Já tem uma conta? <a href="index.php">Login</a></p>
      </div>
    </form>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
