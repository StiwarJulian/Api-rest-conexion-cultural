<?php 
    
    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');
    require_once(DATABASE_PATH."DataSource.php");
    require_once(MODEL_PATH.'userMeta.php');
    
    class userMetaDao{
        public static function registrar_userMeta($usermeta){
            $data_source = new DataSource();
            $sql = "INSERT INTO `wp60_usermeta` 
                    VALUES (null, :user_id, :meta_key,:meta_value)";
            $resultado = $data_source->ejecutarActualizacion($sql,array(
                ':user_id'=>$usermeta->getUser_id(),
                ':meta_key'=>$usermeta->getMeta_key(),
                ':meta_value'=>$usermeta->getMeta_value()
            ));   
            return $resultado;
        }
    }

?>