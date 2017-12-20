<?php

class AnunciosController extends Controller{

	public function index(){

		$sessao = new HomeController();
		$sessao->verificasessao();
		$dados = array();
		$u = new Usuarios();
		if (!empty($_SESSION['cLogin'])) {
			$dado['dados'] = $u->getId($_SESSION['cLogin']);
		}
		$a = new Anuncios();
		$anuncios = $a->getMeusAnuncios($_SESSION['cLogin']);

		$dados['dado'] = $dado;
		$dados['anuncios'] = $anuncios;


		$this->loadtemplate('anuncios',$dados);
	}

	public function Adicionar(){
		$sessao = new HomeController();
		$sessao->verificasessao();
		$dados = array();
		$u = new Usuarios();
		if (!empty($_SESSION['cLogin'])) {
			$dado['dados'] = $u->getId($_SESSION['cLogin']);
		}
		$a = new Anuncios();
		if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
			$titulo = addslashes($_POST['titulo']);
			$descricao = addslashes($_POST['descricao']);
			$categoria1 = addslashes($_POST['categoria']);
			$valor = addslashes($_POST['valor']);
			$estado = addslashes($_POST['estado']);
			$usuario = $_SESSION['cLogin'];
			$a->addAnuncio($usuario,$titulo,$descricao,$categoria1,$valor,$estado);

			?>
			<div class="alert alert-success">
				Produto adicionado com Sucesso!
			</div>
		<?php
		}
		$c= new Categorias();
		$categorias = $c->getCategorias();
		$dados['dado'] = $dado;
		$dados['categorias']=$categorias;

		$this->loadtemplate('add-anuncio',$dados);
	}

	public function Editar($id){
		$sessao = new HomeController();
		$sessao->verificasessao();
		$dados = array();
		$u = new Usuarios();
		if (!empty($_SESSION['cLogin'])) {
			$dado['dados'] = $u->getId($_SESSION['cLogin']);
		}

		$a = new Anuncios();
	
	if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
		$titulo = addslashes($_POST['titulo']);
		$descricao = addslashes($_POST['descricao']);
		$categoria1 = addslashes($_POST['categoria']);
		$valor = addslashes($_POST['valor']);
		$estado = addslashes($_POST['estado']);
		$usuario = $_SESSION['cLogin'];
		$id=addslashes($id);
		if (isset($_FILES['fotos'])) {
			$fotos= $_FILES['fotos'];
		}else{
			$fotos = array();
		};
		
		$a->editarAnuncio($usuario,$titulo,$descricao,$categoria1,$valor,$estado,$fotos,$id);

		?>
		<div class="alert alert-success">
			Produto Editado com Sucesso!
		</div>
		<?php
	}
	$c= new Categorias();
	$categorias = $c->getCategorias();
					
	if (isset($id) && !empty($id)) {
		$usuario = $_SESSION['cLogin'];
		$id=addslashes($id);
		$dados = $a->getAnuncio($id,$usuario);
	} else{
		header("Location: ".BASE_URL."Anuncios"); 
	}
		$dados['dado'] = $dado;
		$dados['dados']=$dados;
		$dados['categorias']=$categorias;

		$this->loadtemplate('editar-anuncio',$dados);	
	}

	public function Excluir($id){
		$sessao = new HomeController();
		$sessao->verificasessao();
		$dados = array();
		$u = new Usuarios();
		if (!empty($_SESSION['cLogin'])) {
			$dado['dados'] = $u->getId($_SESSION['cLogin']);
		}
		$a = new Anuncios();
		if (isset($id) && !empty($id)) {
			$id = addslashes($id);
			$usuario = $_SESSION['cLogin'];
			$a->excluirAnuncio($id,$usuario);
			header("Location: ".BASE_URL."Anuncios");
		}
	}

	public function ExcluirFoto($id){
		$sessao = new HomeController();
		$sessao->verificasessao();
		$dados = array();
		$u = new Usuarios();
		if (!empty($_SESSION['cLogin'])) {
			$dado['dados'] = $u->getId($_SESSION['cLogin']);
		}
		$a = new Anuncios();
		if (isset($id) && !empty($id)) {
			$id = addslashes($id);
			$usuario = $_SESSION['cLogin'];
			
			$id_anuncio = $a->excluirfoto($id,$usuario);
			
			if (isset($id_anuncio)) {
				header("Location: ".BASE_URL."Anuncios/Editar/".$id_anuncio);
			} else {
				header("Location: ".BASE_URL."Anuncios");
			}
			
		}
	}
}