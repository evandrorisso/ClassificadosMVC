<?php
	class HomeController extends Controller{

		public function index()
			{
				$u = new Usuarios();
				$total_usuarios = $u->getTotalUsuarios();
				if (!empty($_SESSION['cLogin'])) {
					$dado['dados'] = $u->getId($_SESSION['cLogin']);
					$dados['dado'] = $dado;
				}
				/**/
				
				$a = new Anuncios();
				$c= new Categorias();

				$filtros = array(
					'categoria' => '',
					'preco' => '',
					'estado' =>''
					);
				if (isset($_GET['filtro']) && !empty($_GET['filtro'])) {
					$filtros = $_GET['filtro'];
				}


				$total_anuncios= $a->getTotalAnuncios($filtros);
				$p = 1;
				if (isset($_GET['p']) && !empty($_GET['p'])) {
					$p = addslashes($_GET['p']);
				}

				$por_pagina = 2;

				$total_paginas = ceil($total_anuncios / $por_pagina);

				$anuncios = $a->getUltimosAnuncios($p,$por_pagina,$filtros);
				$categorias = $c->getCategorias();

				$dados['total_anuncios']=$total_anuncios;
				$dados['total_usuarios']=$total_usuarios;
				$dados['categorias']=$categorias;
				$dados['filtros']=$filtros;
				$dados['anuncios']=$anuncios;
				$dados['total_paginas']=$total_paginas;
				

				/* Envia Pagina Inicial */
				$this->loadtemplate('home',$dados);
			}
		public function Login(){
			$u = new Usuarios();
			$dados = array();
			if (!empty($_SESSION['cLogin'])) {
					$dado['dados'] = $u->getId($_SESSION['cLogin']);
					$dados['dado'] = $dado;
				}
		
			if (isset($_POST['email']) && !empty($_POST['email'])){
				$email = addslashes($_POST['email']);
				$senha = addslashes($_POST['senha']);
				if (!empty($email) && !empty($senha)){
					if ($u->login($email,$senha)){
							header("Location: ".BASE_URL);
						} else {
							?>
							<div class="alert alert-danger">
								E-mail ou Senha estão errados! <a href="login.php" class="alert-link" >Faça o login agora</a>
							</div>
							<?php
						}
					
				} else{
					?>
					<div class="alert alert-warning">
						Preencha todos os campos!
					</div>
					<?php 
				}
			}
			
			$this->loadtemplate('login',$dados);	
		}

		public function verificasessao(){
			if (empty($_SESSION['cLogin'])) {
				header("Location: ".BASE_URL."Home/Login");	
				exit;
			}
		}

		public function sair(){
			unset($_SESSION['cLogin']);
			header("Location: ".BASE_URL);
			
		}

		public function cadastrar(){
			$u = new Usuarios();
			$dados = array();
			if (!empty($_SESSION['cLogin'])) {
					$dado['dados'] = $u->getId($_SESSION['cLogin']);
					$dados['dado'] = $dado;
				}
		if (isset($_POST['nome']) && !empty($_POST['nome'])){
			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);
			$confirmarsenha = addslashes($_POST['confirmarsenha']);
			$telefone = addslashes($_POST['telefone']);
			if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmarsenha)){
				if ($senha == $confirmarsenha) {
					if ($u->cadastrar($nome,$email,$senha,$telefone)){
						?>
							<div class="alert alert-success">
								<strong>Parabéns</strong> - Usuario Cadastrado com Sucesso!. <a href="login.php" class="alert-link" >Faça o login agora</a>
							</div>
						<?php
					} else {
						?>
						<div class="alert alert-warning">
							E-mail Já Cadastrado! <a href="login.php" class="alert-link" >Faça o login agora</a>
						</div>
						<?php
					}
				} else { ?>
					<div class="alert alert-warning">
						Senha Não Confere!
					</div>
				<?php }
			} else{
				?>
				<div class="alert alert-warning">
					Preencha todos os campos!
				</div>
				<?php 
			}

		}

			$this->loadtemplate('cadastrar',$dados);

		}
	}
?>