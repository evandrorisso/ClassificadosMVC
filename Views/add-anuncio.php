<div class="container">
		<h1>Meus Anuncios - Adicionar Anuncio</h1>
	
	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="categoria">Categoria</label>
			<select name="categoria" id="categoria" class="form-control">
				<option>Escolha A Categoria</option>
				<?php 
					foreach ($categorias as $categoria):
				?>
					<option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['nome'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="Titulo">Titulo</label>
			<input type="text" class="form-control" name="titulo" id="titulo">
		</div>
		<div class="form-group">
			<label for="valor">Valor</label>
			<input type="text" class="form-control" name="valor" id="valor">
		</div>
		<div class="form-group">
			<label for="descricao">Descrição</label>
			<textarea name="descricao" id="descricao" class="form-control" cols="30" rows="10"></textarea>
		</div>
		<div class="form-group">
			<label for="estado">Estado de Conservação:</label>
			<select name="estado" id="estado" class="form-control">
				<option>Informe o Estado do Produto</option>
				<option value="0">RUIM</option>
				<option value="1">BOM</option>
				<option value="2">OTIMO</option>
			</select>
		</div>
		<input type="submit" class="btn btn-default" value="Cadastrar">
	</form>

	</div>