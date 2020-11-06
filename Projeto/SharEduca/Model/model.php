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
            return [$data[0], $data[1]->fetch_assoc()];
        }

        public function addItemCart($cart, $item){
            $request = $this->con->execute(
                "call add_ItemCarrinho($cart, $item);"
            );
            if($request[0] == True){
                return "Item adicionado ao Carrinho.";
            }else{
                return "Erro ao adicionar o Item.";
            }
        }

        public function clearCart($cart){
            $request = $this->con->execute(
                "call clear_ItemCarrinho($cart);"
            );
            if($request[0] == True){
                return "Carrinho esvaziado.";
            }else{
                return "Erro ao limpar o Carrinho.";
            }
        }

        public function rmItemCart($cart, $item){
            $request = $this->con->execute(
                "call remove_ItemCarrinho($cart, $item);"
            );
            if($request[0] == True){
                return "Item removido.";
            }else{
                return "Erro ao remover o Item do Carrinho.";
            }
        }

        public function getContent($var){
            $sql = "select * from Conteudo where ";

            $sql = (gettype($var) == "integer" ? 
                $sql."id = $var limit 1" : $sql.'nome = "'.$var.'" limit 1;'
            );

            return $this->rowRequest($sql, True);

            
            /*
            $request = $this->con->execute('select * from Conteudo where nome = "'.$name.'" limit 1;');
            //"select id from Conteudo where nome like ".$name.";"
            $array = [];
            
            if($request[0] == True){
                while ($row = mysqli_fetch_array($request[1])){
                    $array[] = $row;
                }
                return $array[0];

            }else{
                return $request;
            }*/
        }

        public function getAllContent(){
            $sql = "select * from Conteudo;";
            return $this->rowRequest($sql,False);
            /*
            $request = $this->con->execute('select * from Conteudo;');
            $array = [];
            
            if($request[0] == True){
                while ($row = mysqli_fetch_array($request[1])){
                    $array[] = $row;
                }
                return $array;

            }else{
                return $request;
            }*/
        }

        public function getItem($nome){
            $request = $this->con->execute('select * from Item where nome = "'.$nome.'" limit 1;');
            $array = [];
            
            if($request[0] == True){
                while ($row = mysqli_fetch_array($request[1])){
                    $array[] = $row;
                }
                return $array[0];

            }else{
                return $request;
            }
        }

        public function getAllItens($content){
            $sql = "select * from Item where conteudo like ".$content.";";
            return $this->rowRequest($sql, False);
            
            /*
            $request = $this->con->execute("select * from Item where conteudo like ".$content.";");
            $array = [];
            
            if($request[0] == True){
                while ($row = mysqli_fetch_array($request[1])){
                    $array[] = $row;
                }
                return $array[0];

            }else{
                return $request;
            }
            */
        }

        private function rowRequest($sql, $one_row){
            $request = $this->con->execute($sql);
            $array = [];
            
            if($request[0] == True){
                while ($row = mysqli_fetch_array($request[1])){
                    $array[] = $row;
                }

                if($one_row){
                    return $array[0];    
                }else{
                    return $array;
                }

            }else{
                return $request;
            }
        }











        public function saveData($file){

            $query = "insert into Item(nome,tipo,tamanho) values ('".
                utf8_decode($file["name"])."','".
                $file["type"]."',".
                $file["size"]
            .");";

            try{
                $request = $this->con->execute($query);

                $query = "update Item set "
                    ."conteudo = ".$file["content"]
                    .',descrip = "'.utf8_decode($file["descrip"]).'"'
                    .",valor = ".$file["value"]
                    ." where nome = '".$file["name"]."' limit 1;";
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