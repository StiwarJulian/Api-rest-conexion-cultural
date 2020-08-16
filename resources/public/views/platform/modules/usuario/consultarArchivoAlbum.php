<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'usuarioDao.php');
require_once(PDO_PATH.'mediaDao.php');
require_once(MODEL_PATH.'usuario.php');
require_once(MODEL_PATH.'media.php');

    if(isset($_POST['idUsuario'])){
        $id=$_POST['idUsuario'];
        if(!empty($id)){
            $objMedia = mediaDao::listarAlbum($id);
            #print_r($objMedia);
            if($objMedia){
                $array_album = array();
                foreach($objMedia as $clave =>$value){
                    $objMedia1=mediaDao::consultarArchivoAlbum($id,$objMedia[$clave]['id']);
                    if($objMedia1){
                        array_push($array_album,$objMedia1);
                    }
                }

                if(!empty($array_album)){
                    $arrayContenido = array();
                    #print_r($array_album);
                    foreach($array_album as $clave => $value){
                        if($array_album[$clave]['media_type'] == 'photo'){
                            $objMedia=mediaDao::listarFotos($id,$array_album[$clave]['album_id']);
                        }
                        if($array_album[$clave]['media_type'] == 'music'){
                            $objMedia=mediaDao::listarMusica($id,$array_album[$clave]['album_id']);
                        }
                        if($array_album[$clave]['media_type'] == 'video'){
                            $objMedia=mediaDao::listarVideos($id,$array_album[$clave]['album_id']);
                        }

                        array_push($arrayContenido,$objMedia);
                    }

                    print_r($arrayContenido);
                }
            }


        }else{
            $failed = array("message"=>"El identificador esta vacio","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
    }else{
        $failed = array("message"=>"No han llegado los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($failed);
    }

?>