<?php 

header("Access-Control-Allow-Origin: *");   
header("Content-Type: application/json; charset=UTF-8");

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'usuarioDao.php');
require_once(MODEL_PATH.'usuario.php');
require_once(LIB_PATH.'wp-load.php');
require_once(LIB_PATH.'wp-includes/class-phpass.php');


    $objUsuario= usuarioDao::ultimoIdUsuario();

    if($objUsuario){
        $success = array("message"=>"Usuario","result"=>$objUsuario,"status"=>"1");
        echo json_encode($success);
    }else{
        $failed = array("message"=>"fallo al buscar el usuario","result"=>"","status"=>"0");
        echo json_encode($failed);
    }

?>