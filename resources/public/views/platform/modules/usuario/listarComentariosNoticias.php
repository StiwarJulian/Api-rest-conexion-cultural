<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'usuarioDao.php');
require_once(PDO_PATH.'mediaDao.php');
require_once(MODEL_PATH.'usuario.php');
require_once(MODEL_PATH.'media.php');

    if(isset($_POST['id'])){
        $id= $_POST['id'];
        if(!empty($id)){
            $objMedia = mediaDao::listarComentariosNoticias($id);
            
            if($objMedia){
                $success=array("message"=>"comentarios encontrados","result"=>$objMedia,"status"=>"1");
                echo json_encode($success);
            }else{
                $failed = array("message"=>"No se han encontrado comentarios","result"=>"","status"=>"0");
                echo json_encode($failed);
            }

        }else{
            $failed = array("message"=>"Identificador Vacio","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
    }else{
        $failed = array("message"=>"no han llegado los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($failed);
    }

?>