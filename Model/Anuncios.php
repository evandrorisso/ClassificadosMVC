<?php 
/**
* 
*/
class Anuncios extends Model
{
	public function getUltimosAnuncios($page,$qtd,$filtros){
		
		$total = array();
		$offset = ($page - 1)*$qtd;

		$filtrostring =array('1=1');
		if(!empty($filtros['categoria'])){
			$filtrostring[] = ' anuncios.id_categoria = :id_categoria';
		}
		if(!empty($filtros['preco'])){
			$filtrostring[] = ' anuncios.valor BETWEEN :preco1 AND :preco2';
		}
		if(!empty($filtros['estado'])){
			$filtrostring[] = ' anuncios.estado = :estado';
		}

		$sql = $this->db->prepare("SELECT *, (SELECT anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url, (SELECT categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria FROM anuncios WHERE ".implode(' AND ',$filtrostring)." order by id DESC LIMIT $offset,$qtd");
		if(!empty($filtros['categoria'])){
			$sql->bindValue(":id_categoria",$filtros['categoria']);
		}
		if(!empty($filtros['preco'])){
			$preco = explode('-',$filtros['preco']);
			$sql->bindValue(":preco1",$preco[0]);
			$sql->bindValue(":preco2",$preco[1]);
		}
		if(!empty($filtros['estado'])){
			$sql->bindValue(":estado",$filtros['estado']);
		}

		
		
		$sql->execute();
		$total = $sql->fetchALL();
		return $total;

	}

	public function getTotalAnuncios($filtros){
		

		$filtrostring =array('1=1');
		if(!empty($filtros['categoria'])){
			$filtrostring[] = ' anuncios.id_categoria = :id_categoria';
		}
		if(!empty($filtros['preco'])){
			$filtrostring[] = ' anuncios.valor BETWEEN :preco1 AND :preco2';
		}
		if(!empty($filtros['estado'])){
			$filtrostring[] = ' anuncios.estado = :estado';
		}

		$sql = $this->db->prepare("SELECT count(id) as total FROM anuncios WHERE ".implode(' AND ',$filtrostring)."");
		
		if(!empty($filtros['categoria'])){
			$sql->bindValue(":id_categoria",$filtros['categoria']);
		}
		if(!empty($filtros['preco'])){
			$preco = explode('-',$filtros['preco']);
			$sql->bindValue(":preco1",$preco[0]);
			$sql->bindValue(":preco2",$preco[1]);
		}
		if(!empty($filtros['estado'])){
			$sql->bindValue(":estado",$filtros['estado']);
		}

		$sql->execute();
		$total = $sql->fetch();
		return $total['total'];

	}
	public function getMeusAnuncios($id){
		
		$array = array();
		$sql = $this->db->prepare("SELECT *, (SELECT anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url FROM anuncios WHERE id_usuario = :id_usuario");
		$sql->bindValue(":id_usuario",$id);
		$sql->execute();

		if($sql->rowCount()>0){
			$array = $sql->fetchALL();
		}

		return $array;
	}

	public function addAnuncio($usuario,$titulo,$descricao,$categoria,$valor,$estado){
		
		$sql = $this->db->prepare("INSERT INTO anuncios set titulo=:titulo, id_usuario=:usuario, descricao=:descricao, id_categoria=:categoria, valor=:valor, estado = :estado");
		$sql->bindValue(":titulo",$titulo);
		$sql->bindValue(":usuario",$usuario);
		$sql->bindValue(":descricao",$descricao);
		$sql->bindValue(":categoria",$categoria);
		$sql->bindValue(":valor",str_replace(",", ".",$valor));
		$sql->bindValue(":estado",$estado);
		$sql->execute();
	}

	public function excluirAnuncio($id,$usuario){
		
		
		$sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id_anuncio=:id_anuncio");
		$sql->bindValue(":id_anuncio",$id);
		$sql->execute();

		$sql = $this->db->prepare("DELETE FROM anuncios where id_usuario=:id_usuario and id=:id");
		$sql->bindValue(":id_usuario",$usuario);
		$sql->bindValue(":id",$id);
		$sql->execute();
	}

	public function getAnuncio($id,$usuario){
		
		$array = array();
		$sql = $this->db->prepare("SELECT * FROM anuncios where id=:id and id_usuario=:id_usuario");
		$sql->bindValue(":id",$id);
		$sql->bindValue("id_usuario",$usuario);
		$sql->execute();

		if($sql->rowCount()>0){
			$array = $sql->fetch();
			$array['fotos'] = array();
			$sql = $this->db->prepare("SELECT id,url FROM anuncios_imagens WHERE id_anuncio =:id_anuncio");
			$sql->bindValue(":id_anuncio",$id);
			$sql->execute();
			if ($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchALL();
			}
		};

		return $array;
	}

	public function getAnuncioVisual($id){
		
		$array = array();
		$sql = $this->db->prepare("SELECT *, (SELECT categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria, (SELECT usuarios.telefone from usuarios where usuarios.id = anuncios.id_usuario) as telefone FROM anuncios where id=:id");
		$sql->bindValue(":id",$id);
		$sql->execute();

		if($sql->rowCount()>0){
			$array = $sql->fetch();
			$array['fotos'] = array();
			$sql = $this->db->prepare("SELECT id,url FROM anuncios_imagens WHERE id_anuncio =:id_anuncio");
			$sql->bindValue(":id_anuncio",$id);
			$sql->execute();
			if ($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchALL();
			}
		};

		return $array;
	}

	public function editarAnuncio($usuario,$titulo,$descricao,$categoria,$valor,$estado,$fotos,$id){
		
		$sql = $this->db->prepare("UPDATE anuncios set titulo=:titulo, id_usuario=:usuario, descricao=:descricao, id_categoria=:categoria, valor=:valor, estado = :estado where id=:id");
		$sql->bindValue(":titulo",$titulo);
		$sql->bindValue(":usuario",$usuario);
		$sql->bindValue(":descricao",$descricao);
		$sql->bindValue(":categoria",$categoria);
		$sql->bindValue(":valor",str_replace(",", ".",$valor));
		$sql->bindValue(":estado",$estado);
		$sql->bindValue(":id",$id);
		$sql->execute();

		if (count($fotos) > 0) {
			for ($q=0; $q < count($fotos['tmp_name']); $q++) { 
				$tipo = $fotos['type'][$q];
				if (in_array($tipo, array('image/jpeg','image/png'))) {
					$tmpname=md5(time().rand(0,9999)).'.jpg';
					move_uploaded_file($fotos['tmp_name'][$q], 'assets/imagens/anuncios/'.$tmpname);
					list($width_orig, $height_orig) = getimagesize('assets/imagens/anuncios/'.$tmpname);
					$ratio =$width_orig/$height_orig;
					$width=500;
					$height = 500;

					if(($width/$height)>$ratio){
						$width = $height*$ratio;
					}else{
						$height =$width/$ratio;
					};

					$img= imagecreatetruecolor($width, $height);
					if ($tipo =='image/jpeg') {
						$origi = imagecreatefromjpeg('assets/imagens/anuncios/'.$tmpname);
					}elseif ($tipo == 'image/png') {
						$origi = imagecreatefrompng('assets/imagens/anuncios/'.$tmpname);
					};

					imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
					imagejpeg($img,'assets/imagens/anuncios/'.$tmpname,80);

					$sql = $this->db->prepare("INSERT INTO anuncios_imagens SET id_anuncio=:id_anuncio, url=:url");
					$sql->bindValue(":id_anuncio",$id);
					$sql->bindValue(":url",$tmpname);
					$sql->execute();
				}
			}
		}
	}

	public function excluirfoto($id,$usuario){
		
		$id_anuncio = 0;

		$sql = $this->db->prepare("SELECT id_anuncio FROM anuncios_imagens WHERE id =:id");
			$sql->bindValue(":id",$id);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$row = $sql->fetch();
				$id_anuncio = $row['id_anuncio'];
			}
		
		$sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id=:id");
		$sql->bindValue(":id",$id);
		$sql->execute();

		return $id_anuncio;
	}
}

 ?>