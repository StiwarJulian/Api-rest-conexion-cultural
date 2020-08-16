<?php 

    header("Access-Control-Allow-Origin: *");   
    header("Content-Type: application/json; charset=UTF-8");
    date_default_timezone_set('America/Bogota');

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'actividadDao.php');
    require_once(PDO_PATH.'mediaDao.php');
    require_once(MODEL_PATH.'media.php');
    require_once(MODEL_PATH.'actividad.php');
    require_once(MODEL_PATH.'usuario.php');

    if(isset($_POST['idUsuario']) && isset($_POST['nombre'])){
        $id = $_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $fechaRegistro =  date('Y-m-d H:i:s');
        if(!empty($id) && !empty($nombre)){
            $directorio = "../../../../../../../wp-content/uploads/rtMedia/users/".$id;
            $año = date('Y');
            $mes = date('m');
            
            if(evaluarDirectorio($directorio)){
                $directorio.="/".$año;
                if(evaluarDirectorio($año)){
                    $directorio.="/".$mes;
                    if(evaluarDirectorio($directorio)){

                        $encript = hash("crc32",$id);

                                $descripcion = '';
    
                                if(isset($_POST['descripcion'])){
                                    $descripcion = $_POST['descripcion'];
                                }                                

                                $ruta = 'https://conexioncultural.com.co/rtmedia-album/'.$nombre.'/';
                                $objActividad = new actividad(
                                    $id,
                                    $fechaRegistro,
                                    $descripcion,
                                    $nombre,
                                    'NULL',
                                    $ruta,
                                    'rtmedia_album',
                                    ''
                                );
                                $actividadDao = actividadDao::registrarActividad($objActividad);
                                if($actividadDao){
                                    
                                    $idmedia = actividadDao::ultimoIdActividad();

                                    $objmedia = new media(
                                        $idmedia,
                                        $id,
                                        $nombre,
                                        'NULL',
                                        'album',
                                        'profile',
                                        $id,
                                        $fechaRegistro,
                                        'NULL'
                                    );

                                    $mediaDao = mediaDao::registrarMedia($objmedia);
                                    if($mediaDao){
                                        $success = array("message"=>"album creado correctamente","result"=>"","status"=>"1");
                                        echo json_encode($success);
                                    }else{
                                        $failed = array("message"=>"Error al crear el album","result"=>"","status"=>"0");
                                        echo json_encode($failed);
                                    }
                                    
                                }else{
                                    $failed = array("message"=>"Error al crear el album","result"=>"","status"=>"0");
                                    echo json_encode($failed);
                                }
                           
                    }
                }
            }
            
        }else{
            $failed = array("message"=>"El identificador del usuario y/o nombre esta vacio","result","status"=>"0");   
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