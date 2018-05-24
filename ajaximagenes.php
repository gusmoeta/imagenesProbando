
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
    

public function urlImg()
     {	
		 try{
			 $consulta = "select id, nombreImgBD from imagenes";
             $result = $this->conexion->query($consulta);
             //var_dump($result);
			 $alimentos = array();
             while ($row = $result->fetch(PDO::FETCH_ASSOC) )             
			 {
                // echo "guardando imagen";
				 $imagenes[] = $row;
			 }

		 }catch (PDOException $e){
			 die("Fallo al conectar con damealimentos " . $e->getMessage() ); //necesario?
		 }
         //var_dump($imagenes);
         return $imagenes;
     }

public function subirImagenurl($nombrImg, $id){
echo "MODEL SUBIRIMAGENURL NOMBRE NUEVO IMAGEN $nombrImg <br>";
   // $subido = false;
  //=3
 
    try{
        $consulta = "update imagenes set nombreImgBD = '$nombrImg' where id = $id";
        echo $consulta;
        $result = $this->conexion->query($consulta);

        // echo "<br>";
        // var_dump($result);

    }catch (PDOException $e){
        die("Fallo al conectar con damealimentos " . $e->getMessage() );
    }   
    return $id;
}

public function buscarNombreConIdImg($idImg){

    try{
        $consulta = "select nombreImgBD from imagenes where id = '$idImg'";
        //echo "model buscarnombrecon idimg consulta: $consulta <br>";
        $result = $this->conexion->query($consulta);      

        // echo " resul buscanombr con id model <br>";
        // var_dump($result);
        
        
        $row = $result->fetch(PDO::FETCH_ASSOC);             			               
		$nombreFoto = $row['nombreImgBD'];
			 

    }catch (PDOException $e){
        die("Fallo al conectar con damealimentos " . $e->getMessage() ); 
    }   
    //EN CASO DE ERROR DEVOVEL ALGO PARA RECONOCERLO
    return $nombreFoto;
}

 }//fin model


 class Controller {
 public function listar()
 {
     $m = Model::singleton();
     
     $params = $m->urlImg();

        return $params;
    }
    
public function subiraBBDD($nombreImagen, $idimagen)
{
    echo "controler subiraBBDD <br>";
    $m = Model::singleton();

    $id = $m->subirImagenurl($nombreImagen, $idimagen);
    echo "$id en el controloador subiraBBDD <br>";
    return $id;        

 }

 public function buscarNombreConId($id)
 {

    $m = Model::singleton();

    $nombreFoto = $m->buscarNombreConIdImg($id);

    return $nombreFoto;
 }

 public function subiraCarpeta()
 {
    if(is_uploaded_file($_FILES["imagen"]["tmp_name"])){ //si se ha subido a la temporar
        echo "METOTDO SUBIR INICIO <br>";    
		//echo $_FILES["imagen"]["tmp_name"];
		$nombredirectorioFin = "img/";					//la ruta final
		if(!is_dir($nombredirectorioFin)){
            mkdir("img");
		}
		
		
		
		$nombrefichero = $_FILES["imagen"]["name"];		//el nombre el fichero
		
        //$nombreCompleto = $nombredirectorioFin . $nombrefichero;
        //echo $nombreCompleto;
        
        ///
        $posPuntoSeparador=strpos($nombrefichero, ".");
        
        $nombre=substr( $nombrefichero, 0, ($posPuntoSeparador) ) . "-";
        $fecha=date("Y-m-d_H-i-s",time()) . ".";
        $tipoFichero=substr($nombrefichero, ($posPuntoSeparador+1));
        
        //en casa la hora es una menos¿?¿?				   
        $nombrefichero = $nombre . $fecha . $tipoFichero;
       // echo "$nombrefichero <br>";
		
        //DESCOMENTAR SI LA IDEA ES AÑADIR MAS IMAGENES DESDE AKI, COMO ES ACTUALIZAR NO HACE FALTAL EL IF
        //PERO MELLEVO PARTE DEL CODE ARRIBA
		// if(is_file($nombreCompleto)){ //si existe el fichero(con ruta) le doy una fecha
		// 	/*$idunico = time();
		// 	$nombrefichero = $idunico . "-" . $nombrefichero;*/
        // 	//ej.  raton.jpg
        
		// 	$posPuntoSeparador=strpos($nombrefichero, ".");
			
		// 	$nombre=substr( $nombrefichero, 0, ($posPuntoSeparador) ) . "-";
		// 	$fecha=date("Y-m-d H-i-s",time()) . ".";
		// 	$tipoFichero=substr($nombrefichero, ($posPuntoSeparador+1));
			
		// 	//en casa la hora es una menos¿?¿?				   
		// 	$nombrefichero = $nombre . $fecha . $tipoFichero;
		// }
		
		if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $nombredirectorioFin . $nombrefichero)){
            
            echo "Archivo subido exitosament";
        }else{
            echo "al intentar guardar no sepudo";
        }
	}else{
		echo "No se ha podido subir el fichero <br>";
    }
    

   
    //faltaria closedir¿?¿?
    return $nombrefichero;
     
 }

 public function borrarFotoCarpeta()
 {  
    echo "BORRAR FOTO <br>";
    $idPaBorrarFoto = $_REQUEST['id']; //id imagen a subir, coincidente con la id imagen ya en BBDD
   // echo "idPaBorrarFoto <br>";

    //CON ID ACTUAL ANTES DLE LACAMBIAZO EN BBDD BUSCO EL NOMBRE DE LA FOTO ANTES DE SER CAMBIADA
    $nombreImagenAntesdeSerCambiada = self::buscarNombreConId($idPaBorrarFoto);
    echo "contrller borrarfotocarpeta $nombreImagenAntesdeSerCambiada NOMBRTEIMAGENANTES DE ser cambiada<br>";

    $carpetaimg  = "./img";
    // if()
        if(is_dir($carpetaimg)){

            $recurso = @opendir($carpetaimg) or die('No se pudo abrir el recurso');
            $encontradaImg = false;
            $entrada = readdir($recurso);
            //echo "$entrada <br>";
            while ($entrada !== false || $encontradaImg !== true){
            
                if($nombreImagenAntesdeSerCambiada == $entrada){
                    //echo "$nombreImagenAntesdeSerCambiada <-> $entrada <br>";
                    $encontradaImg = true;

                    //una vez encontrada la borro
                    $b = unlink("./img/$entrada");
                    //echo "Borrado de fichero $b <br>";
                }
                if($entrada !== false || $encontradaImg !== true){
                    $entrada = readdir($recurso);
                }
                //echo "$entrada <br>";
            }
            closedir($recurso);
        }

    return $encontradaImg;
 }


 }//fin controller





//  function subiraCarpeta(){}
// function borrarFotoCarpeta($control){}


if(!isset($control)) $control = new Controller();

if( empty($_REQUEST['nomimg']) ){
 
    echo "IF LISTAR <br>";
    $urlI = $control->listar();
    
  
    include_once 'noindex.php';   
    
}else if( !$_FILES['imagen']['error'] ){
    //SUBIR IMAGEN y BORRARLAR DE LA CARPETA
     echo "ELSE IF <br>";
    // echo "vardamp <br>",
    // var_dump($_FILES['imagen']['error']);
    // echo " imagen intento de subirla <br>";
    // echo !empty($_FILES['imagen']); 

    //SUBE Y DEVUELVE NOMBE PARA PODER GUARDAR BIEN LA FOTO EN LA CARPTETA ABAJO
    //$nombreFichero = subiraCarpeta(); 
    $nombreFichero = $control->subiraCarpeta(); 
    //echo "Nombre fichero $nombreFichero <br>";
    //BORRO FOTO PREVIA DE LA CARPETA IMG
    //$borradaBool = borrarFotoCarpeta($control);
    $borradaBool = $control->borrarFotoCarpeta();
    //echo "Borrado " . $borradaBool . " Borrado <br>";
    
  
    // echo "nombre imagen <br>";
    // echo $_FILES["imagen"]["name"];
    // echo "ID IMAGEN A CAMBIAR <br>";
    // echo $_FILES["imagen"]["id"];
    // echo "REQUEST ANTES DE SUBIR <br>";
    // var_dump($_REQUEST);
     $id = $_REQUEST['id'];
    // echo $id . "ID ANTES DE SUBIR LA IMAGEN <BR>";

    //MANDA el ID de la imgaen en web para asociar en ese id una nueva imagen, 
    //por eso id e id son lo mismo abajo
    // PARA METER Y DDVUELVE DEL METIDO, EN ESTE CASO EL MISMO
    $id = $control->subiraBBDD($nombreFichero, $id);
    //echo "subido o no " . $id . "<br>";
       
    $urlI = $control->listar();
    
    include_once 'noindex.php';   
    
}else{
    //SI SE DA A SUBIR Y NO HAY IMAGEN SE MANTIENE IGUAL
    echo "ELSE <br>";
    
    echo "No se ha podido cambiar imagenor q no se seleccionao imagen <br>";
    $urlI = $control->listar();
    include_once 'noindex.php';   
}







?>