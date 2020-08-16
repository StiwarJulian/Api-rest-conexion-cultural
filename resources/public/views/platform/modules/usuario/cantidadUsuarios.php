<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'profileDataDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(MODEL_PATH.'profileData.php');

    $objUsuario=usuarioDao::cantidadUsuarios();
    if($objUsuario){
        $success=array("message"=>"Cantidad Usuarios","result"=>$objUsuario,"status"=>"1");
        echo json_encode($success);
    }else{
        $failed=array("message"=>"No se pudo traer la cantidad de usuarios","result"=>"0","status"=>"0");
        echo json_encode($failed);
    }
?>