<? header("Location: http://127.0.0.1/"); ?>
<head>
    <title>SharEduca</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>

    <style>
        
    </style>

</head>
<?php
    include_once "/Controller/controller.php";
    use Controller\Controller;

    $URI = filter_input(INPUT_SERVER, "REQUEST_URI");
    $get_init = strpos($URI, "?");

    if($get_init){
        $get_request = (isset($_GET["var"]) ? $_GET["var"] : "");
        $URI = substr($URI, 0, $get_init);
    }
    $URI = substr($URI, 1);
    $URL = explode("/",$URI);

    $paste = __DIR__."/View/";
    if($URL[count($URL)-1] != ""){
        $paste = $paste.$URL[count($URL)-1].".php";
    }else{
        $paste = $paste."Menu.php";
    }

    if(file_exists($paste)){
        require $paste;
    }else{
        require "View/error/404.php";
    }
    
    $con = new Controller();
?>