<?php
    namespace Controller;

    use Model\Model;

    include_once dirname(__DIR__)."\Model\model.php";
    

    class Controller{
        private $model;
        private $user;

        var $folder = "data/";

        public function __construct($local,$user){
            $this->model = new Model();

            $this->user = $this->model->getUser($user);

            $paste = "";
            if($local != ""){
                $paste = dirname(__DIR__)."/View/".$local.".php";
            }
            
            if(file_exists($paste)){
                require $paste;
            }else{
                require "View/error/404.php";
            }

            if(isset($_GET["con"])){
                $var = explode(",",$_GET["con"]);
                $this->{$var[0]}($var[1]);
            }

        }

        // Mostra todos os conteúdos
        public function showContents(){
            $contents = $this->model->getAllContent();
            $id = 0;        $name = "";
            $descrip = "";  $img = "logo.jpg"; 

            foreach ($contents as $key => $value) {
                $id = $value["id"];
                $name = utf8_encode($value["nome"]);
                $descrip = utf8_encode($value["descrip"]);
                $img = utf8_encode($value["img"]);
                
                require dirname(__DIR__)."/View/Cards/Conteudos_card.php";
            }
        }

        // Mostra todos os itens de um conteúdo
        public function showItens($id){
            $content = $this->model->getContent($id);
            $itens = $this->model->getAllItens($content["id"]);
            $message = 0;

            $title = $content["nome"];
            $content = $content["id"];

            $name = "";     $id = 0;
            $descrip = "";  $type = "";
            $value = 0.0;   $zise = 0;

            foreach ($itens as $key => $var) {
                $id = $var["id"];
                $name = utf8_encode($var["nome"]);
                $type = utf8_encode($var["tipo"]);
                $zise = $var["tamanho"];
                $descrip = utf8_encode($var["descrip"]);
                $value = $var["valor"];

                require dirname(__DIR__)."/View/Cards/List_Item_card.php";
            }
        }

        // Adiciona o item informado
        var $response;

        public function add($item){
            //
            $cart = 1;
            //
            $this->response = $this->model->addItemCart($cart, $item);
        }

        public function openFile($id){
            $get_file = $this->model->getItem($id);
            
            $file = fopen($this->folder.$get_file["nome"], "r") 
                or die("Não foi possível abrir o arquivo!");
            $open = fread($file,filesize($get_file["nome"])) 
                or die("Não foi possível abrir o arquivo!");
            
            fclose($file);
        }





        public function addItem(){
            $file = [
                'file' => '',
                'size' => 0,
                'type' => '',
                'descrip' => '',
                'content' => 0,
                'value' => 0.0
            ];
            if(isset($_POST['upload'])){
                if (isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name']))
                #$file['name'] = rand(1000,100000)."-".$_FILES['file']['name'];
                $file['name'] = utf8_decode($_FILES['file']['name']);

                $file['file'] = $_FILES['file']['tmp_name'];
                $file['size'] = $_FILES['file']['size'];
                $file['type'] = $_FILES['file']['type'];

                if(isset($_POST['descrip']) && !empty($_POST['descrip'])){
                    $file['descrip'] = utf8_decode(utf8_encode(trim($_POST['descrip'])));
                }

                if(isset($_POST['content']) && !empty($_POST['content'])){
                    $file['content'] = $this->model->getContent(utf8_decode($_POST['content']))["id"];
                }
                
                if (isset($_POST['value']) && !empty($_POST['value'])){
                    $file['value'] = str_replace(",",".",$_POST['value']);
                }

                /*
                foreach ($file as $key => $value) {
                    echo "<h3>$key => $value</h3>";
                }
                */
                

                $response = $this->model->saveData($file);
                if($response){
                    move_uploaded_file($file['file'],$this->folder.$file['name']);
                }
            }
        }

        /*
        public function cart(){
            $response = "";
            if(isset($_POST['button'])){
                $cart = $_POST['cart'];
                $item = $_POST['item'];
                if($_POST['button'] == "Enviar"){
                    $response = $this->model->setCart($cart, $item);
                }else if($_POST['Limpar']){
                    $response = $this->model->cleanCart($cart);
                }else{
                    $response = $this->model->delCartItem($cart, $item);
                }
            }
        }
        */
    }
?>