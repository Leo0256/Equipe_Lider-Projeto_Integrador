<?php
    class View{
        public function read($file){
            readfile("View/$file");
        }
    }
?>