<?php session_start(); 
include_once($_SERVER['DOCUMENT_ROOT'].'/conf.php');
$idioma="";
$leyenda="";
if(strcmp($_SESSION['idioma'],"ESPAÑOL")== 0){
  $idioma="<i class='flag-icon flag-icon-co'></i>";
  $leyenda ="<i class='flag-icon flag-icon-co'></i>   ESPAÑOL LATINO AMERICA.";
}else{
  $idioma="<i class='flag-icon flag-icon-gb'></i>";
  $leyenda ="<i class='flag-icon flag-icon-gb'></i>   INGLES.";
}
?>
<nav
  class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
  <div class="navbar-wrapper">
    <div class="navbar-header expanded">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mobile-menu d-lg-none mr-auto"><a
            class="nav-link nav-menu-main menu-toggle hidden-xs is-active" href="#"><i
              class="ft-menu font-large-1"></i></a></li>
        <li class="nav-item mr-auto">
          <a class="navbar-brand" href="<?php echo INDEX_PLATFORM_PATH; ?>"><img class="brand-logo "
              alt="modern admin logo" src="<?php echo VENDOR_SERVER."aes/unnamed.png"; ?>">
            <h3 class="brand-text">PVP </h3>
          </a>
        </li>
        <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0"
            data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white"
              data-ticon="ft-toggle-right"></i></a></li>
        <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
            data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
      </ul>
    </div>
    <div class="navbar-container content">
      <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="nav navbar-nav mr-auto float-left">
          <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#">
              <i class="ficon ft-maximize"></i></a>
          </li>
          <li class="dropdown nav-item mega-dropdown d-none d-lg-block"><a class="dropdown-toggle nav-link" href="#"
              data-toggle="dropdown">Herramientas</a>
            <ul class="mega-dropdown-menu dropdown-menu row">
              <li class="col-md-3">
                <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="fa fa-mail-bulk"></i> Plataforma PVP AES
                </h6>
                <div id="mega-menu-carousel-example">
                  <div>
                    <img class="rounded img-fluid mb-1" src="<?php echo VENDOR_SERVER."aes/Logo-PVP11.jpg"; ?>"
                      alt="First slide">
                    <p class="news-title mb-0 d-block"> <i class="fa fa-signal"></i> ONLINE</p>
                    <p class="news-content">
                      <span class="font-small-2"> <br><i class="fa fa-globe"></i> <?php echo "<span class='text-bold-600'>".date("d")."-".date("m")."-".date("Y")."</span> - 
                        <span class='text-bold-600'>".date("g")." : ".date("i")."</span>"; ?>
                      </span>
                    </p>
                  </div>
                </div>
              </li>
              <li class="col-md-3">
                <h6 class="dropdown-menu-header text-uppercase"><i class="fa fa-life-ring"></i> HELP DESK</h6>
                <ul>
                  <li class="menu-list">
                    <ul>
                      <li><a class="dropdown-item" href="<?php echo MODULE_APP_SERVER."panel/soporte.php";?>"><i class="fa fa-info-circle"></i> Soporte
                          tecnico</a>
                      </li>
                      <li><a class="dropdown-item" href="<?php echo MODULE_APP_SERVER."panel/ayuda.php";?>"><i class="fa fa-headset"></i> Ayuda
                          & FAQ
                        </a></li>

                    </ul>
                  </li>
                </ul>
              </li>

              <li class="col-md-3">
                <h6 class="dropdown-menu-header text-uppercase"><i class="fa fa-link"></i> Enlaces </h6>
                <ul>
                  <li class="menu-list">
                    <ul>
                      <li><a class="dropdown-item" target="_blank" href="https://sanctionssearch.ofac.treas.gov/"><i
                            class="fa fa-external-link-alt"></i> LISTA CLINTON </a>
                      </li>
                      <li><a class="dropdown-item" target="_blank"
                          href="https://eris.contaduria.gov.co/BDME/#FormularioConsulta"><i
                            class="fa fa-external-link-alt"></i> BOLETÍN DE DEUDORES MOROSOS DEL ESTADO
                        </a></li>
                      <li><a class="dropdown-item" target="_blank"
                          href="https://www.procuraduria.gov.co/portal/consulta_antecedentes.page"><i
                            class="fa fa-external-link-alt"></i> PROCURADURÍA GENERAL DE LA NACIÓN</a>
                      </li>
                      <li><a class="dropdown-item" target="_blank"
                          href="https://antecedentes.policia.gov.co:7005/WebJudicial/"><i
                            class="fa fa-external-link-alt"></i> ANTECENDENTES JUDICIALES</a>
                      </li>
                      <li><a class="dropdown-item" target="_blank"
                          href="http://versionanterior.rues.org.co/RUES_Web/Consultas"><i
                            class="fa fa-external-link-alt"></i> RUE</a>
                      </li>
                      <li><a class="dropdown-item" target="_blank"
                          href="https://consulta.simit.org.co/Simit/index.html"><i class="fa fa-external-link-alt"></i>
                          SIMIT</a>
                      </li>

                    </ul>
                  </li>
                </ul>
              </li>

              <li class="col-md-3">
                <h6 class="dropdown-menu-header text-uppercase"><i class="la la-random"></i> Herramientas </h6>
                <ul>
                  <li class="menu-list">
                    <ul>
                      <li><a class="dropdown-item" href="<?php echo MODULE_APP_SERVER."plantillas/";?>"><i class="fa fa-clipboard-list"></i>
                          Plantillas PVP </a>
                      </li>
                      <li><a class="dropdown-item" href="<?php echo MODULE_APP_SERVER."areas/";?>"><i class="fa fa-tasks"></i> Areas
                          tecnicas
                        </a></li>
                      <li><a class="dropdown-item" href="<?php echo MODULE_APP_SERVER."calendario/";?>"><i class="fa fa-calendar-alt"></i>
                          Calendario</a>
                      </li>
                      <li><a class="dropdown-item" href="<?php echo MODULE_APP_SERVER."notificaciones/";?>"><i class="fa fa-bell"></i> Gestion de
                          notificaciones</a>
                      </li>
                      <li><a class="dropdown-item" href="<?php echo MODULE_APP_SERVER."correo/";?>"><i class="fa fa-envelope-open-text"></i>
                          Gestion de correo</a>
                      </li>

                    </ul>
                  </li>
                </ul>
              </li>


            </ul>
          </li>
          <li class="nav-item nav-link-search"><a class="nav-link d-none d-lg-block waves-effect waves-dark" href="#"><i
                class="material-icons search-icon">search</i>
              <input class="round form-control search-box" type="text" placeholder="Buscas algo  ?"></a><a
              class="nav-link dropdown-toggle search-bar-toggle d-lg-none d-m-block waves-effect waves-dark"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">search</i></a>
            <div class="dropdown-menu arrow"><a class="dropdown-item waves-effect waves-dark">
                <input class="round form-control" type="text" placeholder="Search Here"></a></div>
          </li>
        </ul>
        <ul class="nav navbar-nav float-right">
          <li class="dropdown dropdown-language  nav-item ">
            <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <?php echo $idioma; ?><span class="selected-language">IDIOMA</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown-flag">
              <a class="dropdown-item" href="#"><?php echo $leyenda; ?> </a>
            </div>
          </li>
          <!-- <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
              data-toggle="dropdown"><i class="ficon ft-bell"></i><span
                class="badge badge-pill badge-danger badge-up badge-glow">5</span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notificaciones</span></h6><span
                  class="notification-tag badge badge-danger float-right m-0">5 nuevos</span>
              </li>
              <li class="scrollable-container media-list w-100 ps"><a href="javascript:void(0)">
                  <div class="media">
                    <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">notificacion x!</h6>
                      <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer
                        elit.</p><small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">30 minutes
                          ago</time></small>
                    </div>
                  </div>
                </a><a href="javascript:void(0)">
                  <div class="media">
                    <div class="media-left align-self-center"><i
                        class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading red darken-1">notificacion y</h6>
                      <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p><small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Five hour
                          ago</time></small>
                    </div>
                  </div>
                </a><a href="javascript:void(0)">
                  <div class="media">
                    <div class="media-left align-self-center"><i
                        class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading yellow darken-3">notificacion z</h6>
                      <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p><small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                    </div>
                  </div>
                </a><a href="javascript:void(0)">
                  <div class="media">
                    <div class="media-left align-self-center"><i class="ft-check-circle icon-bg-circle bg-cyan"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">Complete the task</h6><small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last
                          week</time></small>
                    </div>
                  </div>
                </a><a href="javascript:void(0)">
                  <div class="media">
                    <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading">Generate monthly report</h6><small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last
                          month</time></small>
                    </div>
                  </div>
                </a>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                  <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                  <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
              </li>
              <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                  href="javascript:void(0)">Leer todas las notificaciones</a></li>
            </ul>
          </li> -->

          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <span class="mr-1">Hola ,<span
                  class="mr-1 user-name text-bold-700"><?php echo $_SESSION['nombre'];?></span></span>
              <span class="avatar avatar-online"><img
                  src="<?php echo DOCUMENTS_SERVER."/fotosPerfil/".$_SESSION['idusuario']."/".$_SESSION['idusuario'].".jpg"; ?>"
                  alt="avatar">
                <i></i>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="<?php echo MODULE_APP_SERVER."perfil/";?>"><i class="ft-user"></i> Editar mi perfil</a>
              <a class="dropdown-item" href="<?php echo MODULE_APP_SERVER."notificaciones/";?>"><i class="ft-mail"></i> Mis notificaciones</a>

              <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="ft-power"></i> Cerrar
                sesion</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
