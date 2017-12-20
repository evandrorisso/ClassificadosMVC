<?php 
/**
* 
*/
class Categorias extends Model
{
	
	public function getCategorias(){
		
		$array = array();
		$sql = $this->db->query("SELECT * FROM categorias ORDER BY nome");
		
		if ($sql->rowCount()>0) {
			$array = $sql->fetchALL();
		}
		return $array;
	}

	public function getNomeCategoria($id){
		
		$sql = $this->db->prepare("SELECT nome FROM categorias where id=:id");
		$sql->bindValue(":id",$id);
		$sql->execute();
		if ($sql->rowCount()>0) {
			$array = $sql->fetch();
		}
		return $array['nome'];	
	}
}


 ?>