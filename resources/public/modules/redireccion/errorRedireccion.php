
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  
<!-- Mirrored from pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/html/ltr/vertical-modern-menu-template/error-400.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Feb 2019 06:44:25 GMT -->
<head>
    <?php   
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/conf.php');
    require_once (PLATFORM_PATH."global/inc/maintenance/head.php");
    $HttpStatus = $_SERVER["REDIRECT_STATUS"] ;
    $smg = "";
    switch (intval($HttpStatus)) {
	    case '400':
	     $smg = "Error en la solicitud ";
		 break;
		 case '401':
	     $smg = "Acceso no autorizado";
		 break;
		 case '402':
	     $smg = "Error sin diccionario";
		 break;
		 case '403':
	     $smg = "Prohibido el acceso al usuario";
		 break;
		 case '404':
	     $smg = "Ruta no encontrada";
		 break;
		 case '405':
	     $smg = "Error sin diccionario";
		 break;
		 case '406':
	     $smg = "Error sin diccionario";
		 break;
		 case '407':
	     $smg = "Error sin diccionario";
		 break;
		 case '408':
	     $smg = "Error sin diccionario";
		 break;
		 case '409':
	     $smg = "Error sin diccionario";
		 break;
		 case '410':
	     $smg = "Error sin diccionario";
		 break;
		 case '411':
	     $smg = "Error sin diccionario";
		 break;
		 case '412':
	     $smg = "Error sin diccionario";
		 break;
		 case '413':
	     $smg = "Error sin diccionario";
		 break;
		 case '414':
	     $smg = "Error sin diccionario";
		 break;
		 case '500':
	     $smg = "Error Interno del servidor";
		 break;
		 case '501':
	     $smg = "Error sin diccionario";
		 break;
		 case '502':
	     $smg ="Bad Gateway";
		 break;
		 case '503':
	     $smg = "Error sin diccionario";
		 break;
		 case '504':
	     $smg = "Error sin diccionario";
		 break;
		 case '505':
	     $smg = "Error sin diccionario";
		 break;
	 
	     default:
	     $smg = "Error sin diccionario y sin identificacion en el sistema . . .";
		 break;
    }
            ?>
    <link rel="stylesheet" type="text/css" href="<?php echo VENDOR_SERVER."css/pages/error.min.css"; ?>">

  </head>
  <body class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 p-0">
            <div class="card-header bg-transparent border-0">
                <h2 class="error-code text-center mb-2"><?php echo $HttpStatus;?></h2>
                <h3 class="text-uppercase text-center"><?php echo $smg;  ?></h3>
            </div>
            <div class="card-content">
                <fieldset class="row py-2">
                    <div class="input-group col-12">
                        <!-- <input type="text" class="form-control form-control-xl input-xl border-grey border-lighten-1 " placeholder="Search..." aria-describedby="button-addon2">
                        <span class="input-group-append" id="button-addon2">
                           <button class="btn btn-lg btn-secondary border-grey border-lighten-1" type="button"><i class="ft-search"></i></button>
                       </span> -->
                   </div>
                </fieldset>
                <div class="row py-2">
                    <div class="col-12 col-sm-6 col-md-6">
                        <a href="https://aes.org.co/" class="btn btn-primary btn-block"><i class="ft-home"></i> SITIO WEB : AES</a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <a href="<?php echo INDEX_PATH; ?>" class="btn btn-success btn-block"><i class="ft-home"></i> PVP</a>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="row">
                    <p class="text-muted text-center col-12 py-1">© 2018 <a href="#">PVP</a> construido con amor por  <i class="ft-heart pink"> </i>  <a href="#" target="_blank">IPX SYSTEM</a></p>
                    <div class="col-12 text-center">
                       <a href="https://www.facebook.com/aesscs/" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span
                                            class="la la-facebook"></span></a>
                        <a href="https://twitter.com/AES_SCS" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span
                                            class="la la-twitter"></span></a>
                        <a href="https://www.linkedin.com/in/asociacionempresasseguras/" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin"><span
                                            class="la la-linkedin font-medium-4"></span></a>
                        <a href="https://www.instagram.com/aes_scs/" class="btn btn-social-icon mr-1 mb-1 btn-outline-instagram"><span
                                            class="la la-instagram font-medium-4"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <?php require_once (PLATFORM_PATH."global/inc/maintenance/lib.php"); ?>
  </body>


</html>