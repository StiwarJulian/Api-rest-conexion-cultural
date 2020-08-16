<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('America/Bogota');

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'comentariosDao.php');
require_once(MODEL_PATH.'comentarios.php');

    if(isset($_POST['idComentario']) && isset($_POST['idUsuario'])){
        $idborrado = $_POST['idComentario'];
        $idUsuario = $_POST['idUsuario'];
        if(!empty($idborrado) && !empty($idUsuario)){
            $objComentarios = comentariosDao::borrarComentario($idborrado,$idUsuario);

            $success=array("message"=>"Comentario borrado","result"=>"","status"=>"1");
            echo json_encode($success);

        }else{
            $fallo = array("message"=>"El identificador del comentario y/o usuario esta vacio","result"=>"","status"=>"0");
            echo json_encode($fallo);
        }
    }else{
        $fallo = array("message"=>"No han llegado los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($fallo);
    }
?>