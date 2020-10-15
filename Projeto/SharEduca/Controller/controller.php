<?php
    include_once "Model/model.php";
    include_once "view_controller.php";

    class Controle{
        public $model;
        public $view;

        public function __construct(){
            $this->model = new Model();
            $this->view = new View();
        }

        public function invoke(){
            $data = $this->model->getUser(1);
            $this->view->read("teste.php");
        }
    }
?>