<?php 

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'profileDataDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(MODEL_PATH.'profileData.php');
    require_once(LIB_PATH.'wordpress/class-phpass.php');
    require_once(LIB_PATH.'wordpress/formatting.php');

    if((isset($_POST['idUsuario'])) && (isset($_POST['clave_'])) && (isset($_POST['clave_2']))){

        $id = $_POST['idUsuario'];
        $clave = $_POST['clave_'];
        $clave2 = $_POST['clave_2'];

        if(!empty($clave) && !empty($clave2)){
            if($clave==$clave2){
                $password_hash = new PasswordHash(8, TRUE);
                $password_encript=$password_hash->HashPassword(wp_unslash($clave));

                $objUsuario = usuarioDao::cambiarClave($id,$password_encript);
                if($objUsuario){
                    echo $objUsuario;
                }else{
                    $failed = array("message"=>"No se ha podido cambiar la clave","result"=>"","status"=>"0");
                    echo json_encode($failed); 
                }
            }else{
                $failed = array("message"=>"Las contraseñas no coinciden","result"=>"","status"=>"0");
                echo json_encode($failed); 
            }
        }else{
            $failed = array("message"=>"Porfavor ingrese todos los campos","result"=>"","status"=>"0");
            echo json_encode($failed);
        }

    }else{
        $failed = array("message"=>"Los datos no llegaron correctamente","result"=>"","status"=>"0");
        echo json_encode($failed);
    }
?>