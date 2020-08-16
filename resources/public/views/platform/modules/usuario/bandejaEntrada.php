<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'mensajesDao.php');
require_once(PDO_PATH.'usuarioDao.php');
require_once(MODEL_PATH.'mensajes.php');
require_once(MODEL_PATH.'mensajesRecipientes.php');

if(isset($_POST['idUsuario'])){

    $id = $_POST['idUsuario'];

    if(!empty($id)){
        $objEntrada = mensajesDao::mensajesId($id);
        if($objEntrada){
            $success = array("messsage"=>"bandeja con datos encontrados","result"=>$objEntrada,"status"=>"1");
            echo json_encode($success);
        }else{
            $fallo = array("message"=>"No se encontraron mensajes","result"=>"","status"=>"0");
            echo json_encode($fallo); 
        }
    }else{
        $fallo = array("message"=>"Identificador vacio","result"=>"","status"=>"0");
        echo json_encode($fallo); 
    }

}else{
    $fallo = array("message"=>"No ha enviado los datos requeridos","result"=>"","status"=>"0");
    echo json_encode($fallo);
}
?>