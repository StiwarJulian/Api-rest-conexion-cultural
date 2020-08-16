<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'actividadDao.php');
    require_once(MODEL_PATH.'actividad.php');

    $objactividad = actividadDao::listarNoticiasAdministrador();
    if(!empty($objactividad)){
        $success = array("message"=>"Mensajes del administrador activos","result"=>$objactividad,"status"=>"1");
        echo json_encode($success);
    }else{
        $failed = array("message"=>"No se han encontrado mensajes activos","result"=>"","status"=>"0");
        echo json_encode($failed);
    }
?>