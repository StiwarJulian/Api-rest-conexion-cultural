<?php 

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');
    require_once(DATABASE_PATH."DataSource.php");
    require_once(MODEL_PATH.'mensajes.php');
    require_once(MODEL_PATH.'mensajesRecipientes.php');
    require_once(PDO_PATH.'mensajesDao.php');

    class mensajesDao{

    
    public static function listarMensajesUsuario($id){
        $data_source = new DataSource();
        $data_table = $data_source->ejecutarConsulta("SELECT m.* FROM `wp60_bp_messages_messages` m 
        WHERE m.sender_id=$id AND m.subject NOT LIKE 'RE:%' GROUP BY m.thread_id");
        if(count($data_table)>0){
            $arrayNoticias=array();
            foreach ($data_table as $clave => $valor) { 
                 
                $iduser = $data_table[$clave]['sender_id'];
                $idthread = $data_table[$clave]['thread_id'];

                $sql = "SELECT * FROM `wp60_bp_messages_recipients` r 
                WHERE r.user_id= $iduser
                AND r.thread_id= $idthread";

                $data_table2 = $data_source->ejecutarConsulta($sql);
                foreach($data_table2 as $key => $value){

                    if($data_table2[$key]['is_deleted'] == "0"){
                        $thread_id = $data_table2[$key]['thread_id'];
                        $data_table3 = $data_source->ejecutarConsulta("SELECT u.user_nicename FROM 
                        wp60_bp_messages_recipients r JOIN wp60_users u ON r.user_id=u.ID WHERE r.thread_id=$thread_id ");


                        foreach($data_table3 as $keys =>$val){

                            $objNoticias = array(
                                $data_table[$clave]['thread_id'],
                                $data_table[$clave]['sender_id'],
                                $data_table[$clave]['subject'],
                                $data_table[$clave]['date_sent'],
                                $data_table3[$keys]['user_nicename']
                            );
                            array_push($arrayNoticias,$objNoticias);
                        }
                    }
                }
            }
            return $arrayNoticias;
            
        }else{
            return false;
        }
    }

    public static function mensajesEnviados($thread){
        $data_source = new DataSource();
        $data_table = $data_source->ejecutarConsulta("SELECT m.*,u.user_nicename FROM `wp60_bp_messages_messages` m JOIN 
        wp60_users u ON m.sender_id=u.ID
        WHERE m.thread_id=$thread");
        if(count($data_table)>0){
            $arrayNoticias=array();
            foreach ($data_table as $clave => $valor) { 
                $objNoticias = array(
                    $data_table[$clave]['thread_id'],
                    $data_table[$clave]['sender_id'],
                    $data_table[$clave]['subject'],
                    $data_table[$clave]['message'],
                    $data_table[$clave]['date_sent'],
                    $data_table[$clave]['user_nicename']
                );
                array_push($arrayNoticias,$objNoticias);
            }
            return $arrayNoticias;
        }else{
            return false;
        }
    }

    public static function mensajesId($idUsuario){
        $data_source = new DataSource();

        $data_table = $data_source->ejecutarConsulta("SELECT r.thread_id FROM wp60_bp_messages_recipients r 
        JOIN wp60_bp_messages_messages m ON r.thread_id = m.thread_id WHERE r.user_id=$idUsuario GROUP BY r.thread_id");

        if(count($data_table)>0){
            $arrayMensajes = array();
            $resultado='';
                foreach ($data_table as $clave => $value) {
                    $objMensajes = array(
                        $resultado=mensajesDao::bandejaEntrada($data_table[$clave]['thread_id'])
                    );
                    array_push($arrayMensajes,$objMensajes);
                }
            return $arrayMensajes;
        }else{
            return false;
        }
    }

    public static function bandejaEntrada($thread_id){
        $data_source = new DataSource();
        $data_table = $data_source->ejecutarConsulta("SELECT m.*,r.user_id,u.user_nicename FROM `wp60_bp_messages_messages` m JOIN `wp60_bp_messages_recipients` r 
        ON m.thread_id=r.thread_id JOIN `wp60_users` u ON m.sender_id=u.ID WHERE r.thread_id=$thread_id GROUP BY thread_id");
        if(count($data_table)>0){
            $arrayNoticias=array();
            foreach ($data_table as $clave => $valor) { 
                $objNoticias = array(
                    $data_table[$clave]['thread_id'],
                    $data_table[$clave]['sender_id'],
                    $data_table[$clave]['subject'],
                    $data_table[$clave]['message'],
                    $data_table[$clave]['date_sent'],
                    $data_table[$clave]['user_id'],
                    $data_table[$clave]['user_nicename']
                );
                return $objNoticias;
            }
        }else{
            return false;
        }
    }

    public static function mensajeIdThread(){
        $data_source = new DataSource();
        $sql = "SELECT MAX(thread_id) FROM `wp60_bp_messages_messages`";
        $resultado = $data_source->ejecutarConsulta($sql);
        return $resultado[0]['MAX(thread_id)'];
    }

    public static function registrarMensajeNuevo($mensajes){
        $data_source = new DataSource();
        $sql ="INSERT INTO `wp60_bp_messages_messages` VALUES  
        (null,:thread_id,:sender_id,:subject,:message,
        :date_sent)";        
        $resultado = $data_source->ejecutarActualizacion($sql,array(
            ':thread_id'=>$mensajes->getThread_id(),
            ':sender_id'=>$mensajes->getSender_id(),
            ':subject'=>$mensajes->getSubject(),
            ':message'=>$mensajes->getMessage(),
            ':date_sent'=>$mensajes->getDate_sent()
        ));   
        $respuesta = array('message' => "success" ,'result' =>  $resultado,"status"=>"");
        return  json_encode($respuesta);
    }

    public static function registrarRecipiente($recipiente){
        $data_source = new DataSource();
        $sql ="INSERT INTO `wp60_bp_messages_recipients` VALUES  
        (null,:user_id,:thread_id,:unread_count,:sender_only,'0')";        
        $resultado = $data_source->ejecutarActualizacion($sql,array(
            ':user_id'=>$recipiente->getUser_id(),
            ':thread_id'=>$recipiente->getThread_id(),
            ':unread_count'=>$recipiente->getUnread(),
            ':sender_only'=>$recipiente->getSender()
        ));   
        $respuesta = array('message' => "success" ,'result' =>  $resultado,"status"=>"");
        return  json_encode($respuesta);
    }
}