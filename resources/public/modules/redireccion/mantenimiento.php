<?php
   include_once($_SERVER['DOCUMENT_ROOT'].'/conf.php');
?>
<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">

<head>
    <?php require_once (PLATFORM_PATH."global/inc/maintenance/head.php"); ?>
</head>

<body class="vertical-layout vertical-menu-modern 1-column  bg-maintenance-image menu-expanded blank-page blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 box-shadow-3 m-0">
                                <div class="card-body">
                                    <span class="card-title text-center">
                                        <img src="<?php echo VENDOR_SERVER."aes/logo-aes.png"; ?>"
                                            class="img-fluid mx-auto d-block pt-2" width="250" alt="logo">
                                    </span>
                                </div>
                                <div class="card-body text-center">
                                    <h3>La plataforma actualmente se encuentra en mantenimiento</h3>
                                    <p>Lamentamos las molestias,
                                        <br>por favor vuelva mas tarde.</p>
                                    <div class="mt-2"><i class="la la-cog spinner font-large-2"></i></div>
                                </div>
                                <span class="card-title text-center">
                                    <img src="<?php echo VENDOR_SERVER."aes/logopvp.png"; ?>"
                                        class="img-fluid mx-auto d-block pt-2" width="250" alt="logo">
                                </span> 
                                <a href="https://aes.org.co/" class="btn btn-primary btn-block"><i class="ft-home"></i> SITIO WEB : AES</a>
                                <hr>
                                <p class="socialIcon card-text text-center pt-2 pb-2">
                                    <a href="https://www.facebook.com/aesscs/" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span
                                            class="la la-facebook"></span></a>
                                    <a href="https://twitter.com/AES_SCS" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span
                                            class="la la-twitter"></span></a>
                                    <a href="https://www.linkedin.com/in/asociacionempresasseguras/" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin"><span
                                            class="la la-linkedin font-medium-4"></span></a>
                                    <a href="https://www.instagram.com/aes_scs/" class="btn btn-social-icon mr-1 mb-1 btn-outline-instagram"><span
                                            class="la la-instagram font-medium-4"></span></a>
                                        
                                </p>
                                
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