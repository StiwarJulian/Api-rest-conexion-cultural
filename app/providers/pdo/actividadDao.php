<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');
require_once(DATABASE_PATH."DataSource.php");
require_once(MODEL_PATH.'actividad.php');

    class actividadDao{

        public static function registrarPostMeta($post_id,$meta_key,$meta_value){
            $data_source = new DataSource();

            $sql = "INSERT INTO wp60_postmeta VALUES(null,:post_id,:meta_key,:meta_value)";

            $resultado = $data_source->ejecutarActualizacion($sql,array(
                ':post_id'=>$post_id,
                ':meta_key'=>$meta_key,
                ':meta_value'=>$meta_value
            ));

            return $resultado;
        }

        public static function registrarActividad(actividad $actividad){

            $data_source = new DataSource();
            $sql = "INSERT INTO `wp60_posts` VALUES (
                null,:post_author,:post_date,:post_date_gmt,:post_content,:post_title,
                '','inherit','open','closed','',:post_name,'','',:post_modified,:post_modified_gmt,
                '',:post_parent,:guid,'0',:post_type,:post_mime_type,'0')";

            $resultado = $data_source->ejecutarActualizacion($sql,array(
                ':post_author'=>$actividad->getAuthor(),
                ':post_date'=>$actividad->getFecha(),
                ':post_date_gmt'=>$actividad->getFecha(),
                ':post_content'=>$actividad->getContent(),
                ':post_title'=>$actividad->getTitle(),
                ':post_name'=>$actividad->getTitle(),
                ':post_modified'=>$actividad->getFecha(),
                ':post_modified_gmt'=>$actividad->getFecha(),
                ':post_parent'=>$actividad->getParent(),
                ':guid'=>$actividad->getGuid(),
                ':post_type'=>$actividad->getPost_type(),
                ':post_mime_type'=>$actividad->getTipo()
            ));
            
            return $resultado;
        }


        public static function ultimoIdActividad(){
            $data_source = new DataSource();
            $sql = "SELECT ID FROM `wp60_posts` ORDER BY ID DESC LIMIT 1";
            $resultado = $data_source->ejecutarConsulta($sql);
            return $resultado[0]['ID'];
        }

        public static function listarNoticiasAdministrador(){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT * FROM `wp60_bp_messages_notices`
            WHERE is_active = 1");
            if(count($data_table)>0){
                $arrayNoticias=array();
                foreach ($data_table as $clave => $valor) { 
                    $objNoticias = array(
                        $data_table[$clave]['id'],
                        $data_table[$clave]['subject'],
                        $data_table[$clave]['message'],
                        $data_table[$clave]['date_sent']
                    );
                    array_push($arrayNoticias,$objNoticias);
                }
                return $arrayNoticias;
            }else{
                return false;
            }
        }    
    }

?>