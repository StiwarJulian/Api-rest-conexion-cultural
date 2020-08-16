<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'mensajesDao.php');
require_once(PDO_PATH.'usuarioDao.php');
require_once(MODEL_PATH.'mensajes.php');
require_once(MODEL_PATH.'mensajesRecipientes.php');


if((isset($_POST['idUsuario'])) && 
    (isset($_POST['thread_id'])) &&
    (isset($_POST['titulo'])) && 
    (isset($_POST['contenido']))){
        
        $idUsuario= $_POST['idUsuario'];
        $thread_id = $_POST['thread_id'];
        $titulo = 'Re: ';
        $contenido = $_POST['contenido'];

        if(!empty($idUsuario) && !empty($thread_id) && !empty($titulo) && !empty($contenido)){
            $titulo .= $_POST['titulo'];
            
            $objMensajes = new mensajes(
                null,
                $thread_id,
                $idUsuario,
                $titulo,
                $contenido,
                date('Y-m-d H:i:s')
            );
            $objRegistro = mensajesDao::registrarMensajeNuevo($objMensajes);

            if($objRegistro){
                $success = array("message"=>"Mensaje enviado correctamente","result"=>"","status"=>"1");
                echo json_encode($success);
            }else{
                $fallo = array("message"=>"Fallo al enviar el mensaje","result"=>"","status"=>"0");
                echo json_encode($fallo);
            }
        }else{
            $fallo = array("message"=>"Por favor ingresa todos los campos","result"=>"","status"=>"0");
            echo json_encode($fallo);
        }
    }else{
        $fallo = array("message"=>"No han llegado todos los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($fallo);
    }

?>