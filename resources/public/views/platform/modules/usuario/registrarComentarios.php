<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('America/Bogota');

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'comentariosDao.php');
require_once(MODEL_PATH.'comentarios.php');

    if(isset($_POST['idPost']) && isset($_POST['autor']) && 
    isset($_POST['contenido']) && isset($_POST['user_id'])){
        $parent = 0;
        $email = '';
        $post = $_POST['idPost'];
        $autor = $_POST['autor'];
        $contenido = $_POST['contenido'];
        $user_id = $_POST['user_id'];
        
        if(isset($_POST['parent'])){
            $parent = $_POST['parent'];
        }
        if(isset($_POST['email'])){
            $email=$_POST['email'];
        }

        if(!empty($post) && !empty($autor) && !empty($contenido) && !empty($user_id)){

            $modelComentarios = new comentarios(
                null,
                $post,
                $autor,
                $email,
                date('Y-m-d H:i:s'),
                $contenido,
                $parent,
                $user_id
            );

            $objComentarios = comentariosDao::registrarComentario($modelComentarios);

            if($objComentarios){
                $success = array("message"=>"Comentario Realizado","result"=>"","status"=>"1");
                echo json_encode($success);
            }else{
                $fallo = array("message"=>"No se pudo realizar el comentario","result"=>"","status"=>"0");
                echo json_encode($fallo);
            }
        }else{
            $fallo = array("message"=>"Campos vacios","result"=>"","status"=>"0");
            echo json_encode($fallo);
        }
        
    }else{
        $fallo = array("message"=>"No han llegado los datos necesarios","result"=>"","status"=>"0");
        echo json_encode($fallo);
    }


?>