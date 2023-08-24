<?php
session_start();
error_reporting(0);
include 'classes/login.php';

if (isset($_POST['email'])) {

  function protect(&$str)
        {
            /*** Função para retornar uma string/Array protegidos contra SQL/Blind/XSS Injection*/
            if (!is_array($str)) {
                $str = preg_replace('/(from|select|insert|delete|where|drop|union|order|update|database)/i', '', $str);
                $str = preg_replace('/(&lt;|<)?script(\/?(&gt;|>(.*))?)/i', '', $str);
                $tbl = get_html_translation_table(HTML_ENTITIES);
                $tbl = array_flip($tbl);
                $str = addslashes($str);
                $str = strip_tags($str);
                return strtr($str, $tbl);
            } else {
                return array_filter($str, "protect");
            }
        }

  $email =  protect($_POST['email']);
  $senha = addslashes($_POST['senha']);

  $login = new LoginUser();

  $login->login($email, $senha);
}
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.79.0">
  <title>HG SISTEMAS</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    a:link {
      text-decoration: none;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin">
    <form action="" method="POST">
      <a href="#" target="_blanc"><img class="mb-4" src="img/logo.png" alt="" width="200" height="200"></a>
      <h1 class="h3 mb-3 fw-normal">Agenda</h1>

      <label for="inputEmail" class="visually-hidden">Email</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email " autofocus>
      <label for="inputPassword" class="visually-hidden">Senha</label>
      <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha">
      <div class="checkbox mb-3">
        <label>
          <p>Ainda não é usuário! <a href="cadastro.php">Cadastre-se</a> </p>
        
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2018-<?php echo date('Y') ?></p>
    </form>
    <?php if (isset($_SESSION['erro'])) {

      echo $_SESSION['erro'];
      unset($_SESSION['erro']);
    }



    ?>
  </main>



</body>

</html>