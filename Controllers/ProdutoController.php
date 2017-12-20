<?php

class ProdutoController extends Controller{

	public function index()
	{
	
	}
	public function visualizar($id)
	{
		$dados = array();
		$u = new Usuarios();
		if (!empty($_SESSION['cLogin'])) {
			$dado['dados'] = $u->getId($_SESSION['cLogin']);
			$dados['dado'] = $dado;
		}
		$a = new Anuncios();

		if (empty($id)) {
			header("Location: ".BASE_URL);
			exit;
		}

		$info = $a->getAnuncioVisual($id);
		$dados['info'] = $info;
		
		$this->loadtemplate('produto',$dados);
	}
}