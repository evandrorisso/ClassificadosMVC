<div class="container-fluid">
		<div class="row">
			<div class="col-sm-5">
				
				<div class="carousel slide" data-ride="carousel" id="meucarousel">
					
					<div class="carousel-inner" role="listbox">
						<?php foreach ($info['fotos'] as $chave => $foto):?>
								<div class="item <?php echo ($chave=='0')?'active':''; ?>">
								<img src="<?php echo BASE_URL;?>assets/imagens/anuncios/<?php echo $foto['url'];?>" alt="">
							</div>
						<?php endforeach; ?>
					</div>
					
					<a class="left carousel-control" href="#meucarousel" role="button" data-slide='prev'><span><</span></a>
					
					<a class="right carousel-control" href="#meucarousel" role="button" data-slide='next'><span>></span></a>
				</div>
			
			</div>
			<div class="col-sm-7">
				<h1><?php echo $info['titulo'] ?></h1>
				<h4><?php echo $info['categoria'] ?></h4>
				<h5><?php echo ($info['estado']=='0')?'RUIM':'';echo ($info['estado']=='1')?'BOM':'';echo ($info['estado']=='2')?'OTIMO':''; ?></h5>
				<p><?php echo $info['descricao'] ?></p>
				</br></br>
				<h3>R$ <?php $info['valor'] = number_format($info['valor'],2);echo  str_replace(".", ",",$info['valor']); ?></h3>
				<h4>Telefone: <?php echo $info['telefone'] ?></h4>

			</div>
		</div>
	</div>