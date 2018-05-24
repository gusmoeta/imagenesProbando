<?php

    
define("BARRA", DIRECTORY_SEPARATOR);

define("CARPETA_PROYECTO", realpath(__DIR__) . BARRA);
define("IMG", CARPETA_PROYECTO . "img" . BARRA);


echo BARRA;
echo "<br>";
echo CARPETA_PROYECTO;
echo "<br>";
echo IMG;




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
    
    <!-- <img style="border:1px solid; width:100px; height:100px" src="<?php echo IMG ?>download-2018-05-21_20-11-58.jpg" alt="1">
    <img style="border:1px solid; width:100px; height:100px" src="<?php echo IMG ?>download-2018-05-21_20-06-34.jpg" alt="2">
     -->
    <img style="border:1px solid; width:100px; height:100px" src="./img/download-2018-05-21_20-11-58.jpg" alt="">
    <img style="border:1px solid; width:100px; height:100px"src="./img/download-2018-05-21_20-06-34.jpg" alt="">

    <?php
      // echo IMG . "download-2018-05-21_20-11-58.jpg";
    ?>
</body>
</html>