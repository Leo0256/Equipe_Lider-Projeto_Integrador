<?php
    namespace Controller;

    use Controller\Controller, Model\Model;

    include_once dirname(__DIR__)."\Model\model.php";
    include_once dirname(__DIR__)."\Controller\controller.php";
    
    class Login{
        private $con;
        private $model;

        private $local;
        private $user;

        public function __construct($local){
            $this->model = new Model();
            $this->local = $local;

            $this->makeLogin();
        }

        private function makeLogin(){
            // teste
            $this->user = $this->model->getUser(10);
            //
            $this->con = new Controller($this->local,$this->user[1]);
        }
    }
?>