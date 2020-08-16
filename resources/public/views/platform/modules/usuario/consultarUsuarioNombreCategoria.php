<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'profileDataDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(MODEL_PATH.'profileData.php');

    $nombre = '';
    if(isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
    }

    if(isset($_POST['actividades'])){
        $actividades = $_POST['actividades'];

        $objUsuario=usuarioDao::listarUsuarioNombreCategoria($nombre,$actividades);
        if($objUsuario){
        
            $respuesta = array("message"=>"Listado de usuarios","result"=>$objUsuario,"status"=>"1");
            echo json_encode($respuesta);
        }else{
            $failed = array("message"=>"Usuarios no encontrados","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
    }else{
        $failed = array("message"=>"Las actividades no fue recibida","result"=>"","status"=>"0");
        echo json_encode($failed);
    }
?>