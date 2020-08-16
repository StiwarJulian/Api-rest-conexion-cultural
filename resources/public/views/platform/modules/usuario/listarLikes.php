<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('America/Bogota');

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'mediaDao.php');
require_once(MODEL_PATH.'media.php');

    if(isset($_POST['idPost'])){
        $id = $_POST['idPost'];

        if(!empty($id)){
            $objLikes = mediaDao::cantidadLikes($id);
            if($objLikes==0 || $objLikes){
                $success = array("message"=>"Cantidad de votos del post","result"=>$objLikes,"status"=>"1");
                echo json_encode($success);
            }else{
                $fallo = array("message"=>"No se pudo cargar la cantidad de likes","result"=>"","status"=>"0");
                echo json_encode($fallo);  
            }
        }else{
            $fallo = array("message"=>"El identificador esta vacio","result"=>"","status"=>"0");
            echo json_encode($fallo); 
        }
    }else{
        $fallo = array("message"=>"No han llegado los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($fallo);
    }

?>