<?php 
include('valida.php');
include_once('conexao.php');
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets2/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets2/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css">
    <link href="css/bootstrap-datepicker.css" rel="stylesheet"/>
    <style>
      
        #blink {
          
            animation: animate 
                1.2s linear infinite;
        }
  
        @keyframes animate {
            0% {
                opacity: 0;
            }
  
            50% {
                opacity: 0.7;
            }
  
            100% {
                opacity: 0;
            }
        }
    </style>
    <title>Agenda</title>
  </head>
  <body>
    

    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <a class="navbar-brand text-white" href="index.php">Agenda</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link text-white" href="cadastrar.php">Cadastrar evento <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="eventos.php">Eventos cadastrados</a>
      </li>
      <li class="nav-item">
        <?php
        if($_SESSION['nivel'] == '1'){
        $sql = $conectar->prepare("SELECT * FROM login where  id > '1' and status=0 ");
        if ($sql->execute()) {
          
          $rowcount = $sql->rowCount();
          $user = $rowcount;
          filter_var($user, FILTER_SANITIZE_NUMBER_INT);
      }
      echo '<a class="nav-link text-white" href="usuarios.php">Usuarios <span style="color:#00FFFF;">' .$user. '</span> </a>';
      }
        ?>
      
      </li>
      
      <li class="nav-item">
        <a class="nav-link text-white"  href="../index.php" target="_blank">Agenda</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="logout.php">Sair</a>
      </li>
    </ul>
  </div>
</nav>
    </header>