
<?php

class Config
{
   public static $dns="mysql:host=localhost; dbname=ajaximagenes"; 
   public static $user="root"; 
   public static $clave=""; 
   public static $mvc_vis_css = "estilo.css";
   /*static public $mvc_bd_hostname = "localhost";*/
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


//COMIENZO DE FUNCIONALIDADES    

public function urlImg()
     {	
		 try{
			 $consulta = "select id, nombreImgBD from imagenes";
             $result = $this->conexion->query($consulta);
            
			 $alimentos = array();
             while ($row = $result->fetch(PDO::FETCH_ASSOC) )             
			 {
               
				 $imagenes[] = $row;
			 }

		 }catch (PDOException $e){
			 die("Fallo al conectar con damealimentos " . $e->getMessage() ); //necesario?
		 }
        
         return $imagenes;
     }

public function subirImagenurl($nombrImg, $id){
echo "MODEL SUBIRIMAGENURL NOMBRE NUEVO IMAGEN $nombrImg <br>";
 
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
    //  echo __LINE__ . "<br>";
    //  echo __FILE__ . "<br>";
    //  echo __METHOD__    . "<br>";     
    //  echo "------------ <br>";
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
     //SI SE HA SUBIDO A LA TEMPORAR
    if(is_uploaded_file($_FILES["imagen"]["tmp_name"])){ 
        echo "METOTDO SUBIR INICIO <br>";    
        
        //LA RUTA FINAL
		$nombredirectorioFin = "img/";				
		if(!is_dir($nombredirectorioFin)){
            mkdir("img");
		}
		//el nombre el fichero
		$nombrefichero = $_FILES["imagen"]["name"];		
		      
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
    //ID IMAGEN A SUBIR, COINCIDENTE CON LA ID IMAGEN YA EN BBDD
    $idPaBorrarFoto = $_REQUEST['id'];
  

    //CON ID ACTUAL ANTES DLE LACAMBIAZO EN BBDD BUSCO EL NOMBRE DE LA FOTO ANTES DE SER CAMBIADA
    $nombreImagenAntesdeSerCambiada = self::buscarNombreConId($idPaBorrarFoto);
    echo "contrller borrarfotocarpeta $nombreImagenAntesdeSerCambiada NOMBRTEIMAGENANTES DE ser cambiada<br>";

    $carpetaimg  = "./img";
    // CUIDADO CONTROLAR PARA Q EN CASO DE FALLO AL SUBIR LA FOTO A LA BBDD NO SE GUARDE LA IMG EN LA CARPETA
        if(is_dir($carpetaimg)){

            $recurso = @opendir($carpetaimg) or die('No se pudo abrir el recurso');
            $encontradaImg = false;
            $entrada = readdir($recurso);
           
            while ($entrada !== false || $encontradaImg !== true){
            
                if($nombreImagenAntesdeSerCambiada == $entrada){
           
                    $encontradaImg = true;

                    //una vez encontrada la borro
                    $b = unlink("./img/$entrada");
                   
                }
                if($entrada !== false || $encontradaImg !== true){
                    $entrada = readdir($recurso);
                }
                
            }
            closedir($recurso);
        }

    return $encontradaImg;
 }


 }//fin controller



//LOGICA CONTROLADORA, AKI COMIENZA TODO
if(!isset($control)) $control = new Controller();

if( empty($_REQUEST['nomimg']) ){
 
    echo "IF LISTAR <br>";
    echo (__LINE__-1) . "<br>";
    echo __FUNCTION__    . "<br>"; 
    echo __FILE__ . "<br>";
    echo "--------FIN------<br>";
    $urlI = $control->listar();
    
  
    include_once 'noindex.php';   
    //QUIZAS DEBERIA CAMBIAR LA CONDICION
}else if( !$_FILES['imagen']['error'] ){
    //SUBIR IMAGEN y BORRARLAR DE LA CARPETA
     echo "ELSE IF <br>";
     echo (__LINE__-1) . "<br>";
     echo __FUNCTION__    . "<br>"; 
     echo __FILE__ . "<br>";
     echo "--------FIN------<br>";
     $urlI = $control->listar();
  

    //SUBE Y DEVUELVE NOMBE PARA PODER GUARDAR BIEN LA FOTO EN LA CARPTETA ABAJO   
    $nombreFichero = $control->subiraCarpeta(); 
   
    //BORRO FOTO PREVIA DE LA CARPETA IMG    
    $borradaBool = $control->borrarFotoCarpeta();
    //echo "Borrado " . $borradaBool . " Borrado <br>";
    
    //id dela img en la bbdd
     $id = $_REQUEST['id'];   

    //MANDA el ID de la imgaen en web para asociar en ese id una nueva imagen, 
    //por eso id e id son lo mismo abajo
    $id = $control->subiraBBDD($nombreFichero, $id);  
       
    $urlI = $control->listar();
    
    include_once 'noindex.php';   
    
}else{
    //SI SE DA A SUBIR Y NO HAY IMAGEN SE MANTIENE IGUAL
    echo "ELSE <br>";
    echo (__LINE__-1) . "<br>";
    echo __FUNCTION__    . "<br>"; 
    echo __FILE__ . "<br>";
    echo "--------FIN------<br>";
    $urlI = $control->listar();
    
    echo "No se ha podido cambiar imagenor q no se seleccionao imagen <br>";
    $urlI = $control->listar();
    include_once 'noindex.php';   
}


//Seguimiento del flujo del programa
//poner en cada metodo de clase

//echo extra informativo ej. 
echo ( __LINE__ - 1 ) . "<br>"; 
echo __FILE__ . "<br>"; //el file se puede quitar si son pocos ficheros
echo __METHOD__    . "<br>";     
echo "-------FIN-------<br>";

//

//Seguimiento de variable con echo o vardump (en XAMP)

//echo extra informativo ej. if else etc
echo ( __LINE__ + 3 ) . "<br>"; 
echo __METHOD__    . "<br>";   //SI LO HUVIERA
echo __FILE__ . "<br>";
echo "sustituye string por variable a imprimir <br>"; //echo "$variable <br>";
echo "-------FIN-------<br>";


//meterlo en etiqueta azul flujo verde varible

?>