<?php
    include('conectaBanco.php');

    $nome = $_POST['cadNome'];
    $email = $_POST['cadEmail'];
    $telefone = $_POST['cadTel'];

    require('conectaBanco.php');

    $sql = "('$nome', '$email', '$telefone')";

    mysqli_query($conectaBanco, $sql) or die("Erro ao tentar cadastrar registro");

    echo "Cadastrado com sucesso";
    print strtoupper(md5(date("dmYHis01333222312")));


?>
