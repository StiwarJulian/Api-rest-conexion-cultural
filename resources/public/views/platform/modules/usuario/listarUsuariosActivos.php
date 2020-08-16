<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'profileDataDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(MODEL_PATH.'profileData.php');

    if(isset($_POST['cantidad'])){
        $cantidad = $_POST['cantidad'];

        if(!empty($cantidad)){
            if($cantidad == 'all'){
                $objUsuario=usuarioDao::listarUsuariosActivos();
                if($objUsuario){
                    $respuesta = array("message"=>"Listado Usuarios Activos","result"=>$objUsuario,"status"=>"1");
                    echo json_encode($respuesta);
                }else{
                    $failed = array("message"=>"no hay usuarios","result"=>"","status"=>"0");
                    echo json_encode($failed);
                }
            }else{
                $objUsuario=usuarioDao::listarUsuariosActivosCantidad($cantidad);
                if($objUsuario){
                    $respuesta = array("message"=>"Listado Usuarios Activos","result"=>$objUsuario,"status"=>"1");
                    echo json_encode($respuesta);
                }else{
                    $failed = array("message"=>"no hay usuarios","result"=>"","status"=>"0");
                    echo json_encode($failed);
                }
            }
        }else{
            $failed = array("message"=>"la cantidad de usuarios esta vacia","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
    }else{
        $failed = array("message"=>"Los campos necesarios estan vacios","result"=>"","status"=>"0");
        echo json_encode($failed);
    }
        
?>