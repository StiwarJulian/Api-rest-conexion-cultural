<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

require_once(DATABASE_PATH.'DataSource.php');
require_once(PDO_PATH.'usuarioDao.php');
require_once(PDO_PATH.'profileDataDao.php');
require_once(MODEL_PATH.'usuario.php');
require_once(MODEL_PATH.'profileData.php');

    if(isset($_POST['idUsuario'])){
        $id = $_POST['idUsuario'];

        if(!empty($id)){
            $objUsuario = usuarioDao::usuarioId($id);

            if($objUsuario){

                
                $perfil = "../../../../../../../cc_imagen_privada001_warning/wp-content/uploads/avatars/".$id;
                $portada = "../../../../../../../cc_imagen_privada001_warning/wp-content/uploads/buddypress/members/".$id;
                $cultural = "http://portalx.net/";
                $homeCultural = "/home1/portalxn/public_html/";

                if(is_dir($portada)){
                    $portada.="/cover-image";
                    
                    $imagenPortada = glob($portada."/*");
                    $img2 = $imagenPortada[0];
                    
                    if(!empty($img2)){
                        $img2 = realpath($img2).PHP_EOL;
                        $img2 = str_replace($homeCultural,$cultural,$img2);
                    }else{
                        $img2 = "https://edit.org/assets/images/fondo-landing.jpg.pagespeed.ce.YGCvZEen_M.jpg";
                    }
                }else{
                    $img2 = "https://edit.org/assets/images/fondo-landing.jpg.pagespeed.ce.YGCvZEen_M.jpg";
                }

                if(is_dir($perfil)){
                    $imagenPerfil = glob($perfil."/*");
                    $img = $imagenPerfil[0];

                    if(!empty($img)){
                        $img = realpath($img).PHP_EOL;
                        $img = str_replace($homeCultural,$cultural,$img);
                        var_dump($img);
                    }else{
                        $img = "https://upload.wikimedia.org/wikipedia/commons/7/72/Default-welcomer.png";
                    }

                }else{
                    $img = "https://upload.wikimedia.org/wikipedia/commons/7/72/Default-welcomer.png";
                }

                $imagenes = array("perfil"=>$img,"portada"=>$img2);
                $success = array("message"=>"","result"=>$imagenes,"status"=>"1");
                echo json_encode($success);
                
            }else{
                $failed=array("message"=>"El identificador no pertenece a ningun usuario","result"=>"","status"=>"0");
                echo json_encode($failed);
            }
        }else{
            $failed=array("message"=>"El identificador del usuario esta vacio","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
    }else{
        $failed=array("message"=>"No ha llegado los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($failed);
    }

?>