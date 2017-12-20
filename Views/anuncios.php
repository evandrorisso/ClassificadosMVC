<div class="container">
		<h1>Meus Anúncios</h1>

		<a href="<?php echo BASE_URL;?>Anuncios/Adicionar" class="btn btn-default">Cadastrar Novo Anuncios</a>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Foto</th>
					<th>Titulo</th>
					<th>Valor</th>
					<th>Ações</th>
				</tr>	
			</thead>
			<tbody>
				<?php
				foreach ($anuncios as $anuncio):
				?>
					<tr>
						<td align="center">
							<?php if (!empty($anuncio['url'])): ?>
								<img src="<?php echo BASE_URL;?>assets/imagens/anuncios/<?php echo $anuncio['url']; ?>" height="50" border="0" alt="">
							<?php else: ?>
								<img src="<?php echo BASE_URL;?>assets/imagens/default.png" height="50" border="0" alt="">
							<?php endif; ?>
						</td>
						<td><?php echo $anuncio['titulo']; ?></td>
						<td>R$ <?php $anuncio['valor'] = number_format($anuncio['valor'],2);echo  str_replace(".", ",",$anuncio['valor']); ?></td>
						<td>
							<a href="<?php echo BASE_URL;?>Anuncios/Editar/<?php echo $anuncio['id']; ?>" class="btn btn-default">EDITAR</a>
							<a href="<?php echo BASE_URL;?>Anuncios/Excluir/<?php echo $anuncio['id']; ?>" class="btn btn-danger">EXCLUIR</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>