<?php

class rutas {

    public static function validarRutas($url){
        $encabezados = @get_headers($url);
        if(preg_match("|200|", $encabezados[0])){
            return "200";

        }elseif (preg_match("|404|", $encabezados[0])) {
            return "404";
        }
        
    }


}
?>