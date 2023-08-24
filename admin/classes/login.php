<?php

class LoginUser
{

  private $nome;
  private $email;
  private $senha;
  private $nivel;
  private $status;
  private $conectar;
  public $msg;

  public function msg()
  {

    $this->msg;
  }

  public function cadUser($nome, $email, $senha)
  {
    include_once 'includes/conexao.php';
    $this->nome = $nome;
    $this->email = $email;
    $this->senha = $senha;
    $this->nivel = $nivel;
    $this->status = $status;
    $this->conectar = $conectar;

    $verifica = ($this->nome && $this->email && $this->senha);

    if ((empty($verifica))) {    //verifica campos vazios
      return $this->msg = $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>Preencha todos os campos</b></div>';
      exit();
    }

    if (preg_match('/\d+/', mb_convert_kana($this->nome, 'n')) > 0) {    //verifica se numeros foram digitados
      return $this->msg = $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>Seu nome não deve conter números</b></div>';
      exit();
    }

    if (!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $this->email)) {    // valida email
      return $this->msg = $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>Email inválido!</b></div>';
      exit();
    }



    if ((strlen($this->senha)) < 8) {   // verifica se a senha tem nenos de 8 digitos
      return $this->msg = $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>A senha deve ter no mínimo 8 caracteres!</b></div>';
      exit();
    }



    $sql = ("SELECT email FROM login WHERE email = :email ");
    $select =  $this->conectar->prepare($sql);
    $select->bindParam(':email', $this->email);
    $select->execute();

    if ($select->rowCount() > 0) { // verifica se ja existe um email cadastrado
      return $this->msg =  $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>Este E-mail já esta cadastrado!</b></div>';
      exit();
    }

    $sql = ("SELECT id FROM login");
    $select = $this->conectar->prepare($sql);
    $select->execute();

    if ($select->rowCount() < 1) { //somente o primeiro cadastro(admin) e liberado no painel
      $status = 1;
      $nivel = 1;
    } else {
      $status = 0;
      $nivel = 2;
    }


    $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO login (nome, email, senha, nivel, status, created) VALUES(:nome, :email, :senha, :nivel, :status, NOW())";
    $stmt = $this->conectar->prepare($sql);
    $stmt->bindParam(':nome',  $this->nome);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':senha', $this->senha);
    $stmt->bindParam(':nivel', $nivel);
    $stmt->bindParam(':status', $status);
    $result = $stmt->execute();

    if ($result) { // Cadastra os dados do formulario

      return $this->msg = $_SESSION['ok'] = '<div class="alert alert-success text-center" role="alert"><b>Cadastrado com sucesso!</b></div>';
    } else {
      //include_once('sendMail.php');
      return $this->msg = $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>Erro ao cadastrar!</b></div>';
      exit();
    }
  }

  public function login($email, $senha) // Login
  {


    include_once 'includes/conexao.php';
    $this->email = $email;
    $this->senha = $senha;
    @$this->id = $id;
    @$this->status = $status;
    @$this->conectar = $conectar;

    $verifica = ($this->email && $this->senha);

    if ((empty($verifica))) { // verifica campos em branco
      return $this->msg = $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>Preencha todos os campos</b></div>';
      exit();
    }




    $sql = ("SELECT email, senha FROM login WHERE email = :email");
    $select = $this->conectar->prepare($sql);
    $select->bindParam(':email', $this->email);

    $select->execute();

    $results = $select->fetchAll(PDO::FETCH_OBJ);

    if ($select->rowCount() > 0) { // valida a entrada e redireciona conforme o nivel do usuario

      foreach ($results as $row) {
        $hashpass = $row->senha;
      }

      if (password_verify($this->senha, $hashpass)) {



        $verificar = $this->conectar->query("SELECT * FROM login");



        while ($linha = $verificar->fetch(PDO::FETCH_ASSOC)) {
          if ($linha['email'] == $this->email && $linha['senha'] == $hashpass) {

            $this->email = $linha['email'];
            $this->nome = $linha['nome'];
            $this->nivel = $linha['nivel'];
            $this->id = $linha['id'];
            $this->status = $linha['status'];

            switch ($this->nivel) {
              case ($this->status == 0):
                //usuario sem nivel de acesso
                return $this->msg =  $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>Acesso aquardando liberação!</b></div>';


                break;

              case ($this->nivel == 1): //  administrador

                $_SESSION['email'] = $this->email;
                $_SESSION['nome'] = $this->nome;
                $_SESSION['nivel'] = $this->nivel;
                $_SESSION['id'] = $this->id;
                $_SESSION['status'] = $this->status;
                header('location: index.php');

                break;

              case ($this->nivel == 2): // usuario
                $_SESSION['email'] = $this->email;
                $_SESSION['nome'] = $this->nome;
                $_SESSION['nivel'] = $this->nivel;
                $_SESSION['id'] = $this->id;
                $_SESSION['status'] = $this->status;

                header('location: index.php');


                break;

              case ($this->nivel > 3): // outro nivel

                header('location: login.php');

                break;

              default:
                header('location: login.php');
                break;
            }
          }
        }
      } else {

        //erro de login
        return $this->msg =  $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>Erro! Email ou senha</b></div>';
      }
    } else {
      //úsuario nao cadastrado
      return $this->msg =  $_SESSION['erro'] = '<div class="alert alert-danger text-center" role="alert"><b>Usuário não cadastrado!</b></div>';
    }
  }
}
