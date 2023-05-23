<?php
namespace App\Controllers;
use App\Models\CadastraDados_model;
use ErrorException;
use FFI\Exception;
session_start();

class ExibeProtocolo extends BaseController {

	public function index(){
        //Define timezone
        date_default_timezone_set('America/Sao_Paulo');

        //Carrega o model para ser utilizado nesse Controller
        $cadastraDados_model = new CadastraDados_model();

        //Testa se existe a entrada de dados e pega tentativas de gerar protocolo sem existir algum cadastro
    
        if(!is_null(@$_SESSION['protocolo'])){
            return print "Você já gerou uma reclamação, clique <a href=index.php>Aqui</a> caso deseje fazer outra!";
        }
        try{
            $arrayProtocolos = $cadastraDados_model->cadastraUsuario(); 
    
            $protocolo = $arrayProtocolos['protocolo'];

            $senha = $arrayProtocolos['senha'];
            
            $_SESSION['protocolo'] = $protocolo;          
    
        }catch(\ErrorException $e){
            return print "Algo estranho aconteceu. Clique <a href=index.php>Aqui</a> para tentar novamente!";

        }           
        
        if((is_null($protocolo)) || ($protocolo == false)){

            print "Você digitou algo errado. Clique <a href=index.php>Aqui</a> para digitar um usuário válido!";
        
        }else{
            //$_SESSION['protocolo'] = $protocolo;
            $horaData =  date('d-m-Y H:i:s', time());
            $dadosArray = array("horario" => $horaData, "protocolo" => $protocolo, "senha" => $senha);
            
		    return view('ouvidoria/exibeProtocolo', $dadosArray);
            
        }
		
    }
}