<?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<section>
	<a href="produtos.php">Ver todos os produtos</a>
	<form method="POST" enctype="multipart/form-data">
		<h1>ENVIO DE IMAGENS</h1>
		<label for="nome">Nome do Produto</label>
		<input type="text" name="nome" id="nome">
		<label for="des">Descrição</label>
		<textarea name="desc" id="desc"></textarea>
		<input type="file" name="foto[]" multiple id="foto">
		<input type="submit" id="botao">
	</form>
	</section>
</body>
</html>
<?php
    if(isset($_POST['nome'])){
        $nome = htmlentities(addslashes($_POST['nome']));
        $descricao = htmlentities(addslashes($_POST['desc']));
        $fotos = array();
        if(isset($_FILES['foto'])){
            for ($i=0; $i < count($_FILES['foto']['name']); $i++) {
                $nome_arq = md5($_FILES['foto']['name'][$i].rand(1,999)).'.jpg';                
                move_uploaded_file($_FILES['foto']['tmp_name'][$i],'img/'.$nome_arq);
                array_push($fotos,$nome_arq);
            }
        }
        if(!empty($nome) && !empty($descricao)){
            require 'classes/cProduto.php';
            $p = new Produto('php','localhost','root','');
            $p->enviarProduto($nome,$descricao,$fotos);
            ?>
                <script type="text/javascript">
                    alert('Produto cadastrado com sucesso!');
                </script>
            <?php
        }else {
            ?>
                <script type="text/javascript">
                    alert('Preecha os campos obrigatórios!');
                </script>
            <?php
        }
    }
?>