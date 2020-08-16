<?php 
    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');
    require_once(DATABASE_PATH."DataSource.php");
    require_once(MODEL_PATH.'usuario.php');
    class usuarioDao{
        
        public static function registrarUsuario(usuario $usuario){
            $data_source = new DataSource();
            $sql ="INSERT INTO `wp60_users` VALUES  
            (null,:user_login,:user_pass,:user_nicename,:user_email,
            :user_url,:user_registered,:user_activation_key,:user_status,:display_name)";        
            $resultado = $data_source->ejecutarActualizacion($sql,array(
                ':user_login'=>$usuario->getUser(),
                ':user_pass'=>$usuario->getClave(),
                ':user_nicename'=>$usuario->getNicename(),
                ':user_email'=>$usuario->getEmail(),
                ':user_url'=>$usuario->getUrl(),
                ':user_registered'=>$usuario->getFecha(),
                ':user_activation_key'=>$usuario->getLlave(),
                ':user_status'=>$usuario->getStatus(),
                ':display_name'=>$usuario->getDisplay()
            ));   
            $respuesta = array('message' => "success" ,'result' =>  $resultado,"status"=>"");
            return  json_encode($respuesta);
        }

        public static function registrarUsuarioOnline($id,$nombre){
            $data_source = new DataSource();
            $sql ="INSERT INTO `wp60_useronline` VALUES  
            (curdate(),:user_type,:user_id,:user_name,:user_ip,:user_agent,:page_title,:page_url,:referral)";        
            $resultado = $data_source->ejecutarActualizacion($sql,array(
                ':user_type'=>"members",
                ':user_id'=>$id,
                ':user_name'=>$nombre,
                ':user_ip'=>"",
                ':user_agent'=>"",
                ':page_title'=>"",
                ':page_url'=>"",
                ':referral'=>""
            ));   
            
            return  $resultado;
        }

        public static function usuarioOnlineId($id){
            $data_source = new DataSource();
            $sql ="SELECT user_id FROM `wp60_useronline` WHERE user_id=$id";        
            $resultado = $data_source->ejecutarConsulta($sql);   
            
            return  $resultado;
        }

        public static function cerrarSesionActiva($id){
            $data_source = new DataSource();
            $sql ="DELETE FROM `wp60_useronline` WHERE user_id=$id";        
            $resultado = $data_source->ejecutarActualizacion($sql);   
            
            return  $resultado;
        }

        public static function cambiarClave($id,$clave){
            $data_source = new DataSource();
            $sql= "UPDATE `wp60_users` SET user_pass='$clave' WHERE ID='$id'";
            $resultado = $data_source->ejecutarActualizacion($sql);

            if($resultado){
                $respuesta = array('message' => "Clave cambiada correctamente" ,'result' => "","status"=>"1");
                return  json_encode($respuesta);
            }else{
                return false;
            }
            
        }

        public static function validarUsuario($usuario,$password){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT * FROM `wp60_users` 
            WHERE user_login='".$usuario."' AND user_pass='".$password."'");        
            if(count($data_table)>0){
                $objUsuario = new usuario(
                    $data_table[0]['ID'],
                    $data_table[0]['user_login'],
                    $data_table[0]['user_pass'],
                    $data_table[0]['user_nicename'],
                    $data_table[0]['user_email'],
                    $data_table[0]['user_url'],
                    $data_table[0]['user_registered'],
                    $data_table[0]['user_activation_key'],
                    $data_table[0]['user_status'],
                    $data_table[0]['display_name']
                );
                $respuesta = array('msn' => "success" ,'usuario' =>  $objUsuario);
                return  json_encode($respuesta);
            }else{
                return false;
            }
        }
        public static function usuarioIdUser($user){
            
        $data_source = new DataSource();
        $data_table = $data_source->ejecutarConsulta("SELECT * FROM `wp60_users` WHERE user_login = '".$user."'");
        
            if(count($data_table)>0){
                $objUsuario = array(
                    'ID'=>$data_table[0]['ID'],
                    'user_login'=>$data_table[0]['user_login'],
                    'user_pass'=>$data_table[0]['user_pass'],
                    'user_nicename'=>$data_table[0]['user_nicename'],
                    'user_email'=>$data_table[0]['user_email'],
                    'user_url'=>$data_table[0]['user_url'],
                    'user_registered'=>$data_table[0]['user_registered'],
                    'user_activation_key'=>$data_table[0]['user_activation_key'],
                    'user_status'=>$data_table[0]['user_status'],
                    'display_name'=>$data_table[0]['display_name']
                );
                return  $objUsuario;
            }else{
                return false;
            }
        }
        public static function usuarioId($ID){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta(
                "SELECT * FROM `wp60_users` WHERE ID = $ID");
                if(count($data_table)>0){
                    $objUsuario = array(
                        'ID'=>$data_table[0]['ID'],
                        'user_login'=>$data_table[0]['user_login'],
                        'user_pass'=>$data_table[0]['user_pass'],
                        'user_nicename'=>$data_table[0]['user_nicename'],
                        'user_email'=>$data_table[0]['user_email'],
                        'user_url'=>$data_table[0]['user_url'],
                        'user_registered'=>$data_table[0]['user_registered'],
                        'user_activation_key'=>$data_table[0]['user_activation_key'],
                        'user_status'=>$data_table[0]['user_status'],
                        'display_name'=>$data_table[0]['display_name']
                    );
                    return  $objUsuario;
                }else{
                    return false;
                }
            }
        public static function ultimoIdUsuario(){
            $data_source = new DataSource();
            $sql = "SELECT ID FROM wp60_users ORDER BY ID DESC LIMIT 1";
            $resultado = $data_source->ejecutarConsulta($sql);
            return $resultado[0]['ID'];
        }

        public static function cantidadUsuarios(){
            $data_source = new DataSource();
            $sql = "SELECT count(*) FROM wp60_users";
            $resultado = $data_source->ejecutarConsulta($sql);
            
            return $resultado;
        }

        public static function listarUsuarioNombre($nombre){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT * FROM `wp60_users` WHERE display_name LIKE :nombre",
            array(":nombre"=>"%".$nombre."%"));
            if(count($data_table)>0){
                $arrayUser=array();
                foreach ($data_table as $clave => $valor) { 
                    $objUsuario = array(
                        $data_table[$clave]['ID'],
                        $data_table[$clave]['user_login'],
                        $data_table[$clave]['user_pass'],
                        $data_table[$clave]['user_nicename'],
                        $data_table[$clave]['user_email'],
                        $data_table[$clave]['user_url'],
                        $data_table[$clave]['user_registered'],
                        $data_table[$clave]['user_activation_key'],
                        $data_table[$clave]['user_status'],
                        $data_table[$clave]['display_name']
                    );
                    array_push($arrayUser,$objUsuario);
                }
                return $arrayUser;
            }else{
                return false;
            }
        }

        public static function listarUsuarioNombreCategoria($nombre,$actividades){
            $data_source = new DataSource();
            $sql = "SELECT * FROM `wp60_bp_xprofile_data` d";
            if(!empty($nombre)){
                $sql.=" JOIN `wp60_users` u ON  d.user_id=u.id
                WHERE u.display_name LIKE '%".$nombre."%' AND d.value LIKE '%".$actividades."%' 
                OR d.value LIKE 'a:%'";
            }

            if(empty($nombre) && !empty($actividades)){
                $sql.=" JOIN `wp60_users` u ON  d.user_id=u.id WHERE d.value LIKE '%".$actividades."%' AND value LIKE 'a:%'";
            }

            $data_table=$data_source->ejecutarConsulta($sql);
            if(count($data_table)>0){
                $arrayUser=array();
                foreach ($data_table as $clave => $valor) { 
                    $objUsuario = array(
                        $data_table[$clave]['ID'],
                        $data_table[$clave]['user_login'],
                        $data_table[$clave]['user_pass'],
                        $data_table[$clave]['user_nicename'],
                        $data_table[$clave]['user_email'],
                        $data_table[$clave]['user_registered'],
                        $data_table[$clave]['display_name'],
                        $data_table[$clave]['value']
                    );
                    array_push($arrayUser,$objUsuario);
                }
                return $arrayUser;
            }else{
                return false;
            }
        }
        public static function listarUsuarioNuevo(){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT * FROM `wp60_users`
             WHERE DATEDIFF(curdate(),user_registered)<=15");
            if(count($data_table)>0){
                $arrayUser=array();
                foreach ($data_table as $clave => $valor) { 
                    $objUsuario = array(
                        $data_table[$clave]['ID'],
                        $data_table[$clave]['user_login'],
                        $data_table[$clave]['user_pass'],
                        $data_table[$clave]['user_nicename'],
                        $data_table[$clave]['user_email'],
                        $data_table[$clave]['user_url'],
                        $data_table[$clave]['user_registered'],
                        $data_table[$clave]['user_activation_key'],
                        $data_table[$clave]['user_status'],
                        $data_table[$clave]['display_name']
                    );
                    array_push($arrayUser,$objUsuario);
                }
                return $arrayUser;
            }else{
                return false;
            }
        }

        public static function listarUsuarioReciente(){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta(
                "SELECT * FROM `wp60_users` u JOIN `wp60_bp_activity` a ON u.ID=a.user_id 
                WHERE DATEDIFF(curdate(),a.date_recorded)<=30 ORDER BY a.date_recorded DESC");
                if(count($data_table)>0){
                    $arrayProfile = array();
                    foreach($data_table as $clave=>$valor){
                        $objUsuario = array(
                            $data_table[$clave]['ID'],
                            $data_table[$clave]['user_login'],
                            $data_table[$clave]['user_pass'],
                            $data_table[$clave]['user_nicename'],
                            $data_table[$clave]['user_email'],
                            $data_table[$clave]['user_url'],
                            $data_table[$clave]['user_registered'],
                            $data_table[$clave]['user_activation_key'],
                            $data_table[$clave]['user_status'],
                            $data_table[$clave]['display_name']
                        );
                        array_push($arrayProfile,$objUsuario);
                    }
                    return  $arrayProfile;
                }else{
                    return false;
                }
            }

        public static function listarUsuariosActivos(){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT * FROM `wp60_users`");
            if(count($data_table)>0){
                $arrayUser=array();
                foreach ($data_table as $clave => $valor) { 
                    $objUsuario = array(
                        $data_table[$clave]['ID'],
                        $data_table[$clave]['user_login'],
                        $data_table[$clave]['user_pass'],
                        $data_table[$clave]['user_nicename'],
                        $data_table[$clave]['user_email'],
                        $data_table[$clave]['user_url'],
                        $data_table[$clave]['user_registered'],
                        $data_table[$clave]['user_activation_key'],
                        $data_table[$clave]['user_status'],
                        $data_table[$clave]['display_name']
                    );
                    array_push($arrayUser,$objUsuario);
                }
                return $arrayUser;
            }else{
                return false;
            }
        }
        
        public static function listarUsuariosActivosCantidad($cantidad){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT * FROM `wp60_users` LIMIT $cantidad");
            if(count($data_table)>0){
                $arrayUser=array();
                foreach ($data_table as $clave => $valor) { 
                    $objUsuario = array(
                        $data_table[$clave]['ID'],
                        $data_table[$clave]['user_login'],
                        $data_table[$clave]['user_pass'],
                        $data_table[$clave]['user_nicename'],
                        $data_table[$clave]['user_email'],
                        $data_table[$clave]['user_url'],
                        $data_table[$clave]['user_registered'],
                        $data_table[$clave]['user_activation_key'],
                        $data_table[$clave]['user_status'],
                        $data_table[$clave]['display_name']
                    );
                    array_push($arrayUser,$objUsuario);
                }
                return $arrayUser;
            }else{
                return false;
            }
        }

        public static function listarUsuariosConectados($id){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta(
                "SELECT user_id FROM `wp60_useronline` WHERE user_id<>$id");
                if(count($data_table)>0){
                    $arrayProfile = array();
                    foreach($data_table as $clave=>$valor){
                        $objProfile = array(
                            'user_id'=>$data_table[$clave]['user_id'],
                        );
                        array_push($arrayProfile,$objProfile);
                    }
                    return  $arrayProfile;
                }else{
                    return false;
                }
            }

        public static function editarUsuario($idUsuario,$email,$display){
            
            $data_source = new DataSource();
            $sql ="UPDATE `wp60_users` SET 
            user_email=:user_email,
            display_name=:display_name
            WHERE ID=:ID";        
            $resultado = $data_source->ejecutarActualizacion($sql,array(
                ":ID"=>$idUsuario,
                ":user_email"=>$email,
                ":display_name"=>$display
            ));   

            return $resultado;
        }
    }
    
?>