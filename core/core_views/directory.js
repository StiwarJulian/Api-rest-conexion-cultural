//importante ROOT_PATH debe contener siempre al final el nombre del directorio principal donde



//esta almacenado el proyecto





 //configuracion en ambiente local:

 var app ="";

 var dominio = "";

 //var dominio = "http://localhost/credito/";

 var dominio_server = "";

 //rutas adjuntas :



var routeAppMobile = '';



var routeAppPlatform = dominio+'/resources/public/views/platform/modules/';



var routeAppWeb = dominio+'/resources/public/views/web/modules/';



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



function routesAppWeb() {

    return routeAppWeb;

}

