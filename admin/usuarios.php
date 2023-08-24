<?php
session_start();
error_reporting(0);
include('valida.php');
if ($_SESSION['nivel'] != '1') {
  header('location: index.php');
} else {


  include_once('includes/conexao.php');

?>
  <?php include('includes/header.php'); ?>
  <section>
    <div class="container mt-3">
      <table id="table" class="table m-0 table-colored-bordered table-hover table-bordered-danger">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">email</th>
            <th scope="col">Status</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = $conectar->prepare("SELECT * FROM login");
          $sql->execute();
          $result = $sql->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as $row) {
            $statusUser = $row['status'];

          ?>
            <tr>
              <th scope="row"><?php echo htmlentities($row['id']) ?></th>
              <td><?php echo htmlentities($row['nome']) ?></td>
              <td><?php echo htmlentities($row['email']) ?></td>
              <td><?php if ($statusUser == 1) {
                    echo '<p class="text-success"><b>Ativo</b></p>';
                  } else {
                    echo '<p class="text-danger"><b>Inativo</b></p>';
                  } ?></td>
              <td><?php echo "<a href='editarUser.php?acao=editar&id=" . htmlspecialchars($row['id']) . "'>Editar</a>"; ?></td>
              <td><?php echo "<a href='deletaUser.php?acao=deletar&id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Deseja realmente deletar ". htmlspecialchars($row['nome']) ."?\")'>Deletar</a>";
                } ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </section>

  <?php include('includes/footer.php'); ?>