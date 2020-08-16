<?php session_start(); 
       include_once($_SERVER['DOCUMENT_ROOT'].'/conf.php');?>

<div class="main-menu material-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">


    
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header open"><span>Administracion</span>
                <i class="fa fa-keyboard" data-toggle="tooltip" data-placement="right"
                    data-original-title="Paneles de administracion"></i>
            </li>
            <li class=" nav-item"><a href="<?php echo MODULE_APP_SERVER."panel/";?>"><i class="fa fa-mail-bulk"></i><span
                        class="menu-title">Panel de control</span></a>
            </li>
            <li class="nav-item has-sub"><a href="#">
                    <i class="fa fa-industry"></i>
                    <span class="menu-title">Gestion de empresas</span>&nbsp;</a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="<?php echo MODULE_APP_SERVER."empresa/";?>">Empresas</a>
                    </li>
                    <li><a class="menu-item" href="<?php echo MODULE_APP_SERVER."empresa/grupos.php";?>"> Grupos
                            empresariales</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="<?php echo MODULE_APP_SERVER."plantillas/";?>"><i class="fa fa-laptop"></i>
                    <span class="menu-title">PLANTILLAS</span></a>
            </li>
            <li class=" navigation-header"><span>Actividades</span> <i class="fa fa-bezier-curve " data-toggle="tooltip"
                    data-placement="right" data-original-title="Apps"></i>
            </li>
            


            <li class="nav-item has-sub"><a href="#"><i class="fa fa-users"></i>
                    <span class="menu-title">Usuarios AES</span>&nbsp;</a>
                <ul class="menu-content">
                    <li><a class="menu-item"
                            href="<?php echo MODULE_APP_SERVER."usuarios/empleados.php";?>">Empleados</a>
                    </li>
                    <li><a class="menu-item" href="<?php echo MODULE_APP_SERVER."usuarios/empresas.php";?>">Clientes
                            &amp; Empresas</a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span>Actividades</span> <i class="fa fa-bezier-curve " data-toggle="tooltip"
                    data-placement="right" data-original-title="Apps"></i>
            </li>
            <li class=" nav-item"><a href="<?php echo MODULE_APP_SERVER."auditorias/";?>"><i class="fa fa-laptop"></i>
                    <span class="menu-title">Auditorias</span></a>
            </li>
            <li class=" nav-item"><a href="<?php echo MODULE_APP_SERVER."notificaciones/";?>"><i
                        class="fa fa-envelope-open-text"></i>
                    <span class="menu-title">Notificaciones a empresas</span></span></a>
            </li>


        </ul>
    </div>

</div>