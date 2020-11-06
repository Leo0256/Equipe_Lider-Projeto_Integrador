<div class="card mb-md-5 mr-md-auto" style="width: 18rem">
  <div class="card-body">
    <h4 class="card-title"><?php echo $name;?></h4>
    <p class="card-text"><?php echo $descrip;?></p>

    <a href="Item?i=<?php echo $id;?>" class="btn btn-outline-primary"><b>Ver Item</b></a>
    
    <a href="#?con=add,<?php echo $id;?>" class="btn btn-outline-primary">
      <b>R$ <?php echo $value;?></b>
      <img class="figure figure-caption rounded" src="imagens/carrinho.png" width="20px">
    </a>
    
    <!--<div class="input-group mt-2 mb-2">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <b>Quantidade</b>
        </div>
      </div>
        <input type="number" class="form-control" name="quant" value="0">
      </div>-->
  </div>
</div>