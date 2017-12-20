<?php 
/**
* 
*/
class Usuarios extends Model 
{
	public function getTotalUsuarios(){
		
		$sql = $this->db->query("SELECT count(id) as total FROM usuarios");
		$total = $sql->fetch();
		return $total['total'];
	}

	public function cadastrar($nome, $email, $senha, $telefone){
		 
		$sql = $this->db->prepare("SELECT id FROM usuarios WHERE email= :email");
		$sql->bindValue(":email",$email);
		$sql->execute();

		if ($sql->rowCount() == 0){
			$sql = $this->db->prepare("INSERT INTO usuarios SET nome=:nome, senha=:senha, email=:email, telefone=:telefone");
			$sql->bindValue(":nome",$nome);
			$sql->bindValue(":senha", md5($senha));
			$sql->bindValue(":email", $email);
			$sql->bindvalue(":telefone",$telefone);
			$sql->execute();
			if ($sql->rowCount() > 0){
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	public function login($email,$senha){
		
		$sql = $this->db->prepare("SELECT * FROM usuarios where email=:email and senha=:senha");
		$sql->bindValue(":email",$email);
		$sql->bindValue(":senha",md5($senha));
		$sql->execute();
		if ($sql->rowCount() > 0){
			$dado = $sql->fetch();
			$_SESSION['cLogin'] = $dado['id'];
			return true;
		} else{
			return false;
		}
	}

	public function getId($id){
		
		$sql = $this->db->prepare("SELECT nome,telefone,email FROM usuarios where id=:id");
		$sql->bindValue(":id",$id);
		$sql->execute();
		if ($sql->rowCount() > 0){
			$dado = $sql->fetch();
			return $dado;
		}
	}

}

 ?>