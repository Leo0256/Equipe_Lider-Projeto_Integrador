<?php
    include_once "connection.php";

    class Model{
        var $con;
        private $query;

        public function __construct(){
            $this->con = new Connection();
        }
        
        public function getUser($id){
            $this->query = "select * from Usuario where id = $id";
            $data = $this->con->executeQuery($this->query);
            return $data;
        }
    }
?>