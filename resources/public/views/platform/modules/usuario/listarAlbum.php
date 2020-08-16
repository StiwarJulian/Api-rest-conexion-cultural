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

            if($objMedia){
                $array_photo = array();
                foreach ($objMedia as $key => $value) {
                    $idAlbum = $objMedia[$key]['id'];
                    $objFile = mediaDao::consultarArchivoAlbum($id,$idAlbum);
                    if($objFile){
                        foreach ($objFile as $clave => $valor) {
                            $objAlbum = array(
                            $objMedia[$key]['id'],
                            $objMedia[$key]['media_id'],
                            $objMedia[$key]['media_title'],
                            $objMedia[$key]['post_title'],
                            $objMedia[$key]['guid'],
                            $objFile[$clave]['media_type']
                            );
                            
                            array_push($array_photo,$objAlbum);
                        }
                    }else{
                        $objAlbum2 = array(
                            $objMedia[$key]['id'],
                            $objMedia[$key]['media_id'],
                            $objMedia[$key]['media_title'],
                            $objMedia[$key]['post_title'],
                            $objMedia[$key]['guid'],
                            'sin tipo'
                        );
                        array_push($array_photo,$objAlbum2);
                    }
                }

                
                    $success=array("message"=>"Albums encontrados","result"=>$array_photo,"status"=>"1");
                    echo json_encode($success);  
                
            }else{
                $failed = array("message"=>"No se han encontrado albums","result"=>"","status"=>"0");
                echo json_encode($failed);
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