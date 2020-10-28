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
                "call add_ItemCarrinho($cart, $item);"
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

        public function getContent($name){
            try{
                $request = $this->con->execute('select id from Conteudo where nome = "'.$name.'";');
                //"select id from Conteudo where nome like ".$name.";"
                return $request->fetch_assoc()["id"];

            }catch(mysqli_sql_exception $e){
                throw "Erro: ".$e;
            }
        }

        public function saveData($file){

            $query = "insert into Item(nome,tipo,tamanho) values ('".
                $file["name"]."','".
                $file["type"]."',".
                $file["size"]
            .");";

            try{
                $request = $this->con->execute($query);

                $query = "update Item set conteudo = ".$file["content"]
                    .",valor = ".$file["value"]." where nome = '".$file["name"]."' limit 1;";
                $request = $this->con->execute($query);

                if(!empty($request)){
                    return $request;
                }
                return "Erro ao salvar o arquivo: ".$request;

            }catch(mysqli_sql_exception $e){
                throw "Erro: ".$e;
            }
        }
    }
?>