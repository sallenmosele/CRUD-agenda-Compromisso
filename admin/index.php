<?php include('includes/header.php');

date_default_timezone_set('America/Bahia');

$hr = date(" H ");
if($hr >= 12 && $hr<18) {
$resp = "Boa tarde";}
else if ($hr >= 0 && $hr <12 ){
$resp = "Bom dia";}
else {
$resp = "Boa noite";}
?>



<section>
<div class="card">
  <div class="card-body">
  <?php echo $resp; ?><?php if($_SESSION['nivel']==1){echo ' administrador';}else{echo ' usuário';}?>! <?php echo $_SESSION['nome']; ?>
  </div>
  
</div>
<div class="container mt-5">
<div class="d-flex justify-content-center">
<a href="#" target="_blanc"><img src="img/agenda.png" width="400" height="400" alt="" class="img-fluid"></a>
</div>
</div>
</section>


<?php include('includes/footer.php'); ?>