<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'actividadDao.php');
    require_once(MODEL_PATH.'actividad.php');

    if(isset($_POST['idUsuario'])){
        
        $id = $_POST['idUsuario'];

        if(!empty($id)){
            $objmensajes = actividadDao::listarMensajesUsuario($id);
            if(!empty($objmensajes)){
                $success = array("message"=>"Listado mensajes","result"=>$objmensajes,"status"=>"1");
                echo json_encode($success);
            }else{
                $failed = array("message"=>"No se han encontrado mensajes","result"=>"","status"=>"0");
                echo json_encode($failed); 
            }
        }else{
            $failed = array("message"=>"El identificador del usuario esta vacio","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
    }else{
        $failed = array("message"=>"No han llegado los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($failed);
    }
?>