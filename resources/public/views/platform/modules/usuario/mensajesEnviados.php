<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'mensajesDao.php');
    require_once(MODEL_PATH.'mensajes.php');

    if(isset($_POST['thread_id'])){
        
        
        $idthread = $_POST['thread_id'];
        if(!empty($idthread)){
            $objmensajes = mensajesDao::mensajesEnviados($idthread);
            if(!empty($objmensajes)){
                $success = array("message"=>"Mensajes enviados","result"=>$objmensajes,"status"=>"1");
                echo json_encode($success);
            }else{
                $failed = array("message"=>"No se han encontrado mensajes","result"=>"","status"=>"0");
                echo json_encode($failed); 
            }
        }else{
            $failed = array("message"=>"El identificador del mensaje esta vacio","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
    }else{
        $failed = array("message"=>"No han llegado los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($failed);
    }
?>