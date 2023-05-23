<?php 
    namespace APP\Models;
    use CodeIgniter\Model;
    class Consulta_model extends Model{

        public function consulta($protocolo){
            $db = db_connect();
            $dados = $db->query("SELECT * FROM protocolo WHERE protocolo_id LIKE '$protocolo'")->getResultObject();
            $db->close();
     
            return $dados;
        }
    }
?>