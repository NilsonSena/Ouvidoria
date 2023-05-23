<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class CriaUsuario extends Controller{
    
    public function index(){
        
        session_start();
        if(@$_SESSION['login'] == '' || @$_SESSION['login'] == NULL){
            return print "Você precisa passar um usuário e senha. Clique <a href=login>Aqui</a>";	
        }

        if(empty($_POST)){
            return view('ouvidoria\criaUsuario');
        }else{ 
            $login = $_POST['login'];
            
            $senha = $_POST['senha'];
            
            if(!empty($_POST['check'])){
                $check = $_POST['check'];
            }else{
                $check = "0";
            }
        }
        if(($login == '' || $login == NULL) || ($senha == '' || $senha == NULL)){
        
            return "Favor digite os campos senha e login!";
        
        }else{

            $valida = $this->validaUsuarioExistente($login);
            

            foreach($valida as $data) {
                $nome = $data->nome;
            }
                
            if(!empty($nome)){
            
                $dados['dados'] = "existe";
                return view('ouvidoria\criaUsuario', $dados);
            
            }else{

                $this->insereDados($login, $senha, $check);
                $dados['dados'] = "vazio";
                return view('ouvidoria\criaUsuario', $dados);
            
            }
        
        }
    
    }

    private function validaUsuarioExistente($login){
        $db = db_connect();
        $dados = $db->query("SELECT nome FROM usuario WHERE nome = '$login'")->getResultObject();
        $db->close();
        return $dados;
    }

    private function insereDados($login, $senha, $check){
        $db = db_connect();
        $db->query("INSERT INTO usuario (`nome`, `senha`, `admin`) VALUES ('$login','$senha','$check')");
        $db->close();
    }
}