<?php
	class notfoundController extends Controller{

		public function index()
			{
				/* Envia Pagina Inicial */
				if (!empty($_SESSION['controle']))
						{
							/* Pega os dados do usuario */ 
								$usuario = new usuario();
					        	$dados['usuario'] = $usuario->getUsuarioId($_SESSION['controle']); 
				        	/* Pega os dados da tabela configurar*/
					        	$configurar = new configurar();
								$dados['configurar'] = $configurar->getconfigurar($dados['usuario']['id']);
							/* Envia para Visualização */
								$this->loadTemplate('404template', $dados); 
						} else{
							$this->loadView('404',$dados = array()); 

						}			
			}
		
}
?>