<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');
require_once(DATABASE_PATH."DataSource.php");
require_once(MODEL_PATH.'comentarios.php');


    class comentariosDao{

        public static function comentariosId($id){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta(
                "SELECT comment_ID,comment_author, comment_date,comment_content,user_id FROM wp60_comments 
                WHERE comment_post_ID=$id");

                if(count($data_table)>0){
                    $arrayComentario = array();
                    foreach ($data_table as $clave => $value) {
                        $objComentario = array(
                            $data_table[$clave]['comment_ID'],
                            $data_table[$clave]['comment_author'],
                            $data_table[$clave]['comment_content'],
                            $data_table[$clave]['comment_date']
                        );
                        array_push($arrayComentario,$objComentario);
                    }
                    return $arrayComentario;
                }else{
                    return false;
                }
        }

        public static function registrarComentario($comentario){
            $data_source = new DataSource();

            $sql = "INSERT INTO wp60_comments VALUES(
                null,:comment_post_ID,:comment_author,:comment_author_email,'','',:comment_date,
                :comment_date_gmt,:comment_content,'0','1','','',:comment_parent,:user_id)";

                $resultado = $data_source->ejecutarActualizacion($sql,array(
                    ':comment_post_ID'=>$comentario->getPost_id(),
                    ':comment_author'=>$comentario->getAutor(),
                    ':comment_author_email'=>$comentario->getEmail(),
                    ':comment_date'=>$comentario->getFecha(),
                    ':comment_date_gmt'=>$comentario->getFecha(),
                    ':comment_content'=>$comentario->getContenido(),
                    ':comment_parent'=>$comentario->getParent(),
                    ':user_id'=>$comentario->getUser_id()
                ));

            return $resultado;
        }

        public static function borrarComentario($id,$idUser){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("DELETE FROM wp60_comments 
            WHERE comment_ID=$id AND user_id=$idUser");
            
            return $data_table;
        }

    }
?>