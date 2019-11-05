<style>
    input{
        display:block;
    }
</style>
<form method="POST" enctype="multipart/form-data">
    <label>NOME</label>
    <input type="text" name="nome">
    <label>EMAIL</label>
    <input type="text" name="email">
    <input type="file" name="foto">
    <input type="submit" >
</form>
<pre>
<?php
    if(isset($_POST['nome'])){
        echo $_POST['nome'].'<br>';
        echo $_POST['email'].'<br>';
        //var_dump($_FILES['foto']);
        if(isset($_FILES['foto'])){
            if($_FILES['foto']['type'] == "image/jpeg"){
                $nome_foto = md5($_FILES['foto']['name'].rand(1,999)).'.jpg';
                move_uploaded_file($_FILES['foto']['tmp_name'],'img/'.$nome_foto);
                echo "Imagem enviada com sucesso!";
            }elseif($_FILES['foto']['type'] == "image/png"){
                $nome_foto = md5($_FILES['foto']['name'].rand(1,999)).'.png';
                move_uploaded_file($_FILES['foto']['tmp_name'],'img/'.$nome_foto);
                echo "Imagem enviada com sucesso!";
            }else {
                echo "Só é possivel enviar imagens dos tipos jpg e png!";
            }
        }
    }
?>
</pre>