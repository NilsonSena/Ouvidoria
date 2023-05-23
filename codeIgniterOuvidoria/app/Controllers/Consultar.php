<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use ErrorException;
use FFI\Exception;

class Consultar extends Controller{

    public function index(){
        //inicia sessão
        session_start();

        //inicia variavel de sessão para bloquear o TextArea e o botão
        $_SESSION['consultaComum'] = "1";

        try{
            //pega variavel protocolo via POST e repassa ela para uma sessão
            $protocolo = $_POST['protocolo'];
            $senhaProtocolo = $_POST['senhaProtocolo'];
            $_SESSION["protocolo"] = $protocolo;
            $_SESSION["senhaProtocolo"] = $senhaProtocolo;
            //recebe a resposta do select e adiciona ela em uma array para ser repassada para a View
            $data['dadosPesquisa'] = $this->getAllJobs($protocolo, $senhaProtocolo);
            //retorna view com os dados
            return view('ouvidoria\consultar.php', $data);

        }catch(\ErrorException $e){
            //retorna a primeira view
            return view('ouvidoria\consultar.php');
        }
    
    }

    private function getAllJobs($protocolo, $senhaProtocolo){
        //inicia banco de dados
        $db = db_connect();
        //faz o select no banco de dados se existir resposta
        $dados = $db->query("SELECT p.*, o.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_ouvi AS o ON p.protocolo_id = o.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id  WHERE p.protocolo_id LIKE '$protocolo' AND p.protocolo_senha LIKE '$senhaProtocolo' UNION SELECT p.*, a.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_anon AS a ON p.protocolo_id = a.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE p.protocolo_id LIKE '$protocolo' AND p.protocolo_senha LIKE '$senhaProtocolo' ORDER BY dtHoraProtocolo DESC;")->getResultObject();        
        //faz o select no banco de dados caso não exista resposta 
        if((current($dados) == '') || (current($dados) == NULL)){
            $dados = $db->query("SELECT * FROM protocolo WHERE protocolo_id LIKE '$protocolo' AND protocolo_senha LIKE '$senhaProtocolo'")->getResultObject();
        }
        //fecha banco
        $db->close();

        return $dados;
    }

}