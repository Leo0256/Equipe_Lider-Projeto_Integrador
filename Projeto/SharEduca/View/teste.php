<html>
<head></head>
<body>
    <form action="" method="post">
    carrinho: <input type="text" name="cart"><br>
    item: <input type="text" name="item"><br>

    <input type="submit" value="Enviar" name="button">
    <input type="submit" value="Limpar" name="button">
    <input type="submit" value="Deletar" name="button">
    </form>

    <form action="" method="post" enctype="multipart/form-data">
        file: <input type="file" name="file"><br>
        conteúdo: <input type="text" name="content"><br>
        valor: <input type="text" name="value"><br>

        <input type="submit" value="Upload" name="upload">
    </form>

    <!--
        <a href="uploads/< ?php echo $row['file'] ?>" target="_blank">view file</a>
    -->
    <?php echo $response; ?>
</body>
</html>