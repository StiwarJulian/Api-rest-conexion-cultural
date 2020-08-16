<?php 

    header("Access-Control-Allow-Origin: *");   
    header("Content-Type: application/json; charset=UTF-8");
    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'actividadDao.php');
    require_once(PDO_PATH.'mediaDao.php');
    require_once(MODEL_PATH.'media.php');
    require_once(MODEL_PATH.'actividad.php');
    require_once(MODEL_PATH.'usuario.php');

    if(isset($_POST['idUsuario']) && isset($_FILES['file'])){
        $id = $_POST['idUsuario'];
        $fechaRegistro =  date('Y-m-d H:i:s');
        if(!empty($id)){
            $directorio = "../../../../../../../cc_imagen_privada001_warning/wp-content/uploads/rtMedia/users/".$id;
            $año = date('Y');
            $mes = date('m');
            
            if(evaluarDirectorio($directorio)){
                $directorio.="/".$año;
                if(evaluarDirectorio($año)){
                    $directorio.="/".$mes;
                    if(evaluarDirectorio($directorio)){

                        $encript = hash("crc32",$id);

                        $temp_name = $_FILES['file']['tmp_name'];
                        $name = basename($_FILES['file']['name']);
                        $tamaño = $_FILES['file']['size'];
                        $musica = $directorio.'/'.$name;
                        $archivo = move_uploaded_file($temp_name,$musica);

                        
                            if($archivo){

                                $idAlbum = 0;
                                $descripcion = '';
                                if(isset($_POST['idAlbum'])){
                                    $idAlbum = $_POST['idAlbum'];
                                }
                                if(isset($_POST['descripcion'])){
                                    $descripcion = $_POST['descripcion'];
                                }
                                $nombre = str_replace('.mp3','',$name);
                                if(isset($_POST['nombre'])){
                                    $nombre = $_POST['nombre'];
                                }

                                $ruta = 'https://conexioncultural.com.co/wp-content/uploads/rtMedia/users/'.$id.'/'.$año.'/'.$mes.'/'.$name;
                                $objActividad = new actividad(
                                    $id,
                                    $fechaRegistro,
                                    $descripcion,
                                    $nombre,
                                    $idAlbum,
                                    $ruta,
                                    'attachment',
                                    'audio/mpeg'
                                );
                                $actividadDao = actividadDao::registrarActividad($objActividad);
                                if($actividadDao){
                                    
                                    $idmedia = actividadDao::ultimoIdActividad();

                                    $objmedia = new media(
                                        $idmedia,
                                        $id,
                                        $nombre,
                                        $idAlbum,
                                        'music',
                                        'profile',
                                        $id,
                                        $fechaRegistro,
                                        $tamaño
                                    );

                                    $usuariooDao = usuarioDao::usuarioId($id);
                                    $rtmedias = mediaDao::ultimoIdMedia();
                                    $rtmediaid = $rtmedias['id'];
                                    $rtmedia_title = $rtmedias['media_title'];
                                    $nicename = $usuariooDao['user_nicename'];

                                        $nicename = $usuariooDao['user_nicename'];
                                        $url = '<a href="https://conexioncultural.com.co/miembros/'.$nicename.'/">';
                                        $url2 = '<a href="https://conexioncultural.com.co/miembros/'.$nicename.'/media/'.$rtmediaid.'/">';
                                        $mensaje = $url.$usuariooDao['display_name'].'</a> Añadio un Musica';
                                        $link = 'https://conexioncultural.com.co/miembros/'.$nicename.'/';

            
                                        $content = '<div class="rtmedia-activity-container">
                                        <ul class="rtmedia-list rtm-activity-media-list rtmedia-activity-media-length-1">
                                        <li class="rtmedia-list-item media-type-music">
                                            <div class="rtmedia-item-thumbnail">
                                                        <audio src="https://conexioncultural.com.co/wp-content/uploads/rtMedia/users/'.$id.'/'.$año.'/'.$mes.'/'.$name.'"
                                                        width="320" class="wp-audio-shortcode" id="rt_media_audio_395" controls="controls" preload="none"></audio>
                                                    </div>
                                                    <div class="rtmedia-item-title">
                                                        
                                            '.$url2.'
                                                    '.$rtmedia_title.'
                                                </a>
                                        
                                    </div></li></ul></div>';
                                        

                                            $actividad = mediaDao::registrarActivity($id,'profile','rtmedia_update',$mensaje,$content,$link,$idmedia,$fechaRegistro);
                                    $mediaDao = mediaDao::registrarMedia($objmedia);
                                    if($mediaDao){
                                        $success = array("message"=>"musica subida correctamente","result"=>"","status"=>"1");
                                        echo json_encode($success);
                                    }else{
                                        $failed = array("message"=>"Error al registrar la cancion","result"=>"","status"=>"0");
                                        echo json_encode($failed);
                                    }
                                    
                                }else{
                                    $failed = array("message"=>"Error al subir la musica","result"=>"","status"=>"0");
                                    echo json_encode($failed);
                                }
                            }else{
                                $failed = array("message"=>"Error al subir la musica","result"=>"","status"=>"0");
                                echo json_encode($failed);
                            }
                    }
                }
            }
            
        }else{
            $failed = array("message"=>"El identificador del usuario esta vacio","result","status"=>"0");   
            echo json_encode($failed);
        }
    }else {
        $failed = array("message"=>"No han llegado los campos necesarios","result","status"=>"0");   
        echo json_encode($failed);
    }
    
    function evaluarDirectorio($directorio){
        if(!is_dir($directorio)){
            if(!mkdir($directorio,0777,true)){
                $failed = array("message","fallo al crear la carpeta donde ira el archivo","result"=>"0","status"=>"0");
                echo json_encode($failed);
            }else{
                return true;
            }
        }else{
            return true;
        }
    }
?>