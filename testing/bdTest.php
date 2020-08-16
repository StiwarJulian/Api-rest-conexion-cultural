<?php 

    include_once ($_SERVER['DOCUMENT_ROOT'].'/miguel_claros/conf.php');

    require_once(DATABASE_PATH.'DataSource.php');

    $obj = new DataSource();
    echo var_dump($obj);
?>