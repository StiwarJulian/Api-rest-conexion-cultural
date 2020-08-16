<?php 

    include_once ($_SERVER['DOCUMENT_ROOT'].'/miguel_claros/conf.php');
    require_once(DATABASE_PATH.'DataSource.php');
    require_once(PDO_PATH.'usuarioDao.php');
    require_once("class-phpass.php");
    require_once("formatting.php");
    #require_once("wp-includes/ms-functions.php");
    #require_once("wp-includes/pluggable.php");
    #require_once("wp-includes/option.php");
    #require_once("wp-includes/random_compat/random.php");
    #require_once("wp-includes/random_compat/byte_safe_strings.php");
    #require_once("wp-includes/random_compat/cast_to_int.php");
    #require_once("wp-includes/random_compat/error_polyfill.php");
    #require_once("wp-includes/random_compat/random_bytes_com_dotnet.php");

    #require_once("wp-includes/random_compat/random.php");
    #require_once("wp-includes/random_compat/random_bytes_dev_urandom.php");
    #require_once("wp-includes/random_compat/random_bytes_mcrypt.php");

    #require_once("wp-includes/random_compat/random_int.php");



    $obj = new usuarioDao();

    $password="stiwar";
    $password_hash = new PasswordHash(8, TRUE);
    #hashPassword class--phpass.php
    #wp_unslash 
    $resultado=$password_hash->HashPassword(wp_unslash($password));

    #if($obj->registrarUsuario($resultado)){
      #  echo 'funciono revise bd';
    #}else{
      #  echo ' no funciono';
    #}
   # $key = substr(md5(time().wp_rand().$domain),0,16);
   # print_r($key);
   #$key="qVtOQg7mMlSuTKPzyx8eqtLX5wFb1aen";
    #if($obj->registrarLogueo($key)){
      #  echo 'funciono revise bd';
    #}else{
      #  echo 'no funciono';
    #}
?>