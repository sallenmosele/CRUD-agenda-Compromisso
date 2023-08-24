<?php
session_start();
include('valida.php');
include_once('includes/conexao.php');
include('functions/function-limitartexto.php');

date_default_timezone_set('America/Bahia');

if (isset($_POST['btnCad'])) {


    if ((empty($_POST['name']) || empty($_POST['date']) || empty($_POST['description']))) {
        $_SESSION['erro'] = '<div class="text-danger text-center " role="alert" id="blink"><b>Preencha todos os campos!</b></div>';
        header("Refresh: 0;url=cadastrar.php");
        exit();
    } else {

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

        
        $name = protect($_POST['name']);
        $date = protect($_POST['date']);
        $description = protect($_POST['description']);
        $color = protect($_POST['color']);


        $query = $conectar->prepare("INSERT INTO agenda (name,date,description,color,user,created) VALUES (?,?,?,?,?, NOW()) ");
        $query->bindValue(1, $name);       
        $query->bindValue(2, $date);
        $query->bindValue(3, $description);
        $query->bindValue(4, $color);
        $query->bindValue(5, $_SESSION['nome']);


        if ($query->execute()) {
            $_SESSION['ok'] = '<div class="text-success text-center" role="alert"><img src="img/ok.png" width="50" height="50" class="img-fluid"> <b>Agendado com sucesso !</b></div>';
            header("Refresh: 0;url=cadastrar.php");
            exit();
        } else {

            $_SESSION['erro'] = '<div class="text-danger text-center" role="alert"><b>Erro ao cadastrar!</b></div>';
            header("Refresh: 0;url=cadastrar.php");
            exit();
        }
    }
}

?>


<?php include('includes/header.php'); ?>



<section>
    <div class="container mt-3">


        <form action="" method="POST">
            <div class="row">
                <div class="col-sm-3"><label for="exampleFormControlInput1" class="form-label">Evento</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Nome do evento" autocomplete="off">
                </div>
            
                
                <div class="col-sm-3"><label for="exampleFormControlInput1" class="form-label">Data</label>
                    <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                        <input placeholder="Selecione" type="text" name="date" id="exemplo" class="form-control" autocomplete="off">

                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm mt-3">
                    <label for="exampleFormControlInput1" class="form-label">Sinalizador</label> <br>
                    <label class="radio-inline">
                        <input type="radio" name="color" value="#63d867" checked>&nbspVerde&nbsp
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="color" value="#FF8C00">&nbspAmarelo&nbsp
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="color" value="#B22222">&nbspVermelho&nbsp
                    </label>
                </div>
            </div>
            <div class="text-center mt-3">
                <?php

                if (isset($_SESSION['erro']) || isset($_SESSION['ok'])) {
                    echo @$_SESSION['erro'];
                    unset($_SESSION['erro']);
                    echo @$_SESSION['ok'];
                    unset($_SESSION['ok']);
                }
                ?>
            </div>
            
            <div class="row">
                <div class="col-sm mt-3">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descrição</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4"></textarea>
                    </div>
                </div>

            </div>
            <button type="submit" name="btnCad" class="btn btn-primary mt-3">Cadastrar</button>
        </form>
    </div>

</div>
<div class="container mt-5 mb-5">
    <div class="mb-3">
    <div class="text-danger mb-5"><h6>Antes de cadastrar pesquise a data aqui!</h6></div>
        <form class="form-inline my-2 my-lg-0 mr-1" method="POST" action="">
						<div class="input-group"  id="date-picker-example" >
							<input class="form-control mr-sm-2" type="search" name="date" id="exemplo2" class="form-control" required placeholder="Pesquisar por data..." autocomplete="off">
							<div class="input-group-append">
								<button class="btn btn-secondary" name="pesquisar" type="submit">
									<i class="fa fa-search"></i>
								</button>
							</div>
						</div>
					</form>
    </div>

<table class="table bg-info">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Data</th>
    <th scope="col">Descrição</th>
    
    </tr>
</thead>
<tbody>
<?php
        
        if(isset($_POST['pesquisar'])){
        $date = htmlentities($_POST['date']);
        $sql = $conectar->prepare("SELECT * FROM agenda WHERE date LIKE '%$date%'");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $value) {
        ?>   
    <tr>
    <th scope="row"><?php echo htmlentities($value['id']) ?></th>
    <td><?php echo htmlentities($value['date']) ?></td>
    <td><?php $pt = $value['description'];
                echo limitarTexto($pt, $string = 30); ?></td>
    
    </tr>
    <?php } }?>
</tbody>
</table>
</div>
</section>


<?php include('includes/footer.php'); ?>