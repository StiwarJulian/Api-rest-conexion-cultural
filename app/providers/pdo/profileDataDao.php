<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');
require_once(DATABASE_PATH."DataSource.php");
require_once(MODEL_PATH.'profileData.php');
    
class profileDataDao{

        public static function registrarProfile($profile){
            
            $data_source = new DataSource();
            $sql = "INSERT INTO `wp60_bp_xprofile_data` VALUES (null,:field_id,:user_id,:value,:last_updated)";
            
            $resultado = $data_source->ejecutarActualizacion($sql,array(
                ':field_id'=>$profile->getField_id(),
                ':user_id'=>$profile->getUser_id(),
                ':value'=>$profile->getValue(),
                ':last_updated'=>$profile->getUpdated()
            ));
            return $resultado;
        }

        public static function profileId($ID){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta(
                "SELECT d.id,f.name,d.user_id,d.value,d.last_updated FROM `wp60_bp_xprofile_data` d 
                JOIN `wp60_bp_xprofile_fields` f 
                ON (d.field_id=f.id) WHERE d.user_id = $ID");
                if(count($data_table)>0){
                    $arrayProfile = array();
                    #var_dump($data_table);
                    foreach($data_table as $clave=>$valor){
                        $objProfile = array(
                            $data_table[$clave]['id'],
                            $data_table[$clave]['name'],
                            $data_table[$clave]['user_id'],
                            $data_table[$clave]['value'],
                            $data_table[$clave]['last_updated']
                        );
                        array_push($arrayProfile,$objProfile);
                    }
                    if(count($arrayProfile)==8){
                        return  $arrayProfile;
                    }elseif(count($arrayProfile)==7){
                        $arreglo = array('','','','','');
                        $arrayProfile[7]=$arreglo;
                        return $arrayProfile;
                    }else{
                        $arreglo = array('','','','','');
                        $arrayProfile[6]=$arreglo;
                        $arrayProfile[7]=$arreglo;
                        return $arrayProfile;
                    }
                }else{
                    return false;
                }
        }

        public static function listarUsuarioNombre($nombre){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta(
                "SELECT d.id,f.name,d.user_id,d.value,d.last_updated FROM `wp60_bp_xprofile_data` d JOIN `wp60_users` u
                ON d.user_id=u.ID
                JOIN `wp60_bp_xprofile_fields` f ON (d.field_id=f.id)
                    WHERE display_name LIKE :nombre",array(
                    ":nombre"=>"%".$nombre."%"
                ));
                if(count($data_table)>0){
                    $arrayProfile = array();
                    foreach($data_table as $clave=>$valor){
                        $objProfile = array(
                            $data_table[$clave]['id'],
                            $data_table[$clave]['name'],
                            $data_table[$clave]['user_id'],
                            $data_table[$clave]['value'],
                            $data_table[$clave]['last_updated']
                        );
                        array_push($arrayProfile,$objProfile);
                    }
                    return  $arrayProfile;
                }else{
                    return false;
                }
        }

        public static function listarUsuarioNuevo(){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta(
                "SELECT d.id,f.name,d.user_id,d.value,d.last_updated FROM `wp60_bp_xprofile_data` d JOIN `wp60_users` u ON d.user_id=u.ID
                JOIN `wp60_bp_xprofile_fields` f ON (d.field_id=f.id)
                WHERE DATEDIFF(curdate(),u.user_registered)<=15");
                if(count($data_table)>0){
                    $arrayProfile = array();
                    foreach($data_table as $clave=>$valor){
                        $objProfile = array(
                            $data_table[$clave]['id'],
                            $data_table[$clave]['name'],
                            $data_table[$clave]['user_id'],
                            $data_table[$clave]['value'],
                            $data_table[$clave]['last_updated']
                        );
                        array_push($arrayProfile,$objProfile);
                    }
                    return  $arrayProfile;
                }else{
                    return false;
                }
            }

            
                
        public static function listarUsuarioReciente(){
            $data_source = new DataSource();
            $data_table = $data_source->ejecutarConsulta(
                "SELECT p.id,f.name,p.user_id,p.value,p.last_updated FROM `wp60_bp_xprofile_data` p JOIN `wp60_bp_activity` a ON p.user_id=a.user_id 
                JOIN `wp60_bp_xprofile_fields` f ON (p.field_id=f.id)
                WHERE DATEDIFF(curdate(),a.date_recorded)<=30 ORDER BY a.date_recorded DESC");
                if(count($data_table)>0){
                    $arrayProfile = array();
                    foreach($data_table as $clave=>$valor){
                        $objProfile = array(
                            $data_table[$clave]['id'],
                            $data_table[$clave]['name'],
                            $data_table[$clave]['user_id'],
                            $data_table[$clave]['value'],
                            $data_table[$clave]['last_updated']
                        );
                        array_push($arrayProfile,$objProfile);
                    }
                    return  $arrayProfile;
                }else{
                    return false;
                }
            }

            public static function editarPerfil($id,$value){
            
                $data_source = new DataSource();
                $sql ="UPDATE `wp60_bp_xprofile_data` SET 
                value=:value
                WHERE id=:id";        
                $resultado = $data_source->ejecutarActualizacion($sql,array(
                    ":id"=>$id,
                    ":value"=>$value
                ));   
                return $resultado;
            }
    }
?>