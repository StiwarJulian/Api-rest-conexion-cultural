<?php 

    header("Access-Control-Allow-Origin: *");   
    header("Content-Type: application/json; charset=UTF-8");
    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(MODEL_PATH.'usuario.php');

    if(isset($_POST['idUsuario'])){

        $id=$_POST['idUsuario'];

        $encript = hash("crc32",$id);
        $directorio = "../../../../../../../cc_imagen_privada001_warning/wp-content/uploads/avatars/".$id;
        $img = $directorio.'/'.$encript;

            if(isset($_FILES['file'])){

                if(!is_dir($directorio)){
                    if(!mkdir($directorio,0777,true)){die('Fallo al crear las carpetas...');}
                }else{
                    $files = glob($directorio.'/*');
                    foreach($files as $file){
                        if(is_file($file))
                            unlink($file); //elimino el fichero
                    }
                    $directorio_eliminado = rmdir($directorio);
                    if($directorio_eliminado){
                        if(!mkdir($directorio,0777,true)){die('Fallo al crear las carpetas...');}
                    }
                } 
            
            $temp_name = $_FILES['file']['tmp_name'];
            $archivo = move_uploaded_file($temp_name,$img.'-bpfull.jpg');

            if($archivo == 1){
               $success = array("message"=>"imagen subida con exito","result"=>"","status"=>"1");
               echo json_encode($success);
            }else{
                $failed = array("message"=>"Fallo al subir la imagen","result"=>"","status"=>"0");
                echo json_encode($failed);
            }
        }else{
            $failed = array("message"=>"La imagen no llego al destino","result"=>"","status"=>"0");
        }
    }else{
        $failed = array("message"=>"El identificador del usuario no ha sido recibido","result"=>"","status"=>"0");
    }
    
?>