<?php
    class Produto{
        private $pdo;
        public function __construct($dbName,$dbHost,$dbUser,$dbSenha){
            try {
                $this->pdo = new PDO("mysql: dbname=".$dbName.";host=".$dbHost,$dbUser,$dbSenha);
            } catch (PDOException $e) {
                echo "Erro com BD: ".$e->getMessage();
            } catch (Exception $e) {
                echo "Erro generico: ".$e->getMessage();
            }
        }
        public function enviarProduto($nome,$descricao,$fotos = array()){
            //produto
            $sql = $this->pdo->prepare("INSERT INTO produtos (nome_produto, descricao) VALUES (:n, :d)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":d", $descricao);
            $sql->execute();         
            //id produto
            $idProd = $this->pdo->lastInsertId();
            if(count($fotos) > 0){   
                //fotos
                for ($i=0; $i < count($fotos); $i++) { 
                    $nome_foto = $fotos[$i];
                    $sql = $this->pdo->prepare("INSERT INTO imagens (nome_imagem,fk_id_produto) VALUES (:n,:fk)");
                    $sql->bindValue(':n', $nome_foto);
                    $sql->bindValue(':fk', $idProd);
                    $sql->execute();
                }
            }
        }
        public function buscarProdutoPorId($id){

        }
        public function buscarImgPorId($id){

        }
        public function c(){

        }
        public function d(){

        }
    }
?>