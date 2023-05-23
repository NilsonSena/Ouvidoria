<?php namespace APP\Models;
    use CodeIgniter\Model;
    use ErrorException;
    use FFI\Exception;
    class CadastraAnonimo_model extends Model{ 

        public function cadastraAnonimo(){
            
            try{
                //gera protocolo aleatório que não se repete
                $protocolo = strtoupper(md5(date("dmYHis01333222312")));
                //gera senha aleatória de 6 digitos
                $senha = rand(100000, 999999);

                $reclamacao = $_POST['reclamacaoAnonima'];
                
                $arrayProtocolo = array(
                    "protocolo" => $protocolo,
                    "senha" => $senha
                );
                //pega ip do usuário que está gerando o protocolo
                $ip = $this->get_client_ip();
                $user_agent = $_SERVER['HTTP_USER_AGENT'];

            }catch(\ErrorException $e){

                return false;
                
            }

            $this->db->query("INSERT INTO `cad_anon` (`protocolo_id`, `reclamacao`) VALUES ('$protocolo', '$reclamacao')");
            $this->db->query("INSERT INTO `protocolo` (`protocolo_id`, `protocolo_senha`, `ip`, `user_agent`) VALUES ('$protocolo', '$senha', '$ip', '$user_agent')");

            $this->db->query("UPDATE protocolo SET dtHoraProtocolo = current_timestamp() WHERE protocolo_id = '$protocolo'");
            
            return $arrayProtocolo;
        }

        //pega o ip do usuário
        private function get_client_ip() {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return @$ipaddress ."|" .@$_SERVER['REMOTE_ADDR'] ."|".@$_SERVER['HTTP_FORWARDED']."|".@$_SERVER['HTTP_X_FORWARDED']."|".@$_SERVER['HTTP_CLIENT_IP'];
        }

    }
?>