<?php 

    $separador = "probando";

    $test = explode(" ",$separador);
    $var = '';
    $var1 = '';
    if(isset($test[1])){$var = $test[1];}
    echo $test[0].'<br/>'.$var;



?>