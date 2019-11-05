<?php
    class Produto{
        private $pdo;
        public function __construct($dbName,$dbHost,$dbUser,$dbSenha){
            try {
                $this->pdo = new PDO("mysql:dbname=".$dbName.";host=".$dbHost,$dbUser,$dbSenha);
            } catch (PDOException $e) {
                echo "Erro com BD: ".$e->getMessage();
                exit();
            } catch (Exception $e) {
                echo "Erro generico: ".$e->getMessage();
                exit();
            }
        }
        public function enviarProduto($nome,$descricao,$fotos = array()){
            //produto
            $cmd = $this->pdo->prepare("INSERT INTO produtos (nome_produto,descricao) VALUES (:n,:d)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":d", $descricao);
            $cmd->execute();         
            //id produto
            $idProd = $this->pdo->lastInsertId();
            if(count($fotos) > 0){
                //fotos
                for ($i=0; $i < count($fotos); $i++){
                    $nome_foto = $fotos[$i];
                    $cmd = $this->pdo->prepare("INSERT INTO imagens (nome_imagem,fk_id_produto) VALUES (:n,:fk)");
                    $cmd->bindValue(':n', $nome_foto);
                    $cmd->bindValue(':fk', $idProd);
                    $cmd->execute();
                }
            }
        }
        public function buscarProdutos(){
            $cmd = $this->pdo->prepare("SELECT *, (SELECT nome_imagem FROM imagens i WHERE i.fk_id_produto = p.id_produto LIMIT 1) as foto_capa FROM produtos p");
            $cmd->execute();
            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
            }else {
                $dados = array();
            }
            return $dados;
        }
        public function buscarProdutoPorId($id){
            $cmd = $this->pdo->prepare("SELECT * FROM produtos WHERE id_produto = :id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }else {
                $dados = array();
            }
            return $dados;
        }
        public function buscarImgPorId($id){
            $cmd = $this->pdo->prepare("SELECT nome_imagem FROM imagens WHERE fk_id_produto = :id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
            }else {
                $dados = array();
            }
            return $dados;
        }
    }
?>