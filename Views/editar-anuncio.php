<div class="container">
		<h1>Meus Anuncios - Editar Anuncio</h1>
	
	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="categoria">Categoria</label>
			<select name="categoria" id="categoria" class="form-control">
				<option>Escolha A Categoria</option>
				<?php 
					foreach ($categorias as $categoria):
				?>
					<option value="<?php echo $categoria['id'] ?>" <?php echo($dados['id_categoria']==$categoria['id'])?'selected="selected"':'';?>><?php echo $categoria['nome'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="Titulo">Titulo</label>
			<input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $dados['titulo']; ?>">
		</div>
		<div class="form-group">
			<label for="valor">Valor</label>
			<input type="text" class="form-control" name="valor" id="valor" value="<?php echo str_replace(".", ",",$dados['valor']); ?>">
		</div>
		<div class="form-group">
			<label for="descricao">Descrição</label>
			<textarea name="descricao" id="descricao" class="form-control" cols="30" rows="10"><?php echo $dados['descricao'];?></textarea>
		</div>
		<div class="form-group">
			<label for="estado">Estado de Conservação:</label>
			<select name="estado" id="estado" class="form-control">
				<option>Informe o Estado do Produto</option>
				<option value="0" <?php echo($dados['estado']=='0')?'selected="selected"':'';?>>RUIM</option>
				<option value="1" <?php echo($dados['estado']=='1')?'selected="selected"':'';?>>BOM</option>
				<option value="2" <?php echo($dados['estado']=='2')?'selected="selected"':'';?>>OTIMO</option>
			</select>
		</div>
		<div class="form-group">
			<label for="foto">Fotos do Anúncio:</label>
			<input type="file" name="fotos[]" multiple>
			</br></br>
			<div class="panel panel-default">
				<div class="panel-heading">Fotos do Anúncio</div>
				<div class="panel-body">
					<?php foreach ($dados['fotos'] as $foto): ?>
						<div class="foto_item">
							<img src="<?php echo BASE_URL;?>assets/imagens/anuncios/<?php echo $foto['url'] ?>" alt="" border="0" class="img-thumbnail">
							<a href="<?php echo BASE_URL;?>/Anuncios/ExcluirFoto/<?php echo $foto['id'] ?>" class="btn btn-default">Excluir Imagem</a>
						</div>
					<?php endforeach; ?>	
				</div>
			</div>
		</div>

		<input type="submit" class="btn btn-default" value="Salvar">
	</form>

	</div>