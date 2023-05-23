<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class RedefineSenha extends Controller{
    
    public function index(){
        //inicia sessão e valida se existe um usuário logado na sessão
        session_start();
        if(@$_SESSION['login'] == '' || @$_SESSION['login'] == NULL){
            return print "Você precisa passar um usuário e senha. Clique <a href=login>Aqui</a>";	
        }

        //verifica se existe dados no POST para executar as funções
        if(!empty($_POST)){

            $login = $_POST['login'];
            
            $senha = $_POST['senha'];
            
            if(!empty($_POST['check'])){
                $check = $_POST['check'];
            }else{
                $check = "0";
            }

            if(($login == '' || $login == NULL) || ($senha == '' || $senha == NULL)){
        
                return "Favor digite os campos senha e login!";
            
            }else{
    
                $valida = $this->validaUsuarioExistente($login);
    
                foreach($valida as $data) {
                    $nome = $data->nome;
                }
                    
                if(!empty($nome)){
                
                    $this->atualizaDados($login, $senha, $check);
                    $dados['dados'] = "existe";
                    return view('ouvidoria\redefineSenha', $dados);
                
                }else{
    
                    $dados['dados'] = "vazio";
                    return view('ouvidoria\redefineSenha', $dados);
                
                }       
            }
        }

        return view('ouvidoria\redefineSenha');
    
    }

    //Valida de existe um usuário com o nome/login passado
    private function validaUsuarioExistente($login){
        $db = db_connect();
        $dados = $db->query("SELECT nome FROM usuario WHERE nome = '$login'")->getResultObject();
        $db->close();
        return $dados;
    }

    //Passa os dados para o banco após validação feita
    private function atualizaDados($login, $senha, $check){
        $db = db_connect();
        $db->query("UPDATE usuario SET senha = '$senha', `admin` = '$check' WHERE nome = '$login';");
        $db->close();
    }
}