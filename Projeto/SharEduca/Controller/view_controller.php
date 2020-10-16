<?php
    namespace Controller;
    
    class View{

        public function read($file){
            readfile("View/$file");
        }
     
        public function load($file){

        }
    }
?>