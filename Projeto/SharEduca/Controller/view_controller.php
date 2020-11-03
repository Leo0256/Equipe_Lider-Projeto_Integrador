<?php
    namespace Controller;

    use Controller\Controller;
    include_once __DIR__."\\view_controller.php";
    
    class View{
        private $con;

        public function __construct(){
            $this->con = new Controller();
        }

    }
?>