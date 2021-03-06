<!DOCTYPE html>
<html lang="en-us" >
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

        <title> Dashboard - SmartAdmin </title>
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>css/font-awesome.min.css">

        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>css/smartadmin-skins.min.css">

        <!-- SmartAdmin RTL Support is under construction-->
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>css/smartadmin-rtl.min.css">

        <!-- We recommend you use "your_style.css" to override SmartAdmin
             specific styles this will also ensure you retrain your customization with each SmartAdmin update.
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>css/your_style.css"> -->

        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>css/your_style.css">

        <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>css/demo.min.css">

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?= base_url() ?>img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= base_url() ?>img/favicon/favicon.ico" type="image/x-icon">

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <!-- Specifying a Webpage Icon for Web Clip
                 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
        <link rel="apple-touch-icon" href="<?= base_url() ?>img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url() ?>img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url() ?>img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="<?= base_url() ?>img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?= base_url() ?>img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?= base_url() ?>img/splash/iphone.png" media="screen and (max-device-width: 320px)">

        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->        
        <script src="<?= base_url() ?>js/libs/jquery-2.1.1.min.js"></script>
        <script src="<?= base_url() ?>js/libs/jquery-ui-1.10.3.min.js"></script>
    </head>
    <body >

        <!-- POSSIBLE CLASSES: minified, fixed-ribbon, fixed-header, fixed-width
                 You can also add different skin classes such as "smart-skin-1", "smart-skin-2" etc...-->
        <!-- HEADER -->
        <header id="header">
            <div id="logo-group">

                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo"> <img src="<?= base_url() ?>img/logo.png" alt="SmartAdmin"> </span>
                <!-- END LOGO PLACEHOLDER -->

                <!-- Note: The activity badge color changes when clicked and resets the number to 0
                Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
                <span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>

                <!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
                <div class="ajax-dropdown">

                    <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
                    <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio" name="activity" id="<?= base_url() ?>ajax/notify/mail.php">
                            Msgs (14) </label>
                        <label class="btn btn-default">
                            <input type="radio" name="activity" id="<?= base_url() ?>ajax/notify/notifications.php">
                            notify (3) </label>
                        <label class="btn btn-default">
                            <input type="radio" name="activity" id="<?= base_url() ?>ajax/notify/tasks.php">
                            Tasks (4) </label>
                    </div>

                    <!-- notification content -->
                    <div class="ajax-notifications custom-scroll">

                        <div class="alert alert-transparent">
                            <h4>Click a button to show messages here</h4>
                            This blank page message helps protect your privacy, or you can show the first message here automatically.
                        </div>

                        <i class="fa fa-lock fa-4x fa-border"></i>

                    </div>
                    <!-- end notification content -->

                    <!-- footer: refresh area -->
                    <span> Last updated on: 12/12/2013 9:43AM
                        <button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
                            <i class="fa fa-refresh"></i>
                        </button> </span>
                    <!-- end footer -->

                </div>
                <!-- END AJAX-DROPDOWN -->
            </div>

            <!-- projects dropdown -->
            <div class="project-context hidden-xs">

                <span class="label">Projects:</span>
                <span id="project-selector" class="popover-trigger-element dropdown-toggle" data-toggle="dropdown">Recent projects <i class="fa fa-angle-down"></i></span>

                <!-- Suggestion: populate this list with fetch and push technique -->
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0);">Online e-merchant management system - attaching integration with the iOS</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Notes on pipeline upgradee</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Assesment Report for merchant account</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);"><i class="fa fa-power-off"></i> Clear</a>
                    </li>
                </ul>
                <!-- end dropdown-menu-->

            </div>
            <!-- end projects dropdown -->

            <!-- pulled right: nav area -->
            <div class="pull-right">

                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" title="Collapse Menu" data-action="toggleMenu"><i class="fa fa-reorder"></i></a> </span>
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
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.php" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
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
                    <span> <a href="<?= base_url() ?>login.php" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- end logout button -->

                <!-- search mobile button (this is hidden till mobile view port) -->
                <div id="search-mobile" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
                </div>
                <!-- end search mobile button -->

                <!-- input: search field -->
                <form action="<?= base_url() ?>search.php" class="header-search pull-right">
                    <input type="text" name="param" placeholder="Find reports and more" id="search-fld">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
                </form>
                <!-- end input: search field -->

                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" title="Full Screen" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->

                <!-- #Voice Command: Start Speech -->
                <div id="speech-btn" class="btn-header transparent pull-right hidden-sm hidden-xs">
                    <div> 
                        <a href="javascript:void(0)" title="Voice Command" data-action="voiceCommand"><i class="fa fa-microphone"></i></a> 
                        <div class="popover bottom"><div class="arrow"></div>
                            <div class="popover-content">
                                <h4 class="vc-title">Voice command activated <br><small>Please speak clearly into the mic</small></h4>
                                <h4 class="vc-title-error text-center">
                                    <i class="fa fa-microphone-slash"></i> Voice command failed
                                    <br><small class="txt-color-red">Must <strong>"Allow"</strong> Microphone</small>
                                    <br><small class="txt-color-red">Must have <strong>Internet Connection</strong></small>
                                </h4>
                                <a href="javascript:void(0);" class="btn btn-success" onclick="commands.help()">See Commands</a> 
                                <a href="javascript:void(0);" class="btn bg-color-purple txt-color-white" onclick="$('#speech-btn .popover').fadeOut(50);">Close Popup</a> 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end voice command -->

                <!-- multiple lang dropdown : find all flags in the flags page -->

                <ul class="header-dropdown-list hidden-xs">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                            <img src="<?= base_url() ?>img/blank.gif" class="flag flag-us" alt="United States"> <span> English (US) </span> <i class="fa fa-angle-down"></i> </a>
                        <ul class="dropdown-menu pull-right">
                            <li class="active">
                                <a href="javascript:void(0);"><img src="<?= base_url() ?>img/blank.gif" class="flag flag-us" alt="United States"> English (US)</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><img src="<?= base_url() ?>img/blank.gif" class="flag flag-fr" alt="France"> Français</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><img src="<?= base_url() ?>img/blank.gif" class="flag flag-es" alt="Spanish"> Español</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><img src="<?= base_url() ?>img/blank.gif" class="flag flag-de" alt="German"> Deutsch</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><img src="<?= base_url() ?>img/blank.gif" class="flag flag-jp" alt="Japan"> 日本語</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><img src="<?= base_url() ?>img/blank.gif" class="flag flag-cn" alt="China"> 中文</a>
                            </li>	
                            <li>
                                <a href="javascript:void(0);"><img src="<?= base_url() ?>img/blank.gif" class="flag flag-it" alt="Italy"> Italiano</a>
                            </li>	
                            <li>
                                <a href="javascript:void(0);"><img src="<?= base_url() ?>img/blank.gif" class="flag flag-pt" alt="Portugal"> Portugal</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><img src="<?= base_url() ?>img/blank.gif" class="flag flag-ru" alt="Russia"> Русский язык</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><img src="<?= base_url() ?>img/blank.gif" class="flag flag-kr" alt="Korea"> 한국어</a>
                            </li>						
                        </ul>
                    </li>
                </ul>

                <!-- end multiple lang -->

            </div>
            <!-- end pulled right: nav area -->

        </header>
        <!-- END HEADER -->

        <!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
        Note: These tiles are completely responsive,
        you can add as many as you like
        -->
        <div id="shortcut">
            <ul>
                <li>
                    <a href="<?= base_url() ?>inbox.php" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>calendar.php" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>gmap-xml.php" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>invoice.php" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>gallery.php" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>profile.php" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
                </li>
            </ul>
        </div>
        <!-- END SHORTCUT AREA -->

        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <aside id="left-panel">

            <!-- User info -->
            <div class="login-info">
                <span> <!-- User image size is adjusted inside CSS, it should stay as is --> 

                    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        <img src="<?= base_url() ?>img/avatars/sunny.png" alt="me" class="online" /> 
                        <span>
                            john.doe 
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a> 

                </span>
            </div>
            <!-- end user info -->

            <!-- NAVIGATION : This navigation is also responsive

            To make this navigation dynamic please make sure to link the node
            (the reference to the nav > ul) after page load. Or the navigation
            will not initialize.
            -->
            <nav>
                    <!-- NOTE: Notice the gaps after each icon usage <i></i>..
                    Please note that these links work a bit different than
                    traditional hre="" links. See documentation for details.
                -->
                <ul><li class="active"><a
                            href="http://www.xodyn.com/smartAdmin/1.5.2/ver/PHP_version/PHP_HTML_Version"

                            title="Dashboard"
                            >
                            <i class="fa fa-lg fa-fw fa-home"></i>
                            <span class="menu-item-parent">Dashboard </span>

                        </a></li><li><a
                            href="#"

                            title="Smart UI"
                            >
                            <i class="fa fa-lg fa-fw fa-code"></i>
                            <span class="menu-item-parent">Smart UI </span>

                        </a><ul><li><a
                                    href="#"

                                    title="General Elements"
                                    >
                                    <i class="fa fa-lg fa-fw fa-folder-open"></i>
                                    General Elements 

                                </a><ul><li><a
                                            href="<?= base_url() ?>smartui-alert.php"

                                            title="Alerts"
                                            >

                                            Alerts 

                                        </a></li><li><a
                                            href="<?= base_url() ?>smartui-progress.php"

                                            title="Progress"
                                            >

                                            Progress 

                                        </a></li></ul></li><li><a
                                    href="<?= base_url() ?>smartui-carousel.php"

                                    title="Carousel"
                                    >

                                    Carousel 

                                </a></li><li><a
                                    href="<?= base_url() ?>smartui-tab.php"

                                    title="Tab"
                                    >

                                    Tab 

                                </a></li><li><a
                                    href="<?= base_url() ?>smartui-accordion.php"

                                    title="Accordion"
                                    >

                                    Accordion 

                                </a></li><li><a
                                    href="<?= base_url() ?>smartui-widget.php"

                                    title="Widget"
                                    >

                                    Widget 

                                </a></li><li><a
                                    href="<?= base_url() ?>smartui-datatable.php"

                                    title="DataTable"
                                    >

                                    DataTable 

                                </a></li><li><a
                                    href="<?= base_url() ?>smartui-button.php"

                                    title="Button"
                                    >

                                    Button 

                                </a></li><li><a
                                    href="<?= base_url() ?>smartui-form.php"

                                    title="Smart Form"
                                    >

                                    Smart Form 

                                </a></li></ul></li><li><a
                            href="<?= base_url() ?>inbox.php"

                            title="Inbox"
                            >
                            <i class="fa fa-lg fa-fw fa-inbox"></i>
                            <span class="menu-item-parent">Inbox </span> <span class="badge pull-right inbox-badge">14</span>

                        </a></li><li><a
                            href="#"

                            title="Graphs"
                            >
                            <i class="fa fa-lg fa-fw fa-bar-chart-o"></i>
                            <span class="menu-item-parent">Graphs </span>

                        </a><ul><li><a
                                    href="<?= base_url() ?>flot.php"

                                    title="Flot Chart"
                                    >

                                    Flot Chart 

                                </a></li><li><a
                                    href="<?= base_url() ?>morris.php"

                                    title="Morris Charts"
                                    >

                                    Morris Charts 

                                </a></li><li><a
                                    href="<?= base_url() ?>inline-charts.php"

                                    title="Inline Charts"
                                    >

                                    Inline Charts 

                                </a></li><li><a
                                    href="<?= base_url() ?>dygraphs.php"

                                    title="Dygraphs"
                                    >

                                    Dygraphs 

                                </a></li><li><a
                                    href="<?= base_url() ?>chartjs.php"

                                    title="Chart.js"
                                    >

                                    Chart.js   <span class="badge pull-right inbox-badge bg-color-yellow">new</span>

                                </a></li></ul></li><li><a
                            href="#"

                            title="Tables"
                            >
                            <i class="fa fa-lg fa-fw fa-table"></i>
                            <span class="menu-item-parent">Tables </span>

                        </a><ul><li><a
                                    href="<?= base_url() ?>table.php"

                                    title="Normal Tables"
                                    >

                                    Normal Tables 

                                </a></li><li><a
                                    href="<?= base_url() ?>datatables.php"

                                    title="Data Tables"
                                    >

                                    Data Tables   <span class="badge inbox-badge bg-color-greenLight">v1.10</span>

                                </a></li><li><a
                                    href="<?= base_url() ?>jqgrid.php"

                                    title="Jquery Grid"
                                    >

                                    Jquery Grid 

                                </a></li></ul></li><li><a
                            href="#"

                            title="Forms"
                            >
                            <i class="fa fa-lg fa-fw fa-pencil-square-o"></i>
                            <span class="menu-item-parent">Forms </span>

                        </a><ul><li><a
                                    href="<?= base_url() ?>form-elements.php"

                                    title="Smart Form Elements"
                                    >

                                    Smart Form Elements 

                                </a></li><li><a
                                    href="<?= base_url() ?>form-templates.php"

                                    title="Smart Form Layouts"
                                    >

                                    Smart Form Layouts 

                                </a></li><li><a
                                    href="<?= base_url() ?>validation.php"

                                    title="Smart Form Validation"
                                    >

                                    Smart Form Validation 

                                </a></li><li><a
                                    href="<?= base_url() ?>bootstrap-forms.php"

                                    title="Bootstrap Form Elements"
                                    >

                                    Bootstrap Form Elements 

                                </a></li><li><a
                                    href="<?= base_url() ?>plugins.php"

                                    title="Form Plugins"
                                    >

                                    Form Plugins 

                                </a></li><li><a
                                    href="<?= base_url() ?>wizard.php"

                                    title="Wizards"
                                    >

                                    Wizards 

                                </a></li><li><a
                                    href="<?= base_url() ?>other-editors.php"

                                    title="Bootstrap Editors"
                                    >

                                    Bootstrap Editors 

                                </a></li><li><a
                                    href="<?= base_url() ?>dropzone.php"

                                    title="Dropzone"
                                    >

                                    Dropzone 

                                </a></li><li><a
                                    href="<?= base_url() ?>image-editor.php"

                                    title="Image Cropping"
                                    >

                                    Image Cropping  <span class="badge pull-right inbox-badge bg-color-yellow">new</span>

                                </a></li></ul></li><li><a
                            href="#"

                            title="UI Elements"
                            >
                            <i class="fa fa-lg fa-fw fa-desktop"></i>
                            <span class="menu-item-parent">UI Elements </span>

                        </a><ul><li><a
                                    href="<?= base_url() ?>general-elements.php"

                                    title="General Elements"
                                    >

                                    General Elements 

                                </a></li><li><a
                                    href="<?= base_url() ?>buttons.php"

                                    title="Buttons"
                                    >

                                    Buttons 

                                </a></li><li><a
                                    href="#"

                                    title="Icons"
                                    >

                                    Icons 

                                </a><ul><li><a
                                            href="<?= base_url() ?>fa.php"

                                            title="Font Awesome"
                                            >
                                            <i class="fa fa-lg fa-fw fa-plane"></i>
                                            Font Awesome 

                                        </a></li><li><a
                                            href="<?= base_url() ?>glyph.php"

                                            title="Glyph Icons"
                                            >
                                            <i class="fa fa-lg fa-fw fa-plane"></i>
                                            Glyph Icons 

                                        </a></li><li><a
                                            href="<?= base_url() ?>flags.php"

                                            title="Flags"
                                            >
                                            <i class="fa fa-lg fa-fw fa-flag"></i>
                                            Flags 

                                        </a></li></ul></li><li><a
                                    href="<?= base_url() ?>grid.php"

                                    title="Grid"
                                    >

                                    Grid 

                                </a></li><li><a
                                    href="<?= base_url() ?>treeview.php"

                                    title="Tree View"
                                    >

                                    Tree View 

                                </a></li><li><a
                                    href="<?= base_url() ?>nestable-list.php"

                                    title="Nestable Lists"
                                    >

                                    Nestable Lists 

                                </a></li><li><a
                                    href="<?= base_url() ?>jqui.php"

                                    title="jQuery UI"
                                    >

                                    jQuery UI 

                                </a></li><li><a
                                    href="<?= base_url() ?>typography.php"

                                    title="Typography"
                                    >

                                    Typography 

                                </a></li><li><a
                                    href="#"

                                    title="Six Level Menu"
                                    >

                                    Six Level Menu 

                                </a><ul><li><a
                                            href="#"

                                            title="Item #2"
                                            >
                                            <i class="fa fa-lg fa-fw fa-folder-open"></i>
                                            Item #2 

                                        </a><ul><li><a
                                                    href="#"

                                                    title="Sub #2.1"
                                                    >
                                                    <i class="fa fa-lg fa-fw fa-folder-open"></i>
                                                    Sub #2.1 

                                                </a><ul><li><a
                                                            href="#"

                                                            title="Item #2.1.1"
                                                            >
                                                            <i class="fa fa-lg fa-fw fa-file-text"></i>
                                                            Item #2.1.1 

                                                        </a></li><li><a
                                                            href="#"

                                                            title="Expand"
                                                            >
                                                            <i class="fa fa-lg fa-fw fa-plus"></i>
                                                            Expand 

                                                        </a><ul><li><a
                                                                    href="#"

                                                                    title="File"
                                                                    >
                                                                    <i class="fa fa-lg fa-fw fa-file-text"></i>
                                                                    File 

                                                                </a></li><li><a
                                                                    href="#"

                                                                    title="Delete"
                                                                    >
                                                                    <i class="fa fa-lg fa-fw fa-trash-o"></i>
                                                                    Delete 

                                                                </a></li></ul></li></ul></li></ul></li><li><a
                                            href="#"

                                            title="Item #3"
                                            >
                                            <i class="fa fa-lg fa-fw fa-folder-open"></i>
                                            Item #3 

                                        </a><ul><li><a
                                                    href="#"

                                                    title="Sub #3.1"
                                                    >
                                                    <i class="fa fa-lg fa-fw fa-folder-open"></i>
                                                    Sub #3.1 

                                                </a><ul><li><a
                                                            href="#"

                                                            title="File"
                                                            >
                                                            <i class="fa fa-lg fa-fw fa-file-text"></i>
                                                            File 

                                                        </a></li><li><a
                                                            href="#"

                                                            title="File"
                                                            >
                                                            <i class="fa fa-lg fa-fw fa-file-text"></i>
                                                            File 

                                                        </a></li></ul></li></ul></li><li><a
                                            href="#"

                                            title="Item #4 (disabled)"
                                            class="inactive">
                                            <i class="fa fa-lg fa-fw fa-folder-open"></i>
                                            Item #4 (disabled) 

                                        </a></li></ul></li></ul></li><li><a
                            href="<?= base_url() ?>calendar.php"

                            title="Calendar"
                            >
                            <i class="fa fa-lg fa-fw fa-calendar"><em >3</em></i>
                            <span class="menu-item-parent">Calendar </span>

                        </a></li><li><a
                            href="<?= base_url() ?>widgets.php"

                            title="Widgets"
                            >
                            <i class="fa fa-lg fa-fw fa-list-alt"></i>
                            <span class="menu-item-parent">Widgets </span>

                        </a></li><li><a
                            href="#"

                            title="App Views"
                            >
                            <i class="fa fa-lg fa-fw fa-puzzle-piece"></i>
                            <span class="menu-item-parent">App Views </span>

                        </a><ul><li><a
                                    href="<?= base_url() ?>projects.php"

                                    title="Projects"
                                    >
                                    <i class="fa fa-lg fa-fw fa fa-file-text-o"></i>
                                    Projects 

                                </a></li><li><a
                                    href="<?= base_url() ?>blog.php"

                                    title="Blog"
                                    >
                                    <i class="fa fa-lg fa-fw fa fa-paragraph"></i>
                                    Blog 

                                </a></li><li><a
                                    href="<?= base_url() ?>gallery.php"

                                    title="Gallery"
                                    >
                                    <i class="fa fa-lg fa-fw fa fa-picture-o"></i>
                                    Gallery 

                                </a></li><li><a
                                    href="#"

                                    title="Forum Layout"
                                    >
                                    <i class="fa fa-lg fa-fw fa fa-comments"></i>
                                    Forum Layout 

                                </a><ul><li><a
                                            href="<?= base_url() ?>forum.php"

                                            title="General View"
                                            >

                                            General View 

                                        </a></li><li><a
                                            href="<?= base_url() ?>forum-topic.php"

                                            title="Topic View"
                                            >

                                            Topic View 

                                        </a></li><li><a
                                            href="<?= base_url() ?>forum-post.php"

                                            title="Post View"
                                            >

                                            Post View 

                                        </a></li></ul></li><li><a
                                    href="<?= base_url() ?>profile.php"

                                    title="Profile"
                                    >
                                    <i class="fa fa-lg fa-fw fa fa-group"></i>
                                    Profile 

                                </a></li><li><a
                                    href="<?= base_url() ?>timeline.php"

                                    title="Timeline"
                                    >
                                    <i class="fa fa-lg fa-fw fa fa-clock-o"></i>
                                    Timeline 

                                </a></li></ul></li><li><a
                            href="<?= base_url() ?>gmap-xml.php"

                            title="GMap Skins"
                            >
                            <i class="fa fa-lg fa-fw fa-map-marker"></i>
                            <span class="menu-item-parent">GMap Skins </span> <span class="badge bg-color-greenLight pull-right inbox-badge">9</span>

                        </a></li><li><a
                            href="#"

                            title="Miscellaneous"
                            >
                            <i class="fa fa-lg fa-fw fa-windows"></i>
                            <span class="menu-item-parent">Miscellaneous </span>

                        </a><ul><li><a
                                    href="http://bootstraphunter.com/smartadmin-landing/"
                                    target="_blank"
                                    title="Landing Page"
                                    >

                                    Landing Page <i class="fa fa-external-link"></i>

                                </a></li><li><a
                                    href="<?= base_url() ?>pricing-table.php"

                                    title="Pricing Tables"
                                    >

                                    Pricing Tables 

                                </a></li><li><a
                                    href="<?= base_url() ?>invoice.php"

                                    title="Invoice"
                                    >

                                    Invoice 

                                </a></li><li><a
                                    href="<?= base_url() ?>login.php"

                                    title="Login"
                                    >

                                    Login 

                                </a></li><li><a
                                    href="<?= base_url() ?>register.php"

                                    title="Register"
                                    >

                                    Register 

                                </a></li><li><a
                                    href="<?= base_url() ?>lock.php"

                                    title="Lock Screen"
                                    >

                                    Lock Screen 

                                </a></li><li><a
                                    href="<?= base_url() ?>error404.php"

                                    title="Error 404"
                                    >

                                    Error 404 

                                </a></li><li><a
                                    href="<?= base_url() ?>error500.php"

                                    title="Error 500"
                                    >

                                    Error 500 

                                </a></li><li><a
                                    href="<?= base_url() ?>blank_.php"

                                    title="Blank Page"
                                    >

                                    Blank Page 

                                </a></li><li><a
                                    href="<?= base_url() ?>email-template.php"

                                    title="Email Template"
                                    >

                                    Email Template 

                                </a></li><li><a
                                    href="<?= base_url() ?>search.php"

                                    title="Search Page"
                                    >

                                    Search Page 

                                </a></li><li><a
                                    href="<?= base_url() ?>ckeditor.php"

                                    title="CK Editor"
                                    >

                                    CK Editor 

                                </a></li></ul></li><li><a
                            href="#"

                            title="SmartAdmin Intel"
                            >
                            <i class="fa fa-lg fa-fw fa-cube txt-color-blue"></i>
                            <span class="menu-item-parent">SmartAdmin Intel </span>

                        </a><ul><li><a
                                    href="<?= base_url() ?>difver.php"

                                    title="Different Versions"
                                    >
                                    <i class="fa fa-lg fa-fw fa-stack-overflow"></i>
                                    Different Versions 

                                </a></li><li><a
                                    href="<?= base_url() ?>applayout.php"

                                    title="App Settings"
                                    >
                                    <i class="fa fa-lg fa-fw fa-cube"></i>
                                    App Settings 

                                </a></li><li><a
                                    href="http://192.241.236.31/smartadmin/BUGTRACK/track_/documentation/index.html"
                                    target="_blank"
                                    title="Documentation"
                                    >
                                    <i class="fa fa-lg fa-fw fa-book"></i>
                                    Documentation 

                                </a></li><li><a
                                    href="http://192.241.236.31/smartadmin/BUGTRACK/track_/"
                                    target="_blank"
                                    title="Bug Tracker"
                                    >
                                    <i class="fa fa-lg fa-fw fa-bug"></i>
                                    Bug Tracker 

                                </a></li></ul></li><li class="chat-users top-menu-invisible"><a
                            href="#"

                            title="Smart Chat API <sup>beta</sup>"
                            >
                            <i class="fa fa-lg fa-fw fa fa-lg fa-fw fa-comment-o"><em class="bg-color-pink flash animated">!</em></i>
                            <span class="menu-item-parent">Smart Chat API <sup>beta</sup> </span>

                        </a><ul><li>
                                <div class="display-users">
                                    <input class="form-control chat-user-filter" placeholder="Filter" type="text">

                                    <a href="#" class="usr" 
                                       data-chat-id="cha1" 
                                       data-chat-fname="Sadi" 
                                       data-chat-lname="Orlaf" 
                                       data-chat-status="busy" 
                                       data-chat-alertmsg="Sadi Orlaf is in a meeting. Please do not disturb!" 
                                       data-chat-alertshow="true" 
                                       data-rel="popover-hover" 
                                       data-placement="right" 
                                       data-html="true" 
                                       data-content="
                                       <div class='usr-card'>
                                       <img src='img/avatars/5.png' alt='Sadi Orlaf'>
                                       <div class='usr-card-content'>
                                       <h3>Sadi Orlaf</h3>
                                       <p>Marketing Executive</p>
                                       </div>
                                       </div>
                                       "> 
                                        <i></i>Sadi Orlaf
                                    </a>

                                    <a href="#" class="usr" 
                                       data-chat-id="cha2" 
                                       data-chat-fname="Jessica" 
                                       data-chat-lname="Dolof" 
                                       data-chat-status="online" 
                                       data-chat-alertmsg="" 
                                       data-chat-alertshow="false" 
                                       data-rel="popover-hover" 
                                       data-placement="right" 
                                       data-html="true" 
                                       data-content="
                                       <div class='usr-card'>
                                       <img src='img/avatars/1.png' alt='Jessica Dolof'>
                                       <div class='usr-card-content'>
                                       <h3>Jessica Dolof</h3>
                                       <p>Sales Administrator</p>
                                       </div>
                                       </div>
                                       "> 
                                        <i></i>Jessica Dolof
                                    </a>

                                    <a href="#" class="usr" 
                                       data-chat-id="cha3" 
                                       data-chat-fname="Zekarburg" 
                                       data-chat-lname="Almandalie" 
                                       data-chat-status="online" 
                                       data-rel="popover-hover" 
                                       data-placement="right" 
                                       data-html="true" 
                                       data-content="
                                       <div class='usr-card'>
                                       <img src='img/avatars/3.png' alt='Zekarburg Almandalie'>
                                       <div class='usr-card-content'>
                                       <h3>Zekarburg Almandalie</h3>
                                       <p>Sales Admin</p>
                                       </div>
                                       </div>
                                       "> 
                                        <i></i>Zekarburg Almandalie
                                    </a>

                                    <a href="#" class="usr" 
                                       data-chat-id="cha4" 
                                       data-chat-fname="Barley" 
                                       data-chat-lname="Krazurkth" 
                                       data-chat-status="away" 
                                       data-rel="popover-hover" 
                                       data-placement="right" 
                                       data-html="true" 
                                       data-content="
                                       <div class='usr-card'>
                                       <img src='img/avatars/4.png' alt='Barley Krazurkth'>
                                       <div class='usr-card-content'>
                                       <h3>Barley Krazurkth</h3>
                                       <p>Sales Director</p>
                                       </div>
                                       </div>
                                       "> 
                                        <i></i>Barley Krazurkth
                                    </a>

                                    <a href="#" class="usr offline" 
                                       data-chat-id="cha5" 
                                       data-chat-fname="Farhana" 
                                       data-chat-lname="Amrin" 
                                       data-chat-status="incognito" 
                                       data-rel="popover-hover" 
                                       data-placement="right" 
                                       data-html="true" 
                                       data-content="
                                       <div class='usr-card'>
                                       <img src='img/avatars/female.png' alt='Farhana Amrin'>
                                       <div class='usr-card-content'>
                                       <h3>Farhana Amrin</h3>
                                       <p>Support Admin <small><i class='fa fa-music'></i> Playing Beethoven Classics</small></p>
                                       </div>
                                       </div>
                                       "> 
                                        <i></i>Farhana Amrin (offline)
                                    </a>

                                    <a href="#" class="usr offline" 
                                       data-chat-id="cha6" 
                                       data-chat-fname="Lezley" 
                                       data-chat-lname="Jacob" 
                                       data-chat-status="incognito" 
                                       data-rel="popover-hover" 
                                       data-placement="right" 
                                       data-html="true" 
                                       data-content="
                                       <div class='usr-card'>
                                       <img src='img/avatars/male.png' alt='Lezley Jacob'>
                                       <div class='usr-card-content'>
                                       <h3>Lezley Jacob</h3>
                                       <p>Sales Director</p>
                                       </div>
                                       </div>
                                       "> 
                                        <i></i>Lezley Jacob (offline)
                                    </a>

                                    <a href="ajax/chat.html" class="btn btn-xs btn-default btn-block sa-chat-learnmore-btn">About the API</a>
                                </div></li></ul></li></ul>
            </nav>
            <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

        </aside>
        <!-- END NAVIGATION --><!-- ==========================CONTENT STARTS HERE ========================== -->
        <!-- MAIN PANEL -->
        <div id="main" role="main">
            <!-- RIBBON -->
            <div id="ribbon">

                <span class="ribbon-button-alignment"> 
                    <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"><i class="fa fa-refresh"></i></span> 
                </span>

                <!-- breadcrumb -->
                <ol class="breadcrumb">
                    <li><a href="http://www.xodyn.com/smartAdmin/1.5.2/ver/PHP_version/PHP_HTML_Version">Home</a></li><li>Dashboard</li>		</ol>
                <!-- end breadcrumb -->

                <!-- You can also add more buttons to the
                ribbon for further usability

                Example below:

                <span class="ribbon-button-alignment pull-right">
                <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
                <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
                <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
                </span> -->

            </div>
            <!-- END RIBBON -->
            <!-- MAIN CONTENT -->
            <div id="content">
                <?php $this->load->view($view);?> 
            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->

        <!-- ==========================CONTENT ENDS HERE ========================== -->

        <!-- PAGE FOOTER -->
        <!-- PAGE FOOTER -->
        <div class="page-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <span class="txt-color-white">SmartAdmin 1.5 <span class="hidden-xs"> - Web Application Framework</span> © 2014-2015</span>
                </div>

                <div class="col-xs-6 col-sm-6 text-right hidden-xs">
                    <div class="txt-color-white inline-block">
                        <i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
                        <div class="btn-group dropup">
                            <button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
                                <i class="fa fa-link"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right text-left">
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Download Progress</p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-success" style="width: 50%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Server Load</p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-success" style="width: 20%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Memory Load <span class="text-danger">*critical*</span></p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <button class="btn btn-block btn-default">refresh</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE FOOTER --><!-- END PAGE FOOTER -->

        <!--================================================== -->

        <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
        <script data-pace-options='{ "restartOnRequestAfter": true }' src="<?= base_url() ?>js/plugin/pace/pace.min.js"></script>

        <!-- These scripts will be located in Header So we can add scripts inside body (used in class.datatables.php) -->
        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local 
        <script src="<?= base_url() ?>js/libs/jquery-2.0.2.min.js"></script>        
        <script src="<?= base_url() ?>js/libs/jquery-ui-1.10.3.min.js"></script>
        >

        <!-- IMPORTANT: APP CONFIG -->
        <script src="<?= base_url() ?>js/app.config.js"></script>

        <!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
        <script src="<?= base_url() ?>js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 

        <!-- BOOTSTRAP JS -->
        <script src="<?= base_url() ?>js/bootstrap/bootstrap.min.js"></script>

        <!-- CUSTOM NOTIFICATION -->
        <script src="<?= base_url() ?>js/notification/SmartNotification.min.js"></script>

        <!-- JARVIS WIDGETS -->
        <script src="<?= base_url() ?>js/smartwidgets/jarvis.widget.min.js"></script>

        <!-- EASY PIE CHARTS -->
        <!--
        <script src="<?= base_url() ?>js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
        -->

        <!-- SPARKLINES -->
        <!--
        <script src="<?= base_url() ?>js/plugin/sparkline/jquery.sparkline.min.js"></script>
        -->

        <!-- JQUERY VALIDATE -->
        <script src="<?= base_url() ?>js/plugin/jquery-validate/jquery.validate.min.js"></script>

        <!-- JQUERY MASKED INPUT -->
        <script src="<?= base_url() ?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>

        <!-- JQUERY SELECT2 INPUT -->
        <script src="<?= base_url() ?>js/plugin/select2/select2.min.js"></script>

        <!-- JQUERY UI + Bootstrap Slider -->
        <script src="<?= base_url() ?>js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

        <!-- browser msie issue fix -->
        <script src="<?= base_url() ?>js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

        <!-- FastClick: For mobile devices -->
        <script src="<?= base_url() ?>js/plugin/fastclick/fastclick.min.js"></script>

        <!--[if IE 8]>
                <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        <![endif]-->

        <!-- Demo purpose only -->
        <script src="<?= base_url() ?>js/demo.min.js"></script>

        <!-- MAIN APP JS FILE -->
        <script src="<?= base_url() ?>js/app.min.js"></script>		

        <!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
        <!-- Voice command : plugin -->
        <!--
        <script src="<?= base_url() ?>js/speech/voicecommand.min.js"></script>	
        -->

        <!-- SmartChat UI : plugin -->
        <!--
        <script src="<?= base_url() ?>js/smart-chat-ui/smart.chat.ui.min.js"></script>
        <script src="<?= base_url() ?>js/smart-chat-ui/smart.chat.manager.min.js"></script>
        -->

        
        <script type="text/javascript">
            // DO NOT REMOVE : GLOBAL FUNCTIONS!
            $(document).ready(function() {
                pageSetUp();
            })
        </script>
        
        <!-- PAGE RELATED PLUGIN(S) 
        <script src="..."></script>-->
        <!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
        <!--
        <script src="<?= base_url() ?>js/plugin/flot/jquery.flot.cust.min.js"></script>
        <script src="<?= base_url() ?>js/plugin/flot/jquery.flot.resize.min.js"></script>
        <script src="<?= base_url() ?>js/plugin/flot/jquery.flot.time.min.js"></script>
        <script src="<?= base_url() ?>js/plugin/flot/jquery.flot.tooltip.min.js"></script>
        -->

        <!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
        <!--
        <script src="<?= base_url() ?>js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?= base_url() ?>js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>
        -->

        <!-- Full Calendar -->
        <!--
        <script src="<?= base_url() ?>js/plugin/moment/moment.min.js"></script>
        <script src="<?= base_url() ?>js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>
        -->
        
        <script src="<?= base_url() ?>js/plugin/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>js/plugin/datatables/dataTables.colVis.min.js"></script>
        <script src="<?= base_url() ?>js/plugin/datatables/dataTables.tableTools.min.js"></script>
        <script src="<?= base_url() ?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>
        


    </body>

</html>