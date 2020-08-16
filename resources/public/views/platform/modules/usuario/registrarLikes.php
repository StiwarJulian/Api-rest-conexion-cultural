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

            $likes = mediaDao::cantidadLikes($id);
            if($likes == 0 || $likes){
                $likes += 1;     
                $objLikes = mediaDao::modificarLikes($id, $likes);
                if($objLikes){
                    $success = array("message"=>"Like realizado","result"=>"","status"=>"1");
                    echo json_encode($success);
                }else{
                    $fallo = array("message"=>"Like no realizado","result"=>"","status"=>"1");
                    echo json_encode($fallo);
                }
            }else{
                $fallo = array("message"=>"Algo fallo!","result"=>"","status"=>"0");
                echo json_encode($fallo);
            }
        }else{
            $fallo = array("message"=>"Identificador del post vacio!","result"=>"","status"=>"0");
            echo json_encode($fallo);
        }
    }else{
        $fallo = array("message"=>"No llego los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($fallo);
    }
?>