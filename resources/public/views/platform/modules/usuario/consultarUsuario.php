<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'profileDataDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(MODEL_PATH.'profileData.php');

    if(isset($_POST['idUsuario'])){
        $id = $_POST['idUsuario'];

        if(!empty($id)){
            $objUsuario=usuarioDao::usuarioId($id);
            if($objUsuario){
                
                $respuesta = array("message"=>"Perfil Del Usuario","result"=>$objUsuario,"status"=>"1");
                echo json_encode($respuesta);
            }else{
                $failed = array("message"=>"usuario no encontrado","result"=>"","status"=>"0");
                echo json_encode($failed);
            }
        }else{
            $failed = array("message"=>"El identificador no fue recibido","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
    }else{
        $failed = array("message"=>"Error datos no recibidos","result"=>"","status"=>"0");
        echo json_encode($failed);
    }
?>