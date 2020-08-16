<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'usuarioDao.php');
require_once(PDO_PATH.'mediaDao.php');
require_once(MODEL_PATH.'usuario.php');
require_once(MODEL_PATH.'media.php');

    if(isset($_POST['idUsuario']) && isset($_POST['idAlbum'])){
        $id=$_POST['idUsuario'];
        $idAlbum=$_POST['idAlbum'];
        if(!empty($id)){
            $objMedia = mediaDao::listarArchivoAlbum($id,$idAlbum);

            if($objMedia){
                $success=array("message"=>"Listado de archivo del album","result"=>$objMedia,"status"=>"1");
                echo json_encode($success);
            }else{
                $failed = array("message"=>"No se encontro ningun archivo","result"=>"","status"=>"0");
                echo json_encode($failed);
            }

        }else{
            $failed = array("message"=>"El identificador esta vacio","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
    }else{
        $failed = array("message"=>"No han llegado los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($failed);
    }

?>