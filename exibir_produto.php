<?php
	ob_start();
	require "classes/cProduto.php";
	$p = new Produto('php','localhost','root','');
	if(isset($_GET['id']) && !empty($_GET['id'])){
		$dadosProd = $p->buscarProdutoPorId($_GET['id']);
		$imagensProd = $p->buscarImgPorId($_GET['id']);
	}else {
		header("location: produtos.php");
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <title>Produtos</title>
	<link rel="stylesheet" href="css/exibir-prod.css">
</head>
<body>
	<section>
		<div>
			<h1><?php echo $dadosProd['nome_produto'];?></h1>
			<p><b>Descrição: </b><?php echo $dadosProd['descricao'];?></p>
		</div>
		<?php
			foreach ($imagensProd as $v) {
				?>
					<div id="imagens">
						<div class="caixa-img">
							<img src="img/<?php echo $v['nome_imagem'];?>">
						</div>
					</div>				
				<?php
			}
		?>
	</section>
</body>
</html>