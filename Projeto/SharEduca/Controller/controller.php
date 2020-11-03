<?php
    namespace Controller;

    use Model\Model;

    include_once dirname(__DIR__)."\Model\model.php";
    

    class Controller{
        private $model;

        var $folder = "data/";

        public function __construct($local){
            $this->model = new Model();
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
            }/*else{
                echo "<br><br><br><br><br><br>n foi";
            }*/

        }

        // "c" de "conteúdo"
        public function c($title){
            $item = [];
            echo $title;
            if(isset($_POST["item"])){
                
            }

            for($x = 0; $x < 3; $x++){
                require dirname(__DIR__)."/View/Lista_Itens.php";
            }
        }

        public function addItem(){
            $file = [];
            if(isset($_POST['upload'])){
                if (isset($_FILES['file']['tmp_name']) || !empty($_FILES['file']['tmp_name']))
                $file['name'] = rand(1000,100000)."-".$_FILES['file']['name'];
                #$file['name'] = $_FILES['file']['name'];

                $file['file'] = $_FILES['file']['tmp_name'];
                $file['size'] = $_FILES['file']['size'];
                $file['type'] = $_FILES['file']['type'];

                $file['content'] = "0";
                $file['value'] = "0.0";

                if(isset($_POST['content']) && !empty($_POST['content'])){
                    $file['content'] = $this->model->getContent(utf8_decode($_POST['content']));
                }
                
                if (isset($_POST['value']) && !empty($_POST['value'])){
                    $file['value'] = $_POST['value'];
                }

                /*
                echo "name: ".$file['name']."<br>
                size: ".$file['size']."<br>
                type: ".$file['type']."<br>
                content: ".$file['content']."<br>
                value: ".$file['value']."<br>";
                */

                $response = $this->model->saveData($file);
                if($response){
                    move_uploaded_file($file['file'],$this->folder.$file['name']);
                }
            }
            require dirname(__DIR__)."/View/teste.php";
            #require "$page_origin";
        }

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
    }
?>