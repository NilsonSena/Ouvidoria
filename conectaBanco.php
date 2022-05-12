<?php
	
	$servername = "localhost";
	$database = "mydb";
	$username = "root";
	$password = "Senhadeteste";


	$conectaBanco = mysqli_connect($servername, $username, $password, $database);
	
	if (!$conectaBanco) {
		die("Falha ao conectar ao banco: " . mysqli_connect_error());
		
	}else{
		echo "Conectado com sucesso";
	}
	mysqli_close($conectaBanco);
    
    ?>