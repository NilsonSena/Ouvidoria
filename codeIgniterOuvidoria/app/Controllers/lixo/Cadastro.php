<?php
namespace App\Controllers;
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends BaseController {

	public function index()
	{

		    $_SESSION['nome'] = $_POST['cadNome'];
            $_SESSION['email'] = $_POST['cadEmail'];
            $_SESSION['telefone'] = $_POST['cadTel'];
            $_SESSION['reclamacao'] = $_POST['cadReclamacao'];
				

        if(is_null(@$_SESSION) || $_SESSION['nome'] =='' || $_SESSION['email'] == '' || $_SESSION['telefone'] == '' || $_SESSION['reclamacao'] == ''){
            print "Você precisa preencher todos os campos para prosseguir com a reclamação!";
            
            $autenticado = false;
        }else{
            $autenticado = true;
        }            

		if($autenticado==true){
			return view('ouvidoria/exibeProtocolo.php');
            //$this->load->view('ouvidoria/exibeProtocolo');
		}
		else
			print "Você digitou algo errado. Clique <a href=#>Aqui</a> para digitar um usuário válido!";
	    }
}