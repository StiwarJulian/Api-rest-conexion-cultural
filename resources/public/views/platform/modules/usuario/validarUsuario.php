<?php 



    header("Access-Control-Allow-Origin: *");   
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(LIB_PATH.'wp-load.php');
    require_once(LIB_PATH.'wp-includes/class-phpass.php');

    if(isset($_POST['usuario']) && isset($_POST['clave'])){

        $usuario=$_POST['usuario'];
        $pass = $_POST['clave'];

        if(empty($usuario) || empty($pass)){

            $failed = array("message"=>"El nombre de usuario y/o clave esta vacia","result"=>"","status"=>"2");
            echo json_encode($failed);

        }else{
            $objUsuario = usuarioDao::usuarioIdUser($usuario);
            if($objUsuario){
                $wp_hash = (wp_check_password($pass,$objUsuario['user_pass'],$objUsuario['ID']));

                if($wp_hash==TRUE){
                    $id = $objUsuario['ID'];
                    $nombre = $objUsuario['user_nicename'];
                    
                    $validarUsuario = usuarioDao::usuarioOnlineId($id);
                    if($validarUsuario){
                        $validado = array("message"=>"EXITO! El usuario ha iniciado sesion correctamente","result"=>$objUsuario,"status"=>"1");
                        echo json_encode($validado);
                    }else{
                        $objUser = usuarioDao::registrarUsuarioOnline($id,$nombre);
                        if($objUser){
                            $validado = array("message"=>"EXITO! El usuario ha iniciado sesion correctamente","result"=>$objUsuario,"status"=>"1");
                            echo json_encode($validado);
                        }else{
                            $failed = array("message","FALLO! El usuario no ha podido iniciar la sesion","result"=>"","status"=>"0");
                            echo json_encode($failed);
                        }
                    }
                }else{
                    $failed = array("message"=>"La clave ingresada es incorrecta","result"=>"","status"=>"0");
                    echo json_encode($failed);
                }
            }else{
                $failed = array("message"=>"El usuario ingresado no se encuentra registrado","result"=>"","status"=>"0");
                echo json_encode($failed);
            }
        }
    }else{
        $failed = array("message"=>"Los datos no llegaron al servidor","result"=>"","status"=>"0");
        echo json_encode($failed);
    }

?>