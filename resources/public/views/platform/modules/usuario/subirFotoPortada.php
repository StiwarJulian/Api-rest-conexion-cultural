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
        $directorio = "../../../../../../../cc_imagen_privada001_warning/wp-content/uploads/buddypress/members/".$id;

            if(isset($_FILES['file'])){
                $directorio_cover = $directorio.'/cover-image';

                if(!is_dir($directorio)){
                    if(mkdir($directorio,0777,true)){
                        if(!is_dir($directorio_cover)){
                            if(!mkdir($directorio_cover,0777,true)){die('Fallo al crear las carpetas...');}
                        }
                    }else{
                        die('Fallo al crear las carpetas ...');
                    }
                }else{
                    if(is_dir($directorio_cover)){
                        $files = glob($directorio.'/cover-image/*');
                        foreach($files as $file){
                            if(is_file($file))
                                unlink($file); //elimino el fichero
                        }
                        $cover_eliminado = rmdir($directorio_cover);
                        if($cover_eliminado){
                            $directorio_eliminado = rmdir($directorio);
                            if($directorio_eliminado){
                                if(mkdir($directorio,0777,true)){
                                    if(!is_dir($directorio_cover)){
                                        if(!mkdir($directorio_cover,0777,true)){die('Fallo al crear las carpetas...');}
                                    }
                                }else{
                                    die('Fallo al crear las carpetas ...');
                                }
                            }
                        }
                    }else{
                        if(!mkdir($directorio_cover,0777,true)){die('Fallo al crear las carpetas...');}
                    }
                }
            $img = $directorio.'/cover-image/'.$encript;
            #var_dump($img);

            $temp_name = $_FILES['file']['tmp_name'];
            $archivo = move_uploaded_file($temp_name,$img.'-bp-cover-image.jpg');

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