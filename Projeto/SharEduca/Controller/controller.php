<?php
    namespace Controller;

    use Model\Model, Controller\View;

    include_once "Model/model.php";
    include_once "view_controller.php";

    class Controller{
        public $model;
        public $view;

        public function __construct(){
            $this->model = new Model();
            $this->view = new View();
        }

        public function invoke(){
            $data = $this->model->getUser(1);
            include "View/Menu.php";
            
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

            if(isset($_POST['upload'])){
                $file['name'] = rand(1000,100000)."-".$_FILES['file']['name'];
                $file['file'] = $_FILES['file']['tmp_name'];
                $file['size'] = $_FILES['file']['size'];
                $file['type'] = $_FILES['file']['type'];

                $file['content'] = $_POST['content'];
                $file['value'] = $_POST['value'];
                $folder = "View/";

                move_uploaded_file($file['file'],$folder.$file['name']);
                $this->model->saveData($file);
            }
            include "View/teste.php";
        }
    }
?>