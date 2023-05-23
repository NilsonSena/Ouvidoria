<?php
namespace App\Controllers;
session_start();
use App\Models\CadastraAnonimo_model;
use ErrorException;
use FFI\Exception;

class ProtocoloAnon extends BaseController {

	public function index(){
        
        //Define timezone
        date_default_timezone_set('America/Sao_Paulo');
    
        //Carrega o model para ser utilizado nesse Controller
        $cadastraAnonimo_model = new CadastraAnonimo_model();

        //Testa se existe a entrada de dados e pega tentativas de gerar protocolo sem existir algum cadastro
    
        if(!is_null(@$_SESSION['protocolo'])){

            return print "Você já gerou uma reclamação, clique <a href=index.php>Aqui</a> caso deseje fazer outra!";
        
        }
        
        try{
            $arrayProtocolos = $cadastraAnonimo_model->cadastraAnonimo(); 

            $protocolo = $arrayProtocolos['protocolo'];

            $senha = $arrayProtocolos['senha'];

            $_SESSION['protocolo'] = $protocolo;          
    
        }catch(\ErrorException $e){

            return print "Algo estranho aconteceu. Clique <a href=index.php>Aqui</a> para tentar novamente!";

        }           
        
        if((is_null($protocolo)) || ($protocolo == false)){

            return print "Você fez algo errado. Clique <a href=index.php>Aqui</a> para tentar novamente!";
        
        }else{
            //$_SESSION['protocolo'] = $protocolo;
            $horaData =  date('d-m-Y H:i:s', time());
            $dadosArray = array("horario" => $horaData, "protocolo" => $protocolo, "senha" => $senha);
            
            return view('ouvidoria/protocoloAnon', $dadosArray);
            
        }
    }
}