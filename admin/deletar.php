<?php
session_start();
error_reporting(0);
include('valida.php');
include_once 'includes/conexao.php';

?>

<?php
include 'includes/header.php';
?>

<?php


        if (isset($_GET['acao']) && $_GET['acao'] == 'deletar') :

            $id = (int)$_GET['id'];
            $sql = $conectar->prepare("delete  FROM agenda where id = $id");
            

            if($sql->execute()){
              $_SESSION['ok'] = '<div class="text-success text-center" role="alert"><b>Deletado com sucesso!</b></div>';
              header("location: eventos.php");
            }else{
              $_SESSION['erro'] = '<div class="text-danger text-center" role="alert"><b>Erro ao Deletar!</b></div>';
              header("location: eventos.php");
            }
  
          endif;


        ?>      


<?php
include 'includes/footer.php';
?>