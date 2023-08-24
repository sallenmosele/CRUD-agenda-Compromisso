<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conectar = new PDO("mysql:host=$servername;dbname=agenda_master", $username, $password);
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conectar->exec("SET CHARACTER SET utf8");
} catch(PDOException $e) {
  echo "Erro: " . $e->getMessage();
}
?>