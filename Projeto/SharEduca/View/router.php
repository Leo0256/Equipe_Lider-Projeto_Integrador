<?php
    use Carrinho\View;
    $view = new View();

    if(isset($_REQUEST['from']) || isset($_REQUEST['to'])){
        $view->read(($_GET['to'])."php");
    }else{
        $view->read(($_GET['from'])."php");
    }
?>