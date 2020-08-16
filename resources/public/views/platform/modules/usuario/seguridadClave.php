<?php 

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'profileDataDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(MODEL_PATH.'profileData.php');

    if( (isset($_POST['nacionalidad'])) && 
        (isset($_POST['telefono'])) && 
        (isset($_POST['ciudad'])) &&
        (isset($_POST['usuario']))){

        $nacionalidad = $_POST['nacionalidad'];
        $ciudad = $_POST['ciudad'];
        $telefono = $_POST['telefono'];
        $usuario = $_POST['usuario'];

        if(empty($usuario) || empty($nacionalidad) || empty($ciudad) || empty($telefono)){
            $failed = array("message"=>"Por favor llene todos los campos","result"=>"","status"=>"0");
            echo json_encode($failed);
        }else{
            $objUsuario=usuarioDao::usuarioIdUser($usuario);
            if($objUsuario){
                $objProfile = profileDataDao::profileId($objUsuario['ID']);

                if($objProfile){
                    $contador = 0;
                    foreach ($objProfile as $clave=> $value) {

                        if( ($objProfile[$clave][3]==$telefono)||
                            ($objProfile[$clave][3]==$nacionalidad)||
                            ($objProfile[$clave][3]==$ciudad)){

                            $contador+=1;
                        }
                    }
                    if($contador==3){
                        $success = array("message"=>"Los datos ingresados son correctos","result"=>$objUsuario,"status"=>"1");
                        echo json_encode($success);
                    }else{
                        $failed = array("message"=>"Los datos no coinciden","result"=>"","status"=>"0");
                        echo json_encode($failed);
                    }

                }
            }else{
                $failed = array("message"=>"El usuario ingresado no existe","result"=>"","status"=>"0");
                echo json_encode($failed); 
            }
        }

    }else{
        $failed = array("message"=>"No han llegado los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($failed);
    }
?>