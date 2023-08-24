<?php
session_start();
include('valida.php');
include_once('includes/conexao.php');
include('functions/function-limitartexto.php');
?>


<?php include('includes/header.php'); ?>



<section>

  <div class="mt-3 mb-3">
    <?php
    if (isset($_SESSION['erro']) || isset($_SESSION['ok'])) {
      echo @$_SESSION['erro'];
      unset($_SESSION['erro']);
      echo @$_SESSION['ok'];
      unset($_SESSION['ok']);
    }
    ?>
  </div>
  <div class="container mt-5">
    <!-- AddToAny BEGIN -->
    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">

      <a class="a2a_button_print mb-3"></a>
    </div>
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    <!-- AddToAny END -->
    <table id="table" class="table table-striped table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Evento</th>
          <th scope="col">Data</th>
          <th scope="col">Descrição</th>
          <th scope="col">Usuário</th>
          <th scope="col">Excluir</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = $conectar->prepare("select * from agenda");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $value) {
        ?>
          <tr>
            <th scope="row"><?php echo htmlentities($value['id']) ?></th>
            <td><?php echo htmlentities($value['name']) ?></td>
            
          
            <td><?php echo htmlentities($value['date']) ?></td>
            <td><?php $pt = $value['description'];
                echo limitarTexto($pt, $string = 30); ?></td>
                <td><?php echo htmlentities($value['user']) ?></td>
            <td><?php echo "<a href='deletar.php?acao=deletar&id=" . htmlspecialchars($value['id']) . "' onclick='return confirm(\"Deseja realmente deletar?\")'><i class='fas fa-trash-alt'></i></a>"; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>


<?php include('includes/footer.php'); ?>