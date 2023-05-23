<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Resposta extends Controller {

	public function index(){
        
        session_start();
        
        if(isset($_SESSION['consultaComum'])){
            if($_SESSION['consultaComum'] != "1"){
            
                if(@$_SESSION['login'] == '' || @$_SESSION['login'] == NULL){
                    return print "Você precisa passar um usuário e senha. Clique <a href=login>Aqui</a>!";
                }
            
            }
        }

        try{

            date_default_timezone_set('America/Sao_Paulo');
            
            if(isset($_GET["var"])){
            
                $protocolo = $_GET["var"];
                $_SESSION['protocolo'] = $protocolo;
                $data['dadosPesquisa'] = $this->getAllJobs($protocolo);
                $data['dadosResposta'] = $this->dadosResposta($protocolo);

                return view('ouvidoria\resposta.php', $data);
            
            }
            
            try{
                $protocolo = $_POST['protocolo'];
                
                if(!empty($_POST['resposta'])){
                    
                    $login = $_SESSION['login'];
                    $sei = $_POST['sei'];
                    $resposta = $_POST['resposta'];
                    
                    $db = db_connect();
                    $sql = $db->query("SELECT idusuario FROM usuario WHERE nome LIKE '$login'")->getResultObject();
                    
                    foreach($sql as $data) {
                        $idusuario = $data->idusuario;
                    }

                    $horaData =  date('Y-m-d H:i:s', time());
                    //print_r($idusuario);
                    
                    $db->query("INSERT INTO `resposta` (`protocolo_id`, `sei`, `dtHoraResposta`, `resposta`, `idusuario`) VALUES ('$protocolo','$sei','$horaData','$resposta', '$idusuario')");
                    
                    $db->close();
                    //$this->db->query("UPDATE protocolo SET dtHoraResposta = current_timestamp() WHERE protocolo_id = '$protocolo'");
                    
                    
                    return view('ouvidoria\fimResposta.php');
                    

                }

            }catch(\ErrorException $e){
                return 'erro';
            }
            
            return view('ouvidoria\resposta.php');

        }catch(\ErrorException $e){
        echo "respondido com sucesso!";
        echo "clique <a href='responderADM'>aqui</a> para voltar para a página anterior!";
        }
    }

    private function getAllJobs($protocolo){
        
        $db = db_connect();

        $sql = $db->query("SELECT o.*, r.resposta, r.sei FROM cad_ouvi as o LEFT JOIN Resposta as r ON o.protocolo_id = r.protocolo_id WHERE o.protocolo_id = '$protocolo'")->getResultObject();
        
        if(($sql == '' || $sql == NULL)){
            $sql = $db->query("SELECT o.*, r.resposta, r.sei FROM cad_anon as o LEFT JOIN Resposta as r ON o.protocolo_id = r.protocolo_id WHERE o.protocolo_id = '$protocolo'")->getResultObject();     
        }

        //$dados = $db->query("SELECT resposta FROM resposta WHERE protocolo_id LIKE '$protocolo'")->getResultObject();
        
        $db->close();
        
        return $sql;
    }

    private function dadosResposta($protocolo){
        
        $db = db_connect();

        $sql = $db->query("SELECT * FROM resposta WHERE protocolo_id = '$protocolo';")->getResultObject();

        $db->close;

        return $sql;
    }
}