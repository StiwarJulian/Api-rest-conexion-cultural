<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');
require_once(DATABASE_PATH."DataSource.php");
require_once(MODEL_PATH.'media.php');

    
    
    class mediaDao{

        public static function listarMultimediaLineaTiempo($id){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_title,p.guid ,m.media_type,m.upload_date,m.media_author
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id ORDER BY `m`.`upload_date` DESC LIMIT 10");
            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            $data_table[$clave]['ID'],
                            $data_table[$clave]['post_title'],
                            $data_table[$clave]['guid'],
                            $data_table[$clave]['media_type'],
                            $data_table[$clave]['upload_date'],
                            $data_table[$clave]['media_author']
                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }

        public static function listarMultimediaLineaTiempoInicio(){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_title,p.guid ,m.media_type,
            m.upload_date,m.media_author FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON 
            p.ID=m.media_id WHERE MONTH(m.upload_date)=MONTH(NOW()) 
            ORDER BY `m`.`upload_date` DESC  LIMIT 10");
            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            $data_table[$clave]['ID'],
                            $data_table[$clave]['post_title'],
                            $data_table[$clave]['guid'],
                            $data_table[$clave]['media_type'],
                            $data_table[$clave]['upload_date'],
                            $data_table[$clave]['media_author']
                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }
        
        public static function registrarMedia(media $media){
            $data_source = new DataSource();
            $sql = "INSERT INTO `wp60_rt_rtm_media` VALUES 
                (null,'1',:media_id,:media_author,:media_title,:album_id,
                :media_type,:context,:context_id,null,null,null,null,
                '0','0','0','0','0','0.00','0','0',:upload_date,:file_size)";

            $resultado = $data_source->ejecutarActualizacion($sql,array(
                ':media_id'=>$media->getMedia_id(),
                ':media_author'=>$media->getAutor(),
                ':media_title'=>$media->getTitulo(),
                ':album_id'=>$media->getAlbum_id(),
                ':media_type'=>$media->getTipo(),
                ':context'=>$media->getContext(),
                ':context_id'=>$media->getContext_id(),
                ':upload_date'=>$media->getFecha(),
                ':file_size'=>$media->getSize()
            ));

            return $resultado;
        }


        public static function listarAlbum($id){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT m.id,m.media_id,m.media_title,p.post_title,p.guid 
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id AND m.media_type='album' ");

            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            'id'=>$data_table[$clave]['id'],
                            'media_id'=>$data_table[$clave]['media_id'],
                            'media_title'=>$data_table[$clave]['media_title'],
                            'post_title'=>$data_table[$clave]['post_title'],
                            'guid'=>$data_table[$clave]['guid']
                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }

        public static function consultarArchivoAlbum($id,$idalbum){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,m.album_id,p.post_title,p.guid,m.media_type
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id AND m.album_id=$idalbum AND m.media_type<>'album' LIMIT 1");

            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            'ID'=>$data_table[$clave]['ID'],
                            'album_id'=>$data_table[$clave]['album_id'],
                            'post_title'=>$data_table[$clave]['post_title'],
                            'guid'=>$data_table[$clave]['guid'],
                            'media_type'=>$data_table[$clave]['media_type']
                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }

        public static function listarArchivoAlbum($id,$idalbum){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,m.album_id,p.post_title,p.guid 
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id AND m.album_id=$idalbum ");

            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            $data_table[$clave]['ID'],
                            $data_table[$clave]['post_title'],
                            $data_table[$clave]['guid']
                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }

        public static function listarFotos($id,$cantidad){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_title,p.guid 
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id AND m.media_type='photo' LIMIT $cantidad");

            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            $data_table[$clave]['ID'],
                            $data_table[$clave]['post_title'],
                            $data_table[$clave]['guid']
                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }

        public static function cantidadFotos($id){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT count(*) 
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id AND m.media_type='photo' ");

            return $data_table;
        }

        public static function ultimoIdMedia(){
            $data_source = new DataSource();
            $sql = "SELECT id,media_title FROM `wp60_rt_rtm_media` ORDER BY id DESC LIMIT 1";
            $resultado = $data_source->ejecutarConsulta($sql);

            if(count($resultado)>0){
                $objMedia = array(
                    'id'=>$resultado[0]['id'],
                    'media_title'=>$resultado[0]['media_title']
                );
                return $objMedia;
            }else{
                return false;
            }
        }

        public static function cantidadVideos($id){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT count(*) 
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id AND m.media_type='video' ");

            return $data_table;
        }

        public static function cantidadMusica($id){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT count(*) 
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id AND m.media_type='music' ");

            return $data_table;
        }
        
        public static function cantidadLikes($id){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT likes FROM `wp60_rt_rtm_media` 
            WHERE media_id = $id");

            return $data_table[0]['likes'];
        }

        public static function modificarLikes($id,$likes){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarActualizacion("UPDATE `wp60_rt_rtm_media` SET
            likes=$likes WHERE media_id=$id");

            return $data_table;
        }

        public static function listarVideos($id,$cantidad){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_title,p.guid 
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id AND m.media_type='video' LIMIT $cantidad");

            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            $data_table[$clave]['ID'],
                            $data_table[$clave]['post_title'],
                            $data_table[$clave]['guid']
                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }


        public static function listarMusica($id,$cantidad){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_title,p.guid 
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id AND m.media_type='music' LIMIT $cantidad");

            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            $data_table[$clave]['ID'],
                            $data_table[$clave]['post_title'],
                            $data_table[$clave]['guid']
                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }

        public static function listarMedia($id){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_title,p.guid 
            FROM `wp60_posts` p JOIN `wp60_rt_rtm_media` m ON p.ID=m.media_id WHERE 
            m.media_author=$id AND m.media_type<>'album'");

            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            $data_table[$clave]['ID'],
                            $data_table[$clave]['post_title'],
                            $data_table[$clave]['guid']
                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }
        public static function informacionLugar($id){

            $direccion = '';
            $ciudad = '';
            $pais= '';

            $provincia=  '';
            $celular = '';
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_title,
                                p.guid,m.meta_key,m.meta_value
                                FROM `wp60_posts` p JOIN `wp60_postmeta` m ON p.ID=m.post_id
                                WHERE p.ID=$id");

            if(count($data_table)>0){
                $arrayLugar = array();
                foreach($data_table as $clave=>$valor){
                    switch($data_table[$clave]['meta_key']){
                        case '_VenueAddress':
                            $direccion = $data_table[$clave]['meta_value'];
                            break;
                        
                        case '_VenueCity':
                            $ciudad = $data_table[$clave]['meta_value'];
                            break;

                        case '_VenueCountry':
                            $pais = $data_table[$clave]['meta_value'];
                            break;

                        case '_VenueProvince':
                            $provincia = $data_table[$clave]['meta_value'];
                            break;

                        case '_VenuePhone':
                            $celular = $data_table[$clave]['meta_value'];
                            break;
                    }
                }

                $objMedia = array(
                    $data_table[$clave]['ID'],
                    $data_table[$clave]['post_title'],
                    $data_table[$clave]['guid'],
                    $direccion,
                    $ciudad,
                    $pais,
                    $provincia,
                    $celular
                );
                return $objMedia ;
            }else{
                return false;
            }
        }

        public static function informacionOrganizador($id){

            $email = '';
            $web = '';
            $pais= '';

            $provincia=  '';
            $celular = '';
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_title,
                                p.guid,m.meta_key,m.meta_value
                                FROM `wp60_posts` p JOIN `wp60_postmeta` m ON p.ID=m.post_id
                                WHERE p.ID=$id");

            if(count($data_table)>0){
                $arrayLugar = array();
                foreach($data_table as $clave=>$valor){
                    switch($data_table[$clave]['meta_key']){
                        case '_OrganizerEmail':
                            $email = $data_table[$clave]['meta_value'];
                            break;
                        
                        case '_OrganizerWebsite':
                            $web = $data_table[$clave]['meta_value'];
                            break;

                        case '_OrganizerPhone':
                            $celular = $data_table[$clave]['meta_value'];
                            break;
                    }
                }

                $objMedia = array(
                    $data_table[$clave]['ID'],
                    $data_table[$clave]['post_title'],
                    $data_table[$clave]['guid'],
                    $email,
                    $web,
                    $celular
                );
                return $objMedia ;
            }else{
                return false;
            }
        }

        public static function opcionesEventos($id){
            $startDate = '';
            $endEvent = '';
            $durationEvent = '';
            $eventCost = '';
            $eventUrl = '';
            $id_lugar = '';
            $id_organizador = '';
            $lugar = '';
            $organizador = '';
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT m.meta_key,m.meta_value
            FROM `wp60_postmeta` m 
            WHERE m.post_id=$id");

            if(count($data_table)>0){
                $arrayOpciones= array();
                foreach ($data_table as $clave => $value) {
                    switch($data_table[$clave]['meta_key']){
                        case '_EventVenueID':
                            $id_lugar = $data_table[$clave]['meta_value'];
                            $lugar = mediaDao::informacionLugar($id_lugar);
                            
                        break;
                        case '_EventOrganizerID':
                            $id_organizador = $data_table[$clave]['meta_value'];
                            $organizador = mediaDao::informacionOrganizador($id_organizador);
                            
                        break;
                        case '_EventStartDate':
                            $startDate = $data_table[$clave]['meta_value'];
                        break;
                        case '_EventEndDate';
                            $endEvent = $data_table[$clave]['meta_value'];
                        break;
                        case '_EventDuration';
                            $tiempo = $data_table[$clave]['meta_value'];
                            $durationEvent = ($tiempo/60)/60;
                        break;
                        case '_EventCost';
                            $eventCost = $data_table[$clave]['meta_value'];
                        break;
                        case '_EventURL';
                            $eventUrl = $data_table[$clave]['meta_value'];
                        break;
                    }
                }

                $objOpcion = array(
                    $startDate,
                    $endEvent,
                    $durationEvent,
                    $eventCost,
                    $eventUrl,
                    $lugar,
                    $organizador
                );

                return $objOpcion;
            }
        }
        public static function listarEventos(){

            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_content,p.post_title,
            p.guid,p.post_modified FROM  `wp60_posts` p
            WHERE p.post_type='tribe_events' LIMIT 10");
            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $foto=mediaDao::consultarFotoEvento($data_table[$clave]['ID']);
                        $opcion = mediaDao::opcionesEventos($data_table[$clave]['ID']);
                   
                    $objMedia = array(
                        $data_table[$clave]['ID'],
                        $data_table[$clave]['post_content'],
                        $data_table[$clave]['post_title'],
                        $data_table[$clave]['guid'],
                        $data_table[$clave]['post_modified'],
                        $foto,
                        $opcion
                    );
                    array_push($arrayMedia, $objMedia );
                }
                return $arrayMedia;
            }else{
                return false;
            }
        }
        
        public static function listarNoticias(){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_content,p.post_title,
            p.post_name,p.guid,m.meta_key,m.meta_value,p.post_modified
            FROM `wp60_posts` p JOIN `wp60_postmeta` m ON p.ID=m.post_id
             WHERE p.post_type='post' GROUP BY p.ID LIMIT 10");
            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $foto = mediaDao::consultarFotoEvento($data_table[$clave]['ID']);
                        $comentarios = mediaDao::listarComentariosNoticias($data_table[$clave]['ID']);
                        $objMedia = array(
                            $data_table[$clave]['ID'],
                            $data_table[$clave]['post_content'],
                            $data_table[$clave]['post_title'],
                            $data_table[$clave]['post_name'],
                            $data_table[$clave]['guid'],
                            $data_table[$clave]['post_modified'],
                            $foto,
                            $comentarios
                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }

        public static function listarComentariosNoticias($id){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta("SELECT comment_author,comment_author_email,comment_author_url,
            comment_date,comment_content ,user_id 
            FROM `wp60_comments` 
             WHERE comment_post_ID=$id");
            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            $data_table[$clave]['comment_author'],
                            $data_table[$clave]['comment_author_email'],
                            $data_table[$clave]['comment_author_url'],
                            $data_table[$clave]['comment_date'],
                            $data_table[$clave]['comment_content'],
                            $data_table[$clave]['user_id']

                        );
                        array_push($arrayMedia,$objMedia);
                    }
                    return $arrayMedia;
            }else{
                return false;
            }
        }

        public static function consultarFotoEvento($id){
            $data_source = new DataSource();
            
            $data_table = $data_source->ejecutarConsulta("SELECT p.ID,p.post_title,
            p.post_name,p.guid FROM `wp60_posts` p WHERE p.post_parent=$id AND p.post_mime_type='image/jpeg'
            OR p.post_parent=$id AND p.post_mime_type='image/png' OR 
            p.post_parent=$id AND p.post_mime_type='video/mp4' OR
            p.post_parent=$id AND p.post_mime_type='audio/mpeg'" );

            if(count($data_table)>0){
                $arrayMedia = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objMedia = array(
                            $data_table[$clave]['ID'],
                            $data_table[$clave]['post_title'],
                            $data_table[$clave]['post_name'],
                            $data_table[$clave]['guid']
                        );
                    }
                    return $objMedia;
            }else{
                return false;
            }
        }

        public static function consultarIdAlbum($idalbum){
            $data_source = new DataSource();

            $data_table = $data_source->ejecutarConsulta("SELECT * FROM wp60_rt_rtm_media WHERE id = $idalbum");

            return $data_table[0]['media_id'];
        }

        public static function registrarActivity($user_id,$component,$type,$action,$content,$link,$item_id,$date){
            $data_source = new DataSource();

            $sql = "INSERT INTO wp60_bp_activity VALUES(null,:user_id,:component,:type,:action,:content,
            :primary_link,:item_id,'NULL',:date_recorded,0,0,0,0)";

            $resultado = $data_source->ejecutarActualizacion($sql,array(
                ':user_id'=>$user_id,
                ':component'=>$component,
                ':type'=>$type,
                ':action'=>$action,
                ':content'=>$content,
                ':primary_link'=>$link,
                ':item_id'=>$item_id,
                ':date_recorded'=>$date
            ));

            return $resultado;
        }
    }
?>