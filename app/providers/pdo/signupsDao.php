<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');
require_once(DATABASE_PATH."DataSource.php");
require_once(MODEL_PATH.'signups.php');
    class signupsDao{
        public static function registrarSignups($signups){
            
            $data_source = new DataSource();
            $sql = "INSERT INTO `wp60_signups` VALUES (null,:domain,:path,:title,:user_login,:user_email,
                                                        :registered, :activated,:active,:activation_key,:meta)";
            
            $resultado = $data_source->ejecutarActualizacion($sql,array(
                ':domain'=>$signups->getDomain(),
                ':path'=>$signups->getPath(),
                ':title'=>$signups->getTitle(),
                ':user_login'=>$signups->getUsuario(),
                ':user_email'=>$signups->getEmail(),
                ':registered'=>$signups->getFechaRegistro(),
                ':activated'=>$signups->getFechaActivacion(),
                ':active'=>$signups->getActive(),
                ':activation_key'=>$signups->getActivation_key(),
                
                ':meta'=>$signups->getMeta()
            ));
            return $resultado;
        }
    }
?>