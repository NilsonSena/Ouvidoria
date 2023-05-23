<?php
    namespace APP\Models;
    use CodeIgniter\Model;
    use ErrorException;
    use FFI\Exception;
    class MenuADM_model extends Model{

        public function authLogin($usuario,$senha){
                
            if($usuario=='LIVRE'){
                return false;
            }

            $query = $this->db->query("SELECT nome FROM usuario where nome='$usuario' and senha='$senha' limit 1");
            
            $result = $query->getResultObject();
            
            $queryADM = $this->db->query("SELECT `admin` FROM usuario where nome='$usuario'");
            
            $resultADM = $queryADM->getResultObject();

            foreach ($result as $row){
                    $login = $row->nome;
            }

            foreach ($resultADM as $key) {
                $isADM = $key->admin;
            }

            //return false;
            if(@$login == $usuario){
                $arrayDados = array();
                array_unshift($arrayDados, $isADM, true);
                return $arrayDados;
            }else{
                return false;
            }
        }
    }
?>