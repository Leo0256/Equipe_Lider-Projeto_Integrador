<?php
    include_once("Modelo/modelo.php");
    include('../Visão/Menu.php');
    class Controle{
        public $modelo;

        public function __construct(){
            $this->modelo = new Modelo();
        }

        public function iniciar(){
            $ex = $this->modelo->get();
            
        }
    }
?>