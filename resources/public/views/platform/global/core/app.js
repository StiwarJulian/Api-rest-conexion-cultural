
function sendEventApp(sendType,route,params,ContentResponse){
    
  run = true;
   if(run == true){
    run = false;
        $.ajax({
          
            data:  params,
            url:   route,
            type:  sendType,
            dataType: 'html',
            beforeSend: function(){
                $(ContentResponse).html("Cargando espere por favor");
              },
            success:  function(response){
                $(ContentResponse).html(response);
              },
            error: function(){console.log('error ');},
            complete: function(){}
        
          }).fail( function( jqXHR, textStatus, errorThrown ) {
  
              if (jqXHR.status === 0) {
                  $(ContentResponse).html('Sin conexion: Verifica tu conexion.');
              } else if (jqXHR.status == 404) { 
                $(ContentResponse).html('Página solicitada no encontrada[404].');
              } else if (jqXHR.status == 500) {
                  $(ContentResponse).html  ('Error interno del servidor [500].');
              } else if (textStatus === 'parsererror') {
                  $(ContentResponse).html('Solicitud de archivo json fallida o error de parser');
              } else if (textStatus === 'timeout') {
                  $(ContentResponse).html('Error de tiempo de espera.');
              } else if (textStatus === 'abort') {$(ContentResponse).html('Petición abortada..');
              } else {$(ContentResponse).html('Error no detectado : ' + jqXHR.responseText);
              }
            });
          }
           
  }
  function sendEventFormDataApp(sendType,route,formData,ContentResponse){
    var run =true;
    if(run==true){
        run = false;
        $.ajax({
            data:   formData,
            url:    route,
            type:   sendType,
            contentType: false,
            processData: false,
            beforeSend: function(){ 
                $(ContentResponse).html('Cargando Espere por favor');},
            success:  function(response){
                
                $(ContentResponse).html(response);},
            error: function(){console.log('error ');},
            complete: function(){}
        
          }).fail( function( jqXHR, textStatus, errorThrown ) {
              if (jqXHR.status === 0) {
                  $(ContentResponse).html('Sin conexion: Verifica tu conexion.');
              } else if (jqXHR.status == 404) { 
                $(ContentResponse).html('Página solicitada no encontrada[404].');
              } else if (jqXHR.status == 500) {
                  $(ContentResponse).html  ('Error interno del servidor [500].');
              } else if (textStatus === 'parsererror') {
                  $(ContentResponse).html('Solicitud de archivo json fallida o error de parser');
              } else if (textStatus === 'timeout') {
                  $(ContentResponse).html('Error de tiempo de espera.');
              } else if (textStatus === 'abort') {$(ContentResponse).html('Petición abortada..');
              } else {$(ContentResponse).html('Error no detectado : ' + jqXHR.responseText);
              }
            });
    }
  }
  function editar_fecha(fecha, intervalo, dma, separador) {
      
    var separador = separador || "-";
    var arrayFecha = fecha.split(separador);
    var dia = arrayFecha[0];
    var mes = arrayFecha[1];
    var anio = arrayFecha[2];  
   
    var fechaInicial = new Date(anio, mes - 1, dia);
    var fechaFinal = fechaInicial;
    if(dma=="m" || dma=="M"){
      fechaFinal.setMonth(fechaInicial.getMonth()+parseInt(intervalo));
    }else if(dma=="y" || dma=="Y"){
      fechaFinal.setFullYear(fechaInicial.getFullYear()+parseInt(intervalo));
    }else if(dma=="d" || dma=="D"){
      fechaFinal.setDate(fechaInicial.getDate()+parseInt(intervalo));
    }else{
        return fecha;
    }
    dia = fechaFinal.getDate();
    mes = fechaFinal.getMonth() + 1;
    anio = fechaFinal.getFullYear();
  
    dia = (dia.toString().length == 1) ? "0" + dia.toString() : dia;
    mes = (mes.toString().length == 1) ? "0" + mes.toString() : mes;
  
    return anio + "/" + mes + "/" + dia;
  }
   function replaceAll( text){
     //text=text.replace(/\./g,"");
     //text=text.replace(/\$/g,"");
     text=text.replace(/[^a-z0-9]/gi, '');
     return text;
   }

   function manejoErroresMensajes(objDom ,id,addCSS,deleteCSS,validateTypeChar){
     objDom =replaceAll(objDom);
     var verification =0;

    if(objDom.length ==0 || objDom  == "?"){
      verification++;

    }

    switch (validateTypeChar) {
        case 1:
          if(isNaN(objDom)==true){verification++;}
        break;

        case 2:
        if(isNaN(objDom)==false){verification++;}
        break;
        
        case 3:
        
        break;
    }

    
    

    if(verification ==0){
      // $(id).removeClass(deleteCSS);
      $(id).addClass(addCSS);
      return 1;
      
    }else{
      // $(id).removeClass(addCSS);
      $(id).addClass(deleteCSS);
      return 0;
    }

  }

  /* Funcion que reemplaza (borra) los espacios en blanco del inicio
 * y final de una cadena. Ejemplo de uso:
 *    la cadena ”  hola  ” al usar la función trim(”  hola  “);
 *     resultaría “hola”.
 */
function trim(cadena){
    var expresionRegular = /^\s+|\s+$/g;
    return cadena.replace(expresionRegular, "");
}
/* Función que valida si la cadena contiene solo números.
 *  Ejemplo de uso:
 *   Al usar validaSoloNumerico(“1234”) : retorna True.
 *   Al usar validaSoloNumerico(“a123”) : retorna False.
 */
function validaSoloNumerico(cadena){
    var patron = /^\d*$/;
    if(!cadena.search(patron))
      return true;
    else
      return false;
}
/* Función que valida si la cadena contiene solo números.
 *  Ejemplo de uso:
 *   Al usar validaSoloTexto(“abcd”) : retorna True.
 *   Al usar validaSoloTexto(“1abc”) : retorna False.
 */
function validaSoloTexto(cadena){
  var patron = /^[a-zA-Z]*$/;
  // En caso de querer validar cadenas con espacios usar: /^[a-zA-Z\s]*$/
  if(!cadena.search(patron))
    return true;
  else
    return false;
}
/* Función que valida si el correo es tiene un formato valido.
 *  Ejemplo de uso:
 *   Al usar validaCorreoElectronico(“aa@aa.cl”) : retorna True.
 *   Al usar validaCorreoElectronico(“aa@@aa.cl”) : retorna False.
 *   Al usar validaCorreoElectronico(“@aa.cl”) : retorna False.
 *   Al usar validaCorreoElectronico(“aa@.cl”) : retorna False.
 *   Al usar validaCorreoElectronico(“aa@cl”) : retorna False.
 *   Al usar validaCorreoElectronico(“aa@aa”) : retorna False.
 *   etc…
 */
function validaCorreoElectronico(correoElectronico){
    var patron = /^([a-z]+[a-z1-9._-]*)@{1}([a-z1-9\.]{2,})\.([a-z]{2,3})$/;
    if(!correoElectronico.search(patron))
      return true;
    else
      return false;
}
  
