<?php 



    header("Access-Control-Allow-Origin: *");   
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(LIB_PATH.'wp-load.php');
    require_once(LIB_PATH.'wp-includes/class-phpass.php');


    if(isset($_POST['idUsuario'])){
        $id = $_POST['idUsuario'];

        if(!empty($id)){
            
            $objUsuario=usuarioDao::cerrarSesionActiva($id);
            if($objUsuario){
                $success = array("message"=>"La sesion ha sido cerrada correctamente","result"=>"","status"=>"1");
                echo json_encode($success);
            }else{
                $failed = array("message"=>"Fallo al cerrar la sesion","result"=>"","status"=>"0");
                echo json_encode($failed);
            }
        }else{
            $failed = array("message"=>"El identificador del usuario esta vacio","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
    }else{
        $failed = array("message"=>"El identificador del usuario no ha sido recibido","result"=>"","status"=>"0");
        echo json_encode($failed);
    }
?>