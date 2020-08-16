//importante ROOT_PATH debe contener siempre al final el nombre del directorio principal donde
//esta almacenado el proyecto

 //configuracion en ambiente local:
 var app ="aes";
 var dominio = "http://aesbeta.ml/";
 //var dominio = "http://localhost/credito/";
 var dominio_server = "http://aesbeta.ml/";

 //rutas adjuntas :
var routeAppMobile = '';
var routeAppPlatform = dominio+'/resources/public/views/platform/modules/';
var routeAppPlatformModule = '';
var routeAppWebsite = '';


 //export
 function routesAppPlatform() {
    return routeAppPlatform;
}

function routesAppModule() {
    return routeAppPlatformModule;
}


 function routesAppMobile() {
    return routeAppMobile;
}

function routesAppWebsite() {
    return routeAppWebsite;
}


