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
                if(evaluarDirectorio($directorio)){
                    $directorio.="/".$mes;
                    if(evaluarDirectorio($directorio)){

                        $i= "-100x100.jpg";
                        $j= "-150x150.jpg";
                        $z= "-320x240.jpg";

                        $encript = hash("crc32",$id);

                        $temp_name = $_FILES['file']['tmp_name'];
                        $name = basename($_FILES['file']['name']);
                        $tamaño = $_FILES['file']['size'];
                        $img = $directorio.'/'.$name;
                        $archivo = move_uploaded_file($temp_name,$img);

                        
                            if($archivo){

                                $idAlbum = 0;
                                $parent = 0;
                                if(isset($_POST['idAlbum'])){
                                    $idAlbum = $_POST['idAlbum'];

                                    if(!empty($idAlbum)){
                                        $actividadDao1 = mediaDao::consultarIdAlbum($idAlbum);
                                        if($actividadDao1){
                                            $parent = $actividadDao1;

                                        }
                                    }
                                }

                                $nombre = str_replace('.jpg','',$name);
                                $nombre = str_replace('.png','',$name);
                                $nombre = str_replace('.jpeg','',$name);
                                $ruta = 'https://conexioncultural.com.co/wp-content/uploads/rtMedia/users/'.$id.'/'.$año.'/'.$mes.'/'.$name;
                                $objActividad = new actividad(
                                    $id,
                                    $fechaRegistro,
                                    '',
                                    $nombre,
                                    $parent,
                                    $ruta,
                                    'attachment',
                                    'image/jpeg'
                                );
                                $actividadDao = actividadDao::registrarActividad($objActividad);
                                if($actividadDao){
                                    
                                    $idmedia = actividadDao::ultimoIdActividad();

                                    $objmedia = new media(
                                        $idmedia,
                                        $id,
                                        $nombre,
                                        $idAlbum,
                                        'photo',
                                        'profile',
                                        $id,
                                        $fechaRegistro,
                                        $tamaño
                                    );

                                    $mediaDao = mediaDao::registrarMedia($objmedia);
                                    if($mediaDao){
                                        $img1=str_replace(".jpg",$i,$img);
                                        $img2=str_replace(".jpg",$j,$img);
                                        $img3=str_replace(".jpg",$z,$img);

                                        $img4=str_replace(".jpg",$i,$name);
                                        $img5=str_replace(".jpg",$j,$name);
                                        $img6=str_replace(".jpg",$z,$name);

                                        if(copy($img,$img1)){
                                            if(copy($img,$img2)){
                                                if(copy($img,$img3)){
                                                    $rtmedia = 'rtMedia/users/'.$id.'/'.$año.'/'.$mes.'/'.$name;
                                                    $string = 'a:5:{s:5:"width";i:1024;s:6:"height";i:1024;s:4:"file";
                                                        s:50:"'.$rtmedia.'";
                                                        s:5:"sizes";a:4:{s:18:"rt_media_thumbnail";a:4:{s:4:"file";
                                                        s:34:"'.$img5.'";
                                                        s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";
                                                        s:10:"image/jpeg";}s:23:"rt_media_activity_image";
                                                        a:4:{s:4:"file";s:34:"'.$img6.'";
                                                        s:5:"width";i:320;s:6:"height";i:240;s:9:"mime-type";
                                                        s:10:"image/jpeg";}s:21:"rt_media_single_image";
                                                        a:4:{s:4:"file";s:34:"'.$name.'";
                                                        s:5:"width";i:800;s:6:"height";i:800;s:9:"mime-type";
                                                        s:10:"image/jpeg";}s:23:"rt_media_featured_image";
                                                        a:4:{s:4:"file";s:34:"'.$img4.'";
                                                        s:5:"width";i:100;s:6:"height";i:100;s:9:"mime-type";
                                                        s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";
                                                        s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";
                                                        s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";
                                                        s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";
                                                        s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"1";s:8:"keywords";a:0:{}}}';


                                                    $postmeta = actividadDao::registrarPostMeta($idmedia,'_wp_attached_file',$rtmedia);
                                                    $postmeta2 = actividadDao::registrarPostMeta($idmedia,'_wp_attachment_metadata',$string);

                                                    $usuariooDao = usuarioDao::usuarioId($id);
                                                    $rtmedias = mediaDao::ultimoIdMedia();
                                                    $rtmediaid = $rtmedias['id'];
                                                    $rtmedia_title = $rtmedias['media_title'];
                                                    $nicename = $usuariooDao['user_nicename'];
                                                    $url = '<a href="https://conexioncultural.com.co/miembros/'.$nicename.'/">';
                                                    $mensaje = $url.'</a> ha publicado una actualizacion';
                                                    $link = 'https://conexioncultural.com.co/miembros/'.$nicename.'/';
                                                    $content = '<div class="rtmedia-activity-container">
                                                    <ul class="rtmedia-list rtm-activity-media-list rtmedia-activity-media-length-1">
                                                        <li class="rtmedia-list-item media-type-photo">
                                                            <a href="https://conexioncultural.com.co/miembros/'.$nicename.'/media/'.$rtmediaid.'/">
                                                        <div class="rtmedia-item-thumbnail">
                                                        <img alt="'.$rtmedia_title.'" 
                                                        src="https://conexioncultural.com.co/wp-content/uploads/rtMedia/users/'.$id.'/'.$año.'/'.$mes.'/'.$name.'" />
                                                    </div>
                                                    <div class="rtmedia-item-title">
                                                        
                                                            '.$rtmedia_title.'
                                                        
                                                    </div>
                                                </a></li></ul></div>';

                                                    $actividad = mediaDao::registrarActivity($id,'activity','activity_update',$mensaje,$content,$link,0,$fechaRegistro);
                                                    $success = array("message"=>"Foto subida correctamente","result"=>"","status"=>"1");
                                                    echo json_encode($success);
                                                }else{
                                                    $failed = array("message"=>"Error al copiar la foto","result"=>"","status"=>"0");
                                                    echo json_encode($failed);
                                                }
                                            }else{
                                                $failed = array("message"=>"Error al copiar la foto","result"=>"","status"=>"0");
                                                echo json_encode($failed);
                                            }  
                                        }else{
                                            $failed = array("message"=>"Error al copiar la foto","result"=>"","status"=>"0");
                                            echo json_encode($failed);
                                        }
                                    }else{
                                        $failed = array("message"=>"Error al guardar la imagen","result"=>"","status"=>"0");
                                        echo json_encode($failed);
                                    }
                                    
                                }else{
                                    $failed = array("message"=>"Error al subir la foto","result"=>"","status"=>"0");
                                    echo json_encode($failed);
                                }
                            }else{
                                $failed = array("message"=>"Error al subir la foto","result"=>"","status"=>"0");
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