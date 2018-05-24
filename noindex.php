
<?php
    include_once 'ajaximagenes.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>  
    <?php for( $i=0; $i < count($urlI); $i++ ){ ?>
    
    <div style="border:1px solid; margin:10px;">
        
        <!-- $urlI[$i]['nombreImgBD'] es el nombre de la imagen en la posicion corresponidente -->
        <img style="border: 1px solid; width:300px" src="./img/<?php echo $urlI[$i]['nombreImgBD'] ?>" alt="">
        

        <form action="ajaximagenes.php" method="post" enctype="multipart/form-data">

            Selecciona una nueva imagen si lo deseas: <input type="file" name="imagen">
            <!-- 
                guardo al imporimir la imagen en input hidden el id y el nombre de la image
                para q al realizar cambio en esa imagen saber donde en ls BBDD
            -->
            <input type="hidden" name="id" value ="<?php echo $urlI[$i]['id'] ?>" >
            <input type="hidden" name="nomimg" value ="<?php echo $urlI[$i]['nombreImgBD'] ?>" >

            <input type="submit" name="subir" value="Cambiar imagen">
        </form>
        </div>
        <?php } ?>
</body>
</html>