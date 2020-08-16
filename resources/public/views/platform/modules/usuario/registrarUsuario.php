<?php 

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    date_default_timezone_set('America/Bogota');

    include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once(PDO_PATH.'userMetaDao.php');
    require_once(PDO_PATH.'signupsDao.php');
    require_once(PDO_PATH.'profileDataDao.php');
    require_once(MODEL_PATH.'usuario.php');
    require_once(MODEL_PATH.'userMeta.php');
    require_once(MODEL_PATH.'signups.php');
    require_once(MODEL_PATH.'profileData.php');

    require_once(LIB_PATH.'wordpress/class-phpass.php');
    require_once(LIB_PATH.'wordpress/formatting.php');

    if(isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['claveVerify'])
    && isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['telefono'])
    && isset($_POST['nacionalidad']) && isset($_POST['ciudad']) && isset($_POST['categoria']) 
    && isset($_POST['actividad'])){

        $usuario = $_POST['usuario'];
        $password = $_POST['clave'];
        $passwordVerify = $_POST['claveVerify'];
        $email = $_POST['email'];
        $nombre_artistico = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $nacionalidad = $_POST['nacionalidad'];
        $ciudad = $_POST['ciudad'];
        $categoria = $_POST['categoria'];
        $option = $_POST['actividad'];
        $fechaRegistro =  date('Y-m-d H:i:s');

        $arrayError = array();

        if(!empty($usuario)){
            $usuario_validate=true;
        }else{
            $arrayError['smgUser']='Porfavor ingresa un usuario valido';
            $usuario_validate=false;
        }
        
        if(!empty($password)){
            $password_validate=true;
        }else{
            $arrayError['smgPassword']="Introduzca la contraseña";
            $password_validate=false;
        }

        if(!empty($passwordVerify)){
            $passwordVerify_validate=true;
        }else{
            $arrayError['smgPassword2']="Repita la contraseña";
            $passwordVerify_validate=false;
        }   

        if($password==$passwordVerify){
            $passwords_validate=true;
        }else{
            $arrayError['smgComparacion']="Las contraseñas no coinciden";
            $passwords_validate=false;
        }

        if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
            $email_validate=true;
        }else{
            $arrayError['smgEmail']="Email vacio y/o incorrecto";
            $email_validate=false;
        }

        if(!empty($nombre_artistico)){
            $nombre_validate=true;
        }else{
            $arrayError['smgArtistico']="Ingrese el nombre artistico";
            $email_validate=false;
        }

        if(!empty($telefono)){
            $telefono_validate=true;
        }else{
            $arrayError['smgTelefono']="Ingrese el numero de telefono";
            $telefono_validate=false;
        }

        if(!empty($nacionalidad) && !is_numeric($nacionalidad) && !preg_match("/[0-9]/",$nacionalidad)){
            $nacionalidad_validate=true;
        }else{
            $arrayError['smgNacionalidad']='Nacionalidad invalida, porfavor ingresa una nacionalidad valida';
            $nacionalidad_validate=false;
        }

        if(!empty($ciudad) && !is_numeric($ciudad) && !preg_match("/[0-9]/",$ciudad)){
            $ciudad_validate=true;
        }else{
            $arrayError['smgCiudad']='Ciudad invalida, porfavor ingresa una nacionalidad valida';
            $ciudad_validate=false;
        }

        if(!empty($categoria)){
            $categoria_validate=true;
        }else{
            $arrayError['smgCategoria']='Elija la categoria';
            $categoria_validate=false;
        }

        if(!empty($option)){
            $option_validate=true;
        }else{
            $arrayError['smgActividad']='Elija una actividad';
            $option_validate=false;
        }

        if(count($arrayError)==0){

            $daoUsuario = new usuarioDao();

            if($daoUsuario=usuarioDao::usuarioIdUser($usuario)){
                $error=array("smg"=>"El usuario ingresado ya existe");
                echo json_encode($error);
            }else{
                $password_hash = new PasswordHash(8, TRUE);
                $password_encript=$password_hash->HashPassword(wp_unslash($password));
                

                $objmodel = new usuario(
                    null,
                    $usuario,
                    $password_encript,
                    $usuario,
                    $email,
                    '',
                    $fechaRegistro,
                    '',
                    0,
                    $nombre_artistico
                );
                if($daoUsuario=usuarioDao::registrarUsuario($objmodel)){

                    $idUsuario = usuarioDao::ultimoIdUsuario();
                    $separador = explode(" ",$nombre_artistico);
                    
                        if(isset($separador[1])){$last_name=$separador[1];}else{$last_name='';}
                            
                            $sub='"subscriber"';
                            $transformada = "a:1:{s:".strlen($sub).':'.$sub.';b:1;}';
                    
                                $meta = new userMeta(null,$idUsuario,"nickname","$nombre_artistico");
                                $meta1 = new userMeta(null,$idUsuario,"first_name",$separador[0]);
                                $meta2 = new userMeta(null,$idUsuario,'last_name',$last_name);
                                $meta3 = new userMeta(null,$idUsuario,'wp60_capabilities',$transformada);
                                $meta4 = new userMeta(null,$idUsuario,'wp60_user_level',0);

                                if($daoMeta=userMetaDao::registrar_userMeta($meta)){
                                if($daoMeta=userMetaDao::registrar_userMeta($meta1));
                                if($daoMeta=userMetaDao::registrar_userMeta($meta2));
                                if($daoMeta=userMetaDao::registrar_userMeta($meta3));
                                if($daoMeta=userMetaDao::registrar_userMeta($meta4));

                                    $transform = 'a:13:{s:'.strlen('"field_1"').':"field_1";s:'.strlen($nombre_artistico).
                                        ":'$nombre_artistico';s:".strlen('"field_3"').'"field_3";s:'.strlen($telefono).":'$telefono';s:".
                                        strlen('"field_7"').'"field_7";s:'.strlen($nacionalidad).":'$nacionalidad';s:".strlen('"field_201"')
                                        .'"field_201";s:'.strlen($ciudad).":'$ciudad';s:".strlen('"field_403"').'"field_403";s:'.strlen($categoria).":'$categoria';s:"
                                        .strlen('"field_454"').'"field_454";s:'.strlen($option).":'$option';s:"
                                        .strlen('"profile_field_ids"').';s:17:"1,3,7,201,403,454";}';
                                    $objSignup = new signups(
                                        null,
                                        '',
                                        '',
                                        '',
                                        $usuario,
                                        $email,
                                        $fechaRegistro,
                                        $fechaRegistro,
                                        1,
                                        'qVtOQg7mMlSuTKPzyx8eqtLX5wFb1aen',
                                        $transform
                                    );

                                    if($daoSignups = signupsDao::registrarSignups($objSignup)){

                                        $seleccion = explode(",",$option);


                                        $opciones = 'a:6:{i:0;s:6:"Musica";i:1;s:5:"Danza";i:2;s:6:
                                            "Teatro";i:3;s:10:"Literatura";i:4;s:7:"Pintura";i:5;s:11
                                            :"Audiovisual";}';
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
                                        $profile1 = new profileData(null,1,$idUsuario,$nombre_artistico,$fechaRegistro);
                                        $profile2 = new profileData(null,3,$idUsuario,$telefono,$fechaRegistro);
                                        $profile3 = new profileData(null,7,$idUsuario,$nacionalidad,$fechaRegistro);
                                        $profile4 = new profileData(null,201,$idUsuario,$ciudad,$fechaRegistro);
                                        $profile5 = new profileData(null,403,$idUsuario,$categoria,$fechaRegistro);
                                        $profile6 = new profileData(null,454,$idUsuario,$actividad,$fechaRegistro);

                                        
                                            if($daoProfile = profileDataDao::registrarProfile($profile1)){
                                            if($daoProfile = profileDataDao::registrarProfile($profile2))
                                            if($daoProfile = profileDataDao::registrarProfile($profile3))
                                            if($daoProfile = profileDataDao::registrarProfile($profile4))
                                            if($daoProfile = profileDataDao::registrarProfile($profile5))    
                                            if($daoProfile = profileDataDao::registrarProfile($profile6))
                                                $resultado = array("message"=>"Registro realizado con exito","result"=>"","status"=>"1");
                                                echo json_encode($resultado);                                                
                                            }
                                    }
                                }
                }else{
                    $error = array("message"=>"Fallo el registro del usuario","result"=>"","status"=>"0");
                    echo json_encode($error);
                }
            }
        }else{
            echo json_encode($arrayError);
        }
    }else{
        $error = array("message"=>"Ingrese todos los campos requeridos","result"=>"","status"=>"0");
        echo json_encode($error);
    }
?>