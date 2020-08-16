<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'profileDataDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(MODEL_PATH.'profileData.php');

    if((isset($_POST['nombreUsuario'])) && 
    (isset($_POST['ciudadUsuario'])) && 
    (isset($_POST['correoUsuario'])) && 
    (isset($_POST['idCategoriaUsuario'])) && 
    (isset($_POST['idServicio'])) &&
    (isset($_POST['idUsuario'])) &&
    (isset($_POST['idciudadUsuario'])) && 
    (isset($_POST['idnombreUsuario'])) && 
    (isset($_POST['idpaisOrigen'])) && 
    (isset($_POST['idresenaUsuario'])) && 
    (isset($_POST['telefonoUsuario'])) && 
    (isset($_POST['idtelefonoUsuario'])) && 
    (isset($_POST['paisOrigen'])) && 
    (isset($_POST['resenaUsuario'])) && 
    (isset($_POST['servicios'])) && 
    (isset($_POST['categoriaUsuario']))){

        $nombre= $_POST['nombreUsuario'];
        $idNombre = $_POST['idnombreUsuario'];

        $telefono = $_POST['telefonoUsuario'];
        $idTelefono = $_POST['idtelefonoUsuario'];
        
        $pais = $_POST['paisOrigen'];
        $idPais= $_POST['idpaisOrigen'];

        $ciudad = $_POST['ciudadUsuario'];
        $idCiudad = $_POST['idciudadUsuario'];

        $resena= $_POST['resenaUsuario'];
        $idResena=$_POST['idresenaUsuario'];

        $idServicios = $_POST['idServicio'];
        $servicios = $_POST['servicios'];

        #$idOpcion = $_POST['idOpcion'];
        #$opcion = $_POST['opcion'];

        $idCategoria = $_POST['idCategoriaUsuario'];
        $categoria = $_POST['categoriaUsuario'];

        $correo = $_POST['correoUsuario'];

        $idUsuario = $_POST['idUsuario'];

        if(!empty($idUsuario)){
            $objProfile = profileDataDao::profileId($idUsuario);
            if($objProfile){
                if(!empty($objProfile[7][0])){
                    $objUsuario = usuarioDao::editarUsuario($idUsuario,$correo,$nombre);

                        /*$seleccion = explode(",",$opcion);
                        $actividad="";
                            $actividades="";
                            for ($i=0; $i <=6 ; $i++) { 
                                
                                if(isset($seleccion[$i])){
                                    $actividades .= "i:$i;s:".strlen($seleccion[$i]).":'$seleccion[$i]';";
                                    if($seleccion[$i]==0){
                                        $actividad="a:$i:{";
                                        $actividad.=$actividades;
                                    }
                                }
                            }
                        $actividad.='}';
                        */
                        $objProfile = profileDataDao::editarPerfil($idNombre,$nombre);
                        $insertProfile=profileDataDao::editarPerfil($idTelefono,$telefono);
                        $insertProfile=profileDataDao::editarPerfil($idPais,$pais);
                        $insertProfile=profileDataDao::editarPerfil($idCiudad,$ciudad);
                        $insertProfile4=profileDataDao::editarPerfil($idCategoria,$categoria);
                        //$insertProfile5=profileDataDao::editarPerfil($idOpcion,$actividad);

                        $insertProfile6=profileDataDao::editarPerfil($idResena,$resena);
                        $insertProfile7=profileDataDao::editarPerfil($idServicios,$servicios);
                        $success = array("message"=>"Usuario modificado","result"=>"","status"=>"1");
                        echo json_encode($success);

                }else if(!empty($objProfile[6][0])){
                    
                    $objUsuario = usuarioDao::editarUsuario($idUsuario,$correo,$nombre);
                    
                        $fechaRegistro =  date('Y-m-d H:i:s');

                            /* $seleccion = explode(",",$opcion);
                            $actividad="";
                                $actividades="";
                                for ($i=0; $i <=6 ; $i++) { 
                                    
                                    if(isset($seleccion[$i])){
                                        $actividades .= "i:$i;s:".strlen($seleccion[$i]).":'$seleccion[$i]';";
                                        if($seleccion[$i]==0){
                                            $actividad="a:$i:{";
                                            $actividad.=$actividades;
                                        }
                                    }
                                }
                            $actividad.='}';
                            */
                            $objProfile = profileDataDao::editarPerfil($idNombre,$nombre);
                            $insertProfile=profileDataDao::editarPerfil($idTelefono,$telefono);
                            $insertProfile=profileDataDao::editarPerfil($idPais,$pais);
                            $insertProfile=profileDataDao::editarPerfil($idCiudad,$ciudad);
                            $insertProfile4=profileDataDao::editarPerfil($idCategoria,$categoria);
                            //$insertProfile5=profileDataDao::editarPerfil($idOpcion,$actividad);
                            $insertProfile6=profileDataDao::editarPerfil($idResena,$resena);

                            if(empty($objProfile[7][0])){
                                $profile7 = new profileData(null,422,$idUsuario,$servicios,$fechaRegistro);
                                $insertProfile2  = profileDataDao::registrarProfile($profile7);
                            }else{
                                $insertProfile7=profileDataDao::editarPerfil($idServicios, $servicios);
                            }

                            $success = array("message"=>"Usuario modificado","result"=>"","status"=>"1");
                            echo json_encode($success);
                }else{
                    $objUsuario = usuarioDao::editarUsuario($idUsuario,$correo,$nombre);
                    
                        $fechaRegistro =  date('Y-m-d H:i:s');

                            /* $seleccion = explode(",",$opcion);
                            $actividad="";
                                $actividades="";
                                for ($i=0; $i <=6 ; $i++) { 
                                    
                                    if(isset($seleccion[$i])){
                                        $actividades .= "i:$i;s:".strlen($seleccion[$i]).":'$seleccion[$i]';";
                                        if($seleccion[$i]==0){
                                            $actividad="a:$i:{";
                                            $actividad.=$actividades;
                                        }
                                    }
                                }
                            $actividad.='}';
                            */
                            $objProfile = profileDataDao::editarPerfil($idNombre,$nombre);
                            $insertProfile=profileDataDao::editarPerfil($idTelefono,$telefono);
                            $insertProfile=profileDataDao::editarPerfil($idPais,$pais);
                            $insertProfile=profileDataDao::editarPerfil($idCiudad,$ciudad);
                            $insertProfile4=profileDataDao::editarPerfil($idCategoria,$categoria);
                            #$insertProfile5=profileDataDao::editarPerfil($idOpcion,$actividad);
                            $profile6 = new profileData(null,402,$idUsuario,$resena,$fechaRegistro);
                            $insertProfile = profileDataDao::registrarProfile($profile6);
                            $profile7 = new profileData(null,422,$idUsuario,$servicios,$fechaRegistro);
                            $insertProfile2  = profileDataDao::registrarProfile($profile7);
                            $success = array("message"=>"Usuario modificado","result"=>"","status"=>"1");
                            echo json_encode($success);
                }
            }else{
                $failed=array("message"=>"El identificador no pertenece a ningun usuario","result"=>"","status"=>"0");
                echo json_encode($failed);
            }

        }else{
            $failed=array("message"=>"El identificador del usuario no ha llegado","result"=>"","status"=>"0");
            echo json_encode($failed);
        }
        

    }else{
        $failed = array("message"=>"No llegaron los campos necesarios","result"=>"","status"=>"0");
        echo json_encode($failed);
    }

?>