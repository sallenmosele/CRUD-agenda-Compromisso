<?php
session_start();
session_regenerate_id(true);
error_reporting(0);
include('classes/login.php');
include('classes/Maiuscula.php');
@$user = new LoginUser();

// gerar token
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}


if(isset($_POST['btn_cadUser'])){

  if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) { // validação ok
  function protect( &$str ) {
    /*** Função para retornar uma string/Array protegidos contra SQL/Blind/XSS Injection*/
          if( !is_array( $str ) ) {                      
                  $str = preg_replace( '/(from|select|insert|delete|where|drop|union|order|update|database)/i', '', $str );
                  $str = preg_replace( '/(&lt;|<)?script(\/?(&gt;|>(.*))?)/i', '', $str );
                  $tbl = get_html_translation_table( HTML_ENTITIES );
                  $tbl = array_flip( $tbl );
                  $str = addslashes( $str );
                  $str = strip_tags( $str );
                  return strtr( $str, $tbl );
          } else {
                  return array_filter( $str, "protect" );
          }
  }

  $font = new maiuscula();

  @$nome = protect($_POST['nome']);
  @$nome =  $font->maiusculaFont($nome);
  @$email = protect($_POST['email']);
  @$senha = protect($_POST['senha']);


  @$user->cadUser($nome, $email, $senha);

  unset($_SESSION['token']);

  }else{

    header("Refresh: 0;url=index.php");

  }

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

<style type="text/css">
      a:link {
        text-decoration: none;
      }
    
  </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
<body class="text-center">
  <form class="form-signin" method = "POST" action = "">
    
  <a href="https://hgsistemas.net" target="_blanc"><img class="mb-4" src="img/logo.png" alt="" width="200" height="200"></a>
    <h1 class="h3 mb-3 font-weight-normal">CADASTRO</h1>
    <?php
    if(isset($_SESSION['ok'])){
      echo $_SESSION['ok'];
      header("Refresh: 3;url=login.php");
      unset($_SESSION['token']);
      unset($_SESSION['ok']);
    }
    ?>
    <?php
    if(isset($_SESSION['erro'])){
      echo $_SESSION['erro'];
      unset($_SESSION['erro']);
      unset($_SESSION['token']);
    }
    ?>
    <input type="text" name="nome" id="inputName" class="form-control" placeholder="Nome" required autofocus autocomplete="on" >
    
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus autocomplete="on" >
  <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
    <input type="password" name="senha" id="inputPassword" maxlength="12" class="form-control" placeholder="Senha"  required  >
    <div class="d-flex justify-content-center">
                  
                </div><br>
    
    <p><a href="login.php">Já é usuário! fazer login</a></p>
    <button class="btn btn-lg btn-primary btn-block" name="btn_cadUser"  type="submit">Cadastrar</button>
    <p class="mt-5 mb-3 text-muted">&copy; HG</p>
    
  </form>
  
</body>
</html>
