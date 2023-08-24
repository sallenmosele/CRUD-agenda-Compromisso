<?php
session_start();
include('valida.php');
$nivel = $_SESSION['nivel'];
include_once 'includes/conexao.php';



function protect($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<?php
include('includes/header.php')
?>





<?php


if (isset($_POST['atualizar'])) :

    $id = protect($_POST['id']);
    $status  = protect($_POST['status']);


$sql = $conectar->prepare('Update login set status=:status where id=:id');
    $sql->bindValue(':status', $status);
    $sql->bindValue(':id', $id);


    if ( $sql->execute()) {
        $_SESSION['ok'] = '<div class="alert alert-success text-center" role="alert"><b>Editato com sucesso!</b></div>';
        header("location: editarUser.php?acao=editar&id=$id");
        exit();
    } else {
        $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>Erro ao cadastrar!</b></div>';
        header("location: editarUser.php?acao=editar&id=$id");
        exit();
    }

endif;

?>

<div class="container mt-3">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <?php
        if (isset($_SESSION['erro']) || isset($_SESSION['ok'])) {
            echo @$_SESSION['erro'];
            unset($_SESSION['erro']);
            echo @$_SESSION['ok'];
            unset($_SESSION['ok']);
        }
        ?>
        <div class="row-sm-lg">

            <?php

            $id = (int)$_GET['id'];
            $sql = $conectar->prepare("SELECT * FROM login where id = $id");

            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $status = $row['status'];

                if ($status == '1') {
                    $status_ativo = 'checked';
                }
                if ($status == '0') {
                    $status_inativo = 'checked';
                }


            ?>
                <?php if ($nivel == '1') { ?>
                    <div class="form-check">
                        <input class="form-check-input" name="status" type="radio" name="exampleRadios" id="exampleRadios1" value="1" <?php echo htmlentities($status_ativo) ?>>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <label class="form-check-label" for="exampleRadios1">
                            Ativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="status" type="radio" name="exampleRadios" id="exampleRadios2" value="0" <?php echo htmlentities($status_inativo) ?>>
                        <label class="form-check-label" for="exampleRadios2">
                            Inativo
                        </label>
                </div>
            
                <div class="d-grid gap-2 d-md-block mt-3 mb-3">
                    <button class="btn btn-warning" name="atualizar" type="submit">Editar</button>
                    <button class="btn btn-primary hBack" type="button">Voltar</button>

                </div>
                <?php } ?>
    </form>
</div>

<?php }?>

<?php
include 'includes/footer.php';
?>