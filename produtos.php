<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <title>Produtos</title>
	<link rel="stylesheet" href="css/produtos.css">
</head>
<body>
	<section>
		<?php
			require "classes/cProduto.php";
			$p = new Produto('php','localhost','root','');
			$dadosProd = $p->buscarProdutos();
			if(empty($dadosProd)){
				echo "Ainda não há produtos cadastrados aqui!";
			}else {
				foreach ($dadosProd as $v) {
					?>
						<a href="exibir_produto.php?id=<?php echo $v['id_produto'];?>">
							<div>
								<img src="img/<?php echo $v['foto_capa'];?>">
								<h2><?php echo $v['nome_produto'];?></h2>
							</div>
						</a>
					<?php	
				}
			}
		?>
	</section>
</body>
</html>