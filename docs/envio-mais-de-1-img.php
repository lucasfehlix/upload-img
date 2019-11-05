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
    <input type="file" name="foto[]" multiple>
    <input type="submit" >
</form>
<pre>
<?php
    if(isset($_POST['nome'])){
        echo $_POST['nome'].'<br>';
        echo $_POST['email'].'<br>';
        var_dump($_FILES['foto']);
        if(isset($_FILES['foto'])){

            for ($i=0; $i < count($_FILES['foto']['name']); $i++) { 
                if($_FILES['foto']['type'][$i] == "image/jpeg"){
                    $nome_foto = md5($_FILES['foto']['name'].rand(1,999)).'.jpg';
                    move_uploaded_file($_FILES['foto']['tmp_name'][$i],'img/'.$nome_foto);
                }elseif($_FILES['foto']['type'][$i] == "image/png"){
                    $nome_foto = md5($_FILES['foto']['name'].rand(1,999)).'.png';
                    move_uploaded_file($_FILES['foto']['tmp_name'][$i],'img/'.$nome_foto);
                }
            }
        }
    }
?>
</pre>