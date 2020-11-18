<? header("Location: http://127.0.0.1/"); ?>
<head>
    <title>SharEduca</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/bootstrap_css.css">
    <script src="bootstrap/bootstrap_js.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
</head>
<?php
    include_once "/Controller/controller.php";
    use Controller\Controller;

    session_start();

    // URL limpa
    $URI = filter_input(INPUT_SERVER, "REQUEST_URI");
    $get_init = strpos($URI, "?");
    $get_request = (isset($_GET["con"]) ? $_GET["con"] : "");

    if($get_init){
        $URI = substr($URI, 0, $get_init);
    }
    $URI = substr($URI, 1);
    $URL = explode("/",$URI);


    if($URL[count($URL)-1] == ""){
        $URL[count($URL)-1] = "Menu";
    }

    $paste = __DIR__."\Controller\controller.php";
    if($get_request != ""){
        $paste = $paste."?con=".$get_request;
    }
    
    $con = new Controller($URL[count($URL)-1]);
?>