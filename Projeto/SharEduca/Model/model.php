<?php
    namespace Model;

    use Model\Connection;

    include_once "connection.php";

    class Model{
        var $con;

        public function __construct(){
            $this->con = new Connection();
        }
        
        public function getUser($id){
            $data = $this->con->execute(
                "select * from Usuario where id = $id"
            );
            return $data->fetch_assoc();
        }

        public function setCart($cart, $item){
            $request = $this->con->execute(
                "call Colocar_Item($cart, $item);"
            );
            if($request == 1){
                return "Item adicionado ao Carrinho.";
            }else{
                return "Erro ao adicionar o Item.";
            }
        }

        public function cleanCart($cart){
            $request = $this->con->execute(
                "call Limpar_Carrinho($cart);"
            );
            if($request == 1){
                return "Carrinho esvaziado.";
            }else{
                return "Erro ao limpar o Carrinho.";
            }
        }

        public function delCartItem($cart, $item){
            $request = $this->con->execute(
                "call Remover_Item($cart, $item);"
            );
            if($request == 1){
                return "Item removido.";
            }else{
                return "Erro ao remover o Item do Carrinho.";
            }
        }

        public function saveData($file){
            $request = $this->con->execute(
                "insert into Item(nome,tipo,tamanho,conteudo,valor) values ("
                .$file['name'].","
                .$file['type'].","
                .$file['size'].","
                .$file['content'].","
                .$file['value'].");"
            );
            if($request == 1){
                return "Item armazenado.";
            }else{
                return "Erro ao armazenar o Item.";
            }
        }
    }
?>