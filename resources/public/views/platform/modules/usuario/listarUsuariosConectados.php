<?php 
    header("Access-Control-Allow-Origin: *");   
    header("Content-Type: application/json; charset=UTF-8");
    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'profileDataDao.php');
    require_once(MODEL_PATH.'profileData.php');
    require_once(MODEL_PATH.'usuario.php');

    if(isset($_POST['idUsuario'])){
        $id = $_POST['idUsuario'];

        if(!empty($id)){
            $objUsuario = usuarioDao::listarUsuariosConectados($id);
            if($objUsuario){
                $arrayProfile = array();
                foreach($objUsuario as $clave => $value){
                    $objProfile = usuarioDao::usuarioId($objUsuario[$clave]['user_id']);
                    if($objProfile){
                        array_push($arrayProfile,$objProfile);  
                    }
                }
                if(!empty($arrayProfile)){
                    $success = array("message"=>"Usuarios Conectados","result"=>$arrayProfile,"status"=>1);
                    echo json_encode($success);
                }else{
                    $failed = array("message"=>"No hay usuarios conectados","result"=>"","status"=>"0");
                    echo json_encode($failed);
                }
                
            }else{
                $failed = array("message"=>"No hay usuarios conectados","result"=>"","status"=>"0");
                echo json_encode($failed);
            }
        }else{
            $failed = array("message"=>"El identificador esta vacio","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
        
    }else{
        $failed = array("message"=>"no se han recibido los datos necesarios","result"=>"","status"=>"0");
        echo json_encode($failed);
    }
   

?>