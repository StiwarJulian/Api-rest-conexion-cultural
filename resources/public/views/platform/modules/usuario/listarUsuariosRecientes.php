<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'profileDataDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(MODEL_PATH.'profileData.php');

        //verifique si esta consulta retorna SOLO un array de objetos 
        $objProfile=usuarioDao::listarUsuarioReciente();
        if(!empty($objProfile)){
            $respuesta = array("message"=>"Listado Usuarios Recientes","result"=>$objProfile,"status"=>"1");
            #print_r($respuesta);
            #echo $respuesta;
            echo json_encode($respuesta);
        }else{
            $failed = array("message"=>"no hay usuarios con actividad reciente","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
?>