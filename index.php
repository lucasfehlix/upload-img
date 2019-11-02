<style>
    input{
        display:block;
    }
</style>
<form method="POST" enctype="multpart/form-data">
    <label>NOME</label>
    <input type="text" name="nome">
    <label>EMAIL</label>
    <input type="text" name="email">
    <input type="file" name="foto">
    <input type="submit" >
</form>
<?php
    if(isset($_POST['nome'])){
        echo $_POST['nome'].'<br>';
        echo $_POST['email'].'<br>';
        if(isset($_FILES['foto'])){
            move_uploaded_file($_FILES['foto']['tmp_name'],'img/'.);
        }
    }


?>