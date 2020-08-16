<?php 

    $directorio = "../../wp-content";

    if(is_dir($directorio)){
        echo "es directorio";
    }else{
        echo "no es directorio";
    }

?>