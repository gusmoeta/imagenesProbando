
<?php

class Config
{
   public static $dns="mysql:host=localhost; dbname=ajaximagenes"; /*  id3307463_alimentacion */
   public static $user="root"; /* id3307463_gusmoeta */
   public static $clave=""; /*gusmoeta*/
   public static $mvc_vis_css = "estilo.css";
    /*
    static public $mvc_bd_hostname = "localhost";
    static public $mvc_bd_nombre   = "id3307463_alimentacion";
    static public $mvc_bd_usuario  = "id3307463_gusmoeta";
    static public $mvc_bd_clave    = "gusmoeta";
   
    */
}

class Model
 {
     private $conexion; private static $instancia;

     private function __construct()
     {
		try{
			
			$this->conexion = new PDO(Config::$dns, Config::$user, Config::$clave);
			$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//$this->setAttribute( PDO::ATTR_EMULATE_PREPARES, true );    //para q fuerce el prepare con pdo
			$this->conexion->exec("SET CHARACTER SET utf8");						
		}catch(PDOException $e){
			die("Fallo al conectar " . $e->getMessage() );
		}
		 	 
     }

	 
	 public static function singleton(){
		if(!isset(self::$instancia)){
			$claseenlaqueestoy= __CLASS__;
			self::$instancia = new $claseenlaqueestoy;
		}
	return self::$instancia;
	}
	 
	public function __clon(){
		trigger_error("No se puede clonar esta clase", E_USER_ERROR);
    }
    

// public function urlImg()
//      {	
// 		 try{
// 			 $consulta = "select id, img from imagenes";
//              $result = $this->conexion->query($consulta);
//              //var_dump($result);
// 			 $alimentos = array();
//              while ($row = $result->fetch(PDO::FETCH_ASSOC) )             
// 			 {
//                 // echo "guardando imagen";
// 				 $imagenes[] = $row;
// 			 }

// 		 }catch (PDOException $e){
// 			 die("Fallo al conectar con damealimentos " . $e->getMessage() ); //necesario?
// 		 }
//          //var_dump($imagenes);
//          return $imagenes;
//      }

// public function subirImagenurl($nombrImg, $id){
// echo "NOMBRE NUEVO IMAGEN $nombrImg <br>";
//    // $subido = false;
//   //=3
 
//     try{
//         $consulta = "update imagenes set img = '$nombrImg' where id = $id";
//         echo $consulta;
//         $result = $this->conexion->query($consulta);
//         // if($result){
//         //     $subido = true;
//         // }
        
//         echo "<br>";
//         var_dump($result);
//         //var_dump($result);
//         // $alimentos = array();
//         // while ($row = $result->fetch(PDO::FETCH_ASSOC) )             
//         // {
//         //    // echo "guardando imagen";
//         //     $imagenes[] = $row;
//         // }

//     }catch (PDOException $e){
//         die("Fallo al conectar con damealimentos " . $e->getMessage() ); //necesario?
//     }   
//     return $id;
// }

// public function buscarNombreConIdImg($idImg){

//     try{
//         $consulta = "select img from imagenes where id = '$idImg'";
//         echo $consulta;
//         $result = $this->conexion->query($consulta);      

//         echo " resul buscanombr con id model <br>";
//         var_dump($result);

        
//         $row = $result->fetch(PDO::FETCH_ASSOC);             			               
// 		$nombreFoto = $row['img'];
			 

//     }catch (PDOException $e){
//         die("Fallo al conectar con damealimentos " . $e->getMessage() ); //necesario?
//     }   
//     return $nombreFoto;
// }


public function subirTodasImgdeCarpetaModel($arraiNomImg){

    for ($i=0; $i < count($arraiNomImg) ; $i++) { 

        try{
            //transforma nombre imagen a formato con fecha en el nombre para la bbdd
            $nombrefichero = $arraiNomImg[$i];
            $posPuntoSeparador=strpos($nombrefichero, ".");
        
            $nombre=substr( $nombrefichero, 0, ($posPuntoSeparador) ) . "-";
            $fecha=date("Y-m-d_H-i-s",time()) . ".";
            $tipoFichero=substr($nombrefichero, ($posPuntoSeparador+1));
            
            //en casa la hora es una menos¿?¿?				   
            $nombrefichero = $nombre . $fecha . $tipoFichero;
            //////fin transmfoormacion

            //tb para la carpeta
            rename("./img2/".$arraiNomImg[$i], "./img2/$nombrefichero");



                //imagenesprubaimg
            $consulta = "insert into ajaximagenes.imagenes values(" . ($i+1) . ",'" . $nombrefichero . "')";
            //insert into ajaximagenes.prubaimg values( 1,'0015072_banderin-vaiana.jpg')
            echo "$consulta <br>";
            $result = $this->conexion->query($consulta);      

        }catch (PDOException $e){
            die("Fallo al conectar con damealimentos " . $e->getMessage() ); 
        }
    }
    echo "fin model <br>";
    //return $nombreFoto;
}

 }//fin model


 class Controller {
    // public function listar(){
    //     $m = Model::singleton();
        
    //     $params = $m->urlImg();

    //         return $params;
    // }
    
    // public function subiraBBDD($nombreImagen, $idimagen){
            
    //     $m = Model::singleton();

    //     $id = $m->subirImagenurl($nombreImagen, $idimagen);
    //     return $id;        

    // }

    // public function buscarNombreConId($id){

    //     $m = Model::singleton();

    //     $nombreFoto = $m->buscarNombreConIdImg($id);

    //     return $nombreFoto;
    // }

    public function buscarficherosenCarpeta(){

        echo "buscarficherosenCarpeta <br>";       

        $carpetaimg  = "./img2";
        if(is_dir($carpetaimg)){

            $recurso = @opendir($carpetaimg) or die('No se pudo abrir el recurso <br>');
            
            $entrada = readdir($recurso);
            while ($entrada !== false){
              
                // if($entrada == ".") echo "igual a pnto <br>";
                // if($entrada == "..") echo "igual a pnto <br>";

                if($entrada != "." || $entrada != ".."){
                    //echo "$entrada <br>";
                    $arraiNombresImagenes[] = $entrada;
                }
                $entrada = readdir($recurso);

            }
                        
        }
        
        closedir($recurso);    

        return $arraiNombresImagenes;
    }

     public function subirTodasImgdeCarpeta($arraiNombresFotos){

        $m = Model::singleton();

        $nombreFoto = $m->subirTodasImgdeCarpetaModel($arraiNombresFotos);

       // return $nombreFoto;
    }


 }//fin controller




 ///    FUNCION SUBIR IMAGEN

//  function subiraCarpeta(){
// 	if(is_uploaded_file($_FILES["imagen"]["tmp_name"])){ //si se ha subido a la temporar
// 		echo "METOTDO SUBIR INICIO <br>";
// 		//echo $_FILES["imagen"]["tmp_name"];
// 		$nombredirectorioFin = "img/";					//la ruta final
// 		if(!is_dir($nombredirectorioFin)){
//             mkdir("img");
// 		}
		
		
		
// 		$nombrefichero = $_FILES["imagen"]["name"];		//el nombre el fichero
		
//         //$nombreCompleto = $nombredirectorioFin . $nombrefichero;
//         //echo $nombreCompleto;
        
//         ///
//         $posPuntoSeparador=strpos($nombrefichero, ".");
        
//         $nombre=substr( $nombrefichero, 0, ($posPuntoSeparador) ) . "-";
//         $fecha=date("Y-m-d H-i-s",time()) . ".";
//         $tipoFichero=substr($nombrefichero, ($posPuntoSeparador+1));
        
		   
//         $nombrefichero = $nombre . $fecha . $tipoFichero;
//         echo "$nombrefichero <br>";
				
// 		if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $nombredirectorioFin . $nombrefichero)){
            
//             echo "Archivo subido exitosament";
//         }else{
//             echo "al intentar guardar no sepudo";
//         }
// 	}else{
// 		echo "No se ha podido subir el fichero <br>";
//     }
    
//     return $nombrefichero;
	
// }


// function borrarFotoCarpeta($control)
//     {
//         echo "BORRAR FOTO <br>";
//         $idPaBorrarFoto = $_REQUEST['id']; //id imagen a subir, coincidente con la id imagen ya en BBDD
//         echo "idPaBorrarFoto <br>";

//         //CON id actual antes dle lacambiazo en bbdd busco el nombre de la foto antes de ser cambiada
//         $nombreImagenAntesdeSerCambiada = $control->buscarNombreConId($idPaBorrarFoto);

//         $carpetaimg  = "./img";
//         if(is_dir($carpetaimg)){

//             $recurso = @opendir($carpetaimg) or die('No se pudo abrir el recurso');
//             $encontradaImg = false;
//             $entrada = readdir($recurso);
//             while ($entrada !== false || $encontradaImg !== true){
              
//                 if($nombreImagenAntesdeSerCambiada == $entrada){
//                     echo "$nombreImagenAntesdeSerCambiada <-> $entrada <br>";
//                     $encontradaImg = true;

//                     //una vez encontrada la borro
//                     $b = unlink("./img/$entrada");
//                     echo "Borrado de fichero $b <br>";
//                 }
//                 if($entrada !== false || $encontradaImg !== true)
//                 $entrada = readdir($recurso);
//             }
//             closedir($recurso);

//         }

//         return $encontradaImg;
//     }


    




    $control = new Controller();
    
    //buscar archivos en carpeta x, retornar array de nombres
    $arraiNombreImg = $control->buscarficherosenCarpeta();

    echo "<br>";    
    echo "<br>";
    echo "<br>";
    echo "<br>";    
    echo "<br>";
    echo "<br>";
    echo "<br>";    
    echo "<br>";
    echo "<br>";
    
    array_shift($arraiNombreImg);
    array_shift($arraiNombreImg);
    var_dump($arraiNombreImg);    
    
    echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa <br>";
    echo $arraiNombreImg[0];
    if(is_string($arraiNombreImg[0])) echo " string ";
    else echo " no strin ";
    echo " aaaaaaaaaaaaaaaaaaaaaaaaaa<br>";
    
    //meter archivos en BBDD

    $control->subirTodasImgdeCarpeta($arraiNombreImg);    
    //listar en web datos BBDD



?>