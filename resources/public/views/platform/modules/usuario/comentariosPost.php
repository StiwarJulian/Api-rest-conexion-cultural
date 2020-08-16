<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'comentariosDao.php');
require_once(MODEL_PATH.'comentarios.php');

    if(isset($_POST['idPost'])){
        $id = $_POST['idPost'];

        if(!empty($id)){
            $objComentarios = comentariosDao::comentariosId($id);
            if($objComentarios){
                $success = array("message"=>"Listado comentarios del post","result"=>$objComentarios,"status"=>"1");
                echo json_encode($success);
            }
        }else{
            $fallo = array("message"=>"Identificador del post vacio","result"=>"","status"=>"0");
            echo json_encode($fallo);
        }
    }else{
        $fallo = array("message"=>"No han llegado los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($fallo);
    }
?>