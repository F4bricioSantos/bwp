<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="card">
    <div style="display: flex;
      justify-content: center;
      align-items: center;"><img src="img/1709131075544.jpg" class="login-logo" ></div>
    <h2 class="card-title">Login</h2>
    <form action="controllers/logincontrollers.php" method="POST">
      <div class="form-outline">
        <input type="email" id="form2Example1" name="email" class="form-control" placeholder="E-mail"/>
      </div>

      <div class="form-outline">
        <input type="password" id="form2Example2" name="senha" class="form-control" placeholder="Senha"/>
      </div>

      <div class="form-check mb-4">
        <div>
        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
        <label class="form-check-label" for="form2Example31"> Lembrar-me </label>
      </div>
      <div>
        <a href="#" class="forgot-password ms-auto" >Esqueceu a senha?</a>
      </div>
      </div>

      <div class="button-login">
        <input type="submit" class="btn btn-primary btn-block" value="Entrar">
      </div>
      <div class="text-center mt-3">
        <p>Nâo tem cadastro? <a href="cadastro.php">Registrar-se</a></p>
      </div>
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
