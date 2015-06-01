<!-- HEADER -->
<header id="header">
        <div id="logo-group">

                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo"> <img src="<?= base_url() ?>img/logo-efac.png" alt="eFac Logo"> </span>
                <!-- END LOGO PLACEHOLDER -->               
        </div>
        

        <!-- projects dropdown -->
        <div class="project-context hidden-xs">

            <span class="label"><?= get_empresa_nombre_comercial()?> (<?= get_empresa_razon_sociall()?>)</span>
            <span id="project-selector"><i class="fa fa-university"> Establecimiento: <?=  get_establecimiento_nombre()?></i></span>                

        </div>
        <!-- end projects dropdown -->

        <!-- pulled right: nav area -->
        <div class="pull-right">

                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                        <span> <a href="javascript:void(0);" title="Expandir Menu" data-action="toggleMenu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->

                <!-- #MOBILE -->
                <!-- Top menu profile link : this shows only when top menu is active -->
                <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                        <li class="">
                                <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
                                        <img src="<?= base_url() ?>img/avatars/sunny.png" alt="John Doe" class="online" />
                                </a>
                                <ul class="dropdown-menu pull-right">
                                        <li>
                                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Configuración</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                                <a href="profile.php" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>erfil</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>A</u>ccesos</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Pantalla <u>C</u>completa</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                                <a href="login.php" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                                        </li>
                                </ul>
                        </li>
                </ul>

                <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                        <span> <a href="<?= base_url() ?>auth/logout" title="Cerrar sesión" data-action="userLogout" data-logout-msg="Usted puede mejorar su seguridad aún más después de cerrar la sesión al cerrar este navegador abierto"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- end logout button -->                                

                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                        <span> <a href="javascript:void(0);" title="Full Screen" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->                               

        </div>
        <!-- end pulled right: nav area -->

</header>
<!-- END HEADER -->