<div class="container-fluid">
		<div class="jumbotron">
			<h1>Nós temos hoje <?php echo $total_anuncios; ?> anúncios.</h1>
			<p>E mais de <?php echo $total_usuarios; ?> usuários cadastrados!</p>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<h4>Pesquisa Avançada</h4>
				<form method="GET">
					<div class="form-group">
						<label for="categoria">Escolha A Categoria</label>
						<select name="filtro[categoria]" id="categoria" class="form-control">
							<option></option>
							<?php 
								
								foreach ($categorias as $categoria):
							?>
								<option value="<?php echo $categoria['id'] ?>" <?php echo($filtros['categoria']==$categoria['id'])?'selected="select"':''; ?>><?php echo $categoria['nome'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label for="preco">Selecione o Preço</label>
						<select name="filtro[preco]" id="preco" class="form-control">
							<option></option>
							<option value="0-50" <?php echo($filtros['preco']=='0-50')?'selected="select"':''; ?>>R$ 0,00 a R$ 50,00</option>
							<option value="51-100" <?php echo($filtros['preco']=='51-100')?'selected="select"':''; ?>>R$ 51,00 a R$ 100,00</option>
							<option value="101-150" <?php echo($filtros['preco']=='101-150')?'selected="select"':''; ?>>R$ 101,00 a R$ 150,00</option>
							<option value="151-200" <?php echo($filtros['preco']=='151-200')?'selected="select"':''; ?>>R$ 151,00 a R$ 200,00</option>
							<option value="200-1000" <?php echo($filtros['preco']=='200-1000')?'selected="select"':''; ?>>R$ 200,00 a R$ 1000,00</option>
						</select>
					</div>
					<div class="form-group">
						<label for="estado">Informe o Estado do Produto</label>
						<select name="filtro[estado]" id="estado" class="form-control">
							<option></option>
							<option value="0" <?php echo($filtros['estado']=='0')?'selected="select"':''; ?>>RUIM</option>
							<option value="1" <?php echo($filtros['estado']=='1')?'selected="select"':''; ?>>BOM</option>
							<option value="2" <?php echo($filtros['estado']=='2')?'selected="select"':''; ?>>OTIMO</option>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-info" value="Buscar">
					</div>
				</form>
			</div>
			<div class="col-sm-9">
				<h4>Ultimos Anuncios</h4>
				<table class="table table-striped">
					<tbody>
						<?php foreach ($anuncios as $anuncio): ?>
							<tr>
								<td align="center">
							<?php if (!empty($anuncio['url'])): ?>
								<img src="<?php echo BASE_URL;?>assets/imagens/anuncios/<?php echo $anuncio['url']; ?>" height="50" border="0" alt="">
							<?php else: ?>
								<img src="<?php echo BASE_URL;?>assets/imagens/default.png" height="50" border="0" alt="">
							<?php endif; ?>
						</td>
						<td>
							<a href="<?php echo BASE_URL;?>Produto/visualizar/<?php echo $anuncio['id']; ?>"><?php echo $anuncio['titulo']; ?></a></br>
							<?php echo $anuncio['categoria']; ?>
						</td>
						<td>R$ <?php $anuncio['valor'] = number_format($anuncio['valor'],2);echo  str_replace(".", ",",$anuncio['valor']); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<ul class="pagination">
					<?php for ($q=1; $q <= $total_paginas; $q++):?>
						<li class="<?php echo ($q==$p)?'active':''; ?>"><a href="<?php echo BASE_URL;?>?
						<?php 
							$w = $_GET;
							$w['p']= $q;
							echo http_build_query($w);
						?>"><?php echo $q; ?></a></li>
					<?php endfor; ?>
				</ul>
			</div>
		</div>
	</div>	