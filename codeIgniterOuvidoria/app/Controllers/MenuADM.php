<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\MenuADM_model;
use ErrorException;
session_start();

class MenuADM extends BaseController {

	public function index(){
        //valida login
		 
		if(@$_SESSION['login'] != '' or !is_null(@$_SESSION) ){
            
			try{
				$menuADM_model = new MenuADM_model();
				
				$login = $_POST['usuario'];
				$senha = $_POST['senha'];
			}catch(ErrorException $e){
				if(@$_SESSION['login'] == '' || @$_SESSION['login'] == NULL){
					return print "Você precisa passar um usuário e senha. Clique <a href=login>Aqui</a>!";	
				}else{
					$login = $_SESSION['login'];
					$db = db_connect();
					$dados = $db->query("SELECT `admin` FROM usuario WHERE nome = '$login'")->getResultObject();
					$dadosPesquisa['dadosPesquisa'] = $dados[0];
					$db->close();
					return view('ouvidoria\menuADM.php', $dadosPesquisa);
				}
				return print "Você precisa passar um usuário e senhas. Clique <a href=login>Aqui</a>!";
			}

			//valida no banco o login e senha
            $autentica = $menuADM_model->authLogin($login, $senha); 
			try{
				if($autentica[1] == true){
					$_SESSION['login'] = $login;
				}
			}catch(ErrorException $e){
				return print "Você precisa passar um usuário e senhas válidos! Clique <a href=login>Aqui</a>!";
			}

			if((!isset ($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)){
				unset($_SESSION['login']);
				unset($_SESSION['senha']);
				header('location:.');
			}
			
			//pega variavel para saber se é admin ou não
			$dadosPesquisa['dadosPesquisa'] = $autentica[0]; 

			//verifica validação e carrega a página
			if($autentica[1]==true){
				
				if($autentica[0] == 1){
					return view('ouvidoria\menuADM.php', $dadosPesquisa);	
				}
				
				return view('ouvidoria\menuADM.php');
			
			}else{
				print "Você precisa passar um usuário e senha corretos. Clique <a href=login>Aqui</a>!";
			}
        
		}else{
			print "Você precisa passar um usuário e senha corretos! Clique <a href=login>Aqui</a>!";
		}
		
		
    }
}