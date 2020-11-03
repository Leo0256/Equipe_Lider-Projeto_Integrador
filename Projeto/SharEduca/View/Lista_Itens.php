<html>
<body>
    <form class="container" action="#" method="post" enctype="multipart/form-data">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <img class="figure figure-caption" src="imagens/carrinho.png" width="150px">
            </div>
            <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Username</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                </div>
            </div>
            <input type="hidden" value="show" name="item">
            <div class="col-auto">
                <button class="btn btn-outline-primary mb-2" type="submit" value="Sub" name="sub"><b>Sub</b></button>
            </div>
        </div>
        <br>
    </form>
    <hr>
</body>
</html>