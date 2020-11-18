<html>
<body>
    
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm fixed-top">
        <div class="my-0 mr-md-auto font-weight-normal">
            <img class="card-img-overlay" style="border-radius: 35px;" src="imagens/logo.jpeg" width="150px">
        </div>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="Menu">Página Inicial</a>
            <a class="p-2 text-dark" href="Empresa">Empresa</a>
            <a class="p-2 text-dark" href="Conteudos">Conteúdos</a>
            <a class="p-2 text-dark" href="Contato">Contato</a>
            <a class="p-2" href="Carrinho">
                <img class="figure figure-caption" src="imagens/carrinho.png" width="30px">
            </a>
        </nav>
        <a class="btn btn-outline-primary" href="Logon"><?php echo $this->acc_status;?></a>
    </div>

    <?php
        // teste
        if(isset($_GET["add"])){
            if($_GET["add"] == 1){   
                echo "alert('Item adicionado ao Carrinho!')";
            }else{
                echo "alert('Erro ao adicionar o item, tente novamente.')";
            }
        }
    ?>

    <div class="ml-5" style="margin-top: 8rem">
        <h1>
            <a href="Conteudos" class='btn btn-outline-primary rounded-circle'><b><-</b></a>
            <?php echo $_GET["i"];?> 
            <?php if($this->user['acesso']){echo "<a href='New_Item?i=".$_GET["i"]."' class='btn btn-outline-primary rounded-circle'><b>+</b></a>";}?>
        </h1>
        
        
        <hr class="mr-5">
        <br>
        <div class="form-row container align-items-center mx-auto">
            <?php $this->showItens(utf8_decode($_GET["i"])); ?>
        <div>
    </div>

</body>
</html>