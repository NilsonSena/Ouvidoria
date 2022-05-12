<?php
class geraProtocolo{
	public function buscaTodos(){
		return $this->db->get("Voucher")->result_array();

	}

	public function selecionaVoucher($login){
			$query = $this->db->query("SELECT Cod_voucher FROM voucher WHERE idUsuario = '1' order by idUsuario LIMIT 1");
  			$result = $query->result();
			$resultado = $result[0]->Cod_voucher;

  			$this->db->query("UPDATE voucher SET dtHora = current_timestamp() WHERE Cod_voucher = '$resultado'");

  			$query = $this->db->query("SELECT login_web.idUsuario FROM login_web INNER JOIN voucher ON voucher.idUsuario=login_web.idUsuario WHERE login_web.login = '$login'");

  			$result = $query->result();
  			$idUsuario = $result[0]->idUsuario;

  			
			
			$nome = $_POST['nome'];
			$telefone = $_POST['Telefone'];
			$cpf = $_POST['CPF'];



			$query = $this->db->query("SELECT cpf from dados_solicitante WHERE cpf = '$cpf'");
  			$result = $query->result();
  			@$result_cpf = $result[0]->cpf;
  			if(@$result_cpf ==''){
				$this->db->query("INSERT INTO dados_solicitante (nome, Telefone, CPF) VALUES ('$nome', '$telefone', '$cpf')");

  			}

			$query = $this->db->query("SELECT idUsuario from dados_solicitante WHERE cpf = '$cpf'");
  			$result = $query->result();
  			$result_idUsuario = $result[0]->idUsuario;

			$this->db->query("UPDATE voucher INNER JOIN login_web ON voucher.idUsuario=login_web.idUsuario SET voucher.idUsuario = '$result_idUsuario', voucher.idLoginWeb = '$idUsuario' WHERE voucher.Cod_voucher = '$resultado'");


  			return $resultado;
	}

	public function invalidaVoucher($codigoUsado){
			//$codigoUsado = selecionaVoucher();
			$query = $this->db->query("SELECT dtHora FROM voucher WHERE Cod_voucher = '$codigoUsado'");
			$result = $query->result();

			return $result[0]->dtHora;
	}
}
?>