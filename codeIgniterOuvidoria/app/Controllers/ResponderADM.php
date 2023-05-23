<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ResponderADM extends Controller
{
    public function index(){
        //inicia sessão
        session_start();
        //valida se a sessão e login são validos
        if(@$_SESSION['login'] == '' || @$_SESSION['login'] == NULL){
            return print "Você precisa passar um usuário e senha. Clique <a href=login>Aqui</a>";	
        }

        try{
            //$_SESSION['protocolo'] = $_POST('protocolo');
            //$protocolo = $_SESSION['protocolo'];
            $protocolo = $_POST['protocolo'];
            
            //verifica se o campo data está marcado
            if(isset($_POST['dataInicial']) && ($_POST['dataFinal'])){
                
                $dataInicial = $_POST['dataInicial'];
                $dataFinal = $_POST['dataFinal'];
                //verifica se o checkbox Respondidos ou Não Respondidos está marcado
                if(isset($_POST['checkR']) || isset($_POST['checkN'])){
                    //verifica se ambos os checkbox estão marcados
                    if(isset($_POST['checkR']) && isset($_POST['checkN'])){
                        $check = 'ambos';

                    }elseif(isset($_POST['checkR'])){
                        $check = $_POST['checkR'];
                    }else{
                        $check = $_POST['checkN'];
                    }
                    //adiciona ao array dadosPesquisa o resultado do select
                    $data['dadosPesquisa'] = $this->filtraData($dataInicial, $dataFinal, $check);
                //caso não tenha checkbox marcado ele define o valor do checkbox como 'nenhum'    
                }else{

                    $check = 'nenhum';
                    //adiciona ao array dadosPesquisa o resultado do select
                    $data['dadosPesquisa'] = $this->filtraData($dataInicial, $dataFinal, $check);
                
                }

                $_SESSION['dadosPesquisa'] = $data;
                //retorna a View responderADM com os dados 
                return view('ouvidoria\responderADM.php', $data);
            }
            //verifica se o checkbox Respondidos ou Não Respondidos está marcado
            if(isset($_POST['checkR']) || isset($_POST['checkN'])){
                //verifica se ambos os checkbox estão marcados
                if(isset($_POST['checkR']) && isset($_POST['checkN'])){
                    $check = 'ambos';
                }elseif(isset($_POST['checkR'])){
                    $check = $_POST['checkR'];
                }else{
                    $check = $_POST['checkN'];
                }    
                //adiciona ao array dadosPesquisa o resultado do select
                $data['dadosPesquisa'] = $this->selecionaTodos($check);
            }else{
                //caso não tenha checkbox marcado ele define o valor do checkbox como 'nenhum'
                if($protocolo == '' || $protocolo == NULL){
                    
                    $check = 'nenhum';
                    //adiciona ao array dadosPesquisa o resultado do select
                    $data['dadosPesquisa'] = $this->selecionaTodos($check);
                    
                    $_SESSION['dadosPesquisa'] = $data;
                    //retorna a View responderADM com os dados
                    return view('ouvidoria\responderADM.php', $data);
                }
                //adiciona ao array dadosPesquisa o resultado do select
                $data['dadosPesquisa'] = $this->consultaProtocolo($protocolo);
            }
                
            $_SESSION['dadosPesquisa'] = $data;
            //retorna a View responderADM com os dados
            return view('ouvidoria\responderADM.php', $data);

        }catch(\ErrorException $e){
            //No primeiro load e em caso de erro retorna a View responderADM
            return view('ouvidoria\responderADM.php');

        }
    }
    //função para retornar os dados referentes a apenas 1 protocolo
    private function consultaProtocolo($protocolo){

        $db = db_connect();
        
        $dados = $db->query("SELECT p.*, o.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_ouvi AS o ON p.protocolo_id = o.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE p.protocolo_id = '$protocolo' UNION SELECT p.*, a.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_anon AS a ON p.protocolo_id = a.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE p.protocolo_id = '$protocolo' ORDER BY dtHoraProtocolo DESC;")->getResultObject();
        
        if((current($dados) == '') || (current($dados) == NULL)){
            $dados = $db->query("SELECT * FROM protocolo WHERE protocolo_id LIKE '$protocolo'")->getResultObject();
        }
        
        $db->close();
 
        return $dados;

    }
    //função para retornar os dados sem marcação de data nos casos de respondidos, não respondidos e todos
    private function selecionaTodos($check){

        $db = db_connect();

        if($check == 'respondidos'){
            $dados = $db->query("SELECT p.*, o.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_ouvi AS o ON p.protocolo_id = o.protocolo_id INNER JOIN resposta AS r ON r.protocolo_id = p.protocolo_id UNION SELECT p.*, a.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_anon AS a ON p.protocolo_id = a.protocolo_id INNER JOIN resposta AS r ON r.protocolo_id = p.protocolo_id ORDER BY dtHoraProtocolo DESC;")->getResultObject();
        }elseif($check == 'naoRespondidos'){
            $dados = $db->query("SELECT p.*, o.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_ouvi AS o ON p.protocolo_id = o.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE resposta IS NULL UNION SELECT p.*, a.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_anon AS a ON p.protocolo_id = a.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE resposta IS NULL ORDER BY dtHoraProtocolo DESC;")->getResultObject();
        }else{
            $dados = $db->query("SELECT p.*, o.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_ouvi AS o ON p.protocolo_id = o.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id UNION SELECT p.*, a.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_anon AS a ON p.protocolo_id = a.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id ORDER BY dtHoraProtocolo DESC;")->getResultObject();
        }
       
        $db->close();

        return $dados;

    }

    //função para retornar os dados com marcação de data nos casos de respondidos, não respondidos e todos
    private function filtraData($dataInicial, $dataFinal, $check){

        $db = db_connect();
        
        if($check == 'respondidos'){
            $dados = $db->query("SELECT p.*, o.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_ouvi AS o ON p.protocolo_id = o.protocolo_id INNER JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE p.dtHoraProtocolo BETWEEN cast('$dataInicial' as datetime) AND cast('$dataFinal' as datetime) UNION SELECT p.*, a.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_anon AS a ON p.protocolo_id = a.protocolo_id INNER JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE p.dtHoraProtocolo BETWEEN cast('$dataInicial' as datetime) AND cast('$dataFinal' as datetime) ORDER BY dtHoraProtocolo DESC;")->getResultObject();
        }elseif($check == 'naoRespondidos'){
            $dados = $db->query("SELECT p.*, o.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_ouvi AS o ON p.protocolo_id = o.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE resposta IS NULL AND p.dtHoraProtocolo BETWEEN cast('$dataInicial' as datetime) AND cast('$dataFinal' as datetime) UNION SELECT p.*, a.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_anon AS a ON p.protocolo_id = a.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE resposta IS NULL AND p.dtHoraProtocolo BETWEEN cast('$dataInicial' as datetime) AND cast('$dataFinal' as datetime) ORDER BY dtHoraProtocolo DESC;")->getResultObject();
        }else{
            $dados = $db->query("SELECT p.*, o.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_ouvi AS o ON p.protocolo_id = o.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE p.dtHoraProtocolo BETWEEN cast('$dataInicial' as datetime) AND cast('$dataFinal' as datetime) UNION SELECT p.*, a.reclamacao, r.resposta FROM protocolo AS p INNER JOIN cad_anon AS a ON p.protocolo_id = a.protocolo_id LEFT JOIN resposta AS r ON r.protocolo_id = p.protocolo_id WHERE p.dtHoraProtocolo BETWEEN cast('$dataInicial' as datetime) AND cast('$dataFinal' as datetime) ORDER BY dtHoraProtocolo DESC;")->getResultObject();
        }
        $db->close();
 
        return $dados;

    }
        
}