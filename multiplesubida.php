
<?php

    include_once 'multiplesubidaphp.php';
    



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

    <!-- <div style="width:100; height:100; background-color:blue;"></div> -->
    
    <!-- <?php //for( $i=0; $i < count($urlI); $i++ ){ ?>
    
    <div style="border:1px solid; margin:10px;">
        <?php //echo 'INICIO imagen' ?> 
        <?php //echo 'FIN imagen' ?> 
        <img style="border: 1px solid; width:300px" src="./img/<?php //echo $urlI[$i]['img'] ?>" alt="">
    
        <?php 
            // echo "I $i <br>";
            // var_dump($urlI) . "<br>"; 
            // var_dump($urlI) . "<br>";
            // echo "NOMBRE IMG  <br>";
            // echo $urlI[$i]['img'] . "<br>";
        ?>

        <form action="ajaximagenes.php" method="post" enctype="multipart/form-data">

            Selecciona una nueva imagen si lo deseas: <input type="file" name="imagen">
            <input type="hidden" name="id" value ="<?php //echo $urlI[$i]['id'] ?>" >
            <input type="hidden" name="img" value ="<?php //echo $urlI[$i]['img'] ?>" >

            <input type="submit" name="subir" value="Cambiar imagen">
        </form>
        </div>
        <?php //} ?>
   -->




    
</body>
</html>