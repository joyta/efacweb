<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as is -->

            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src="<?= base_url() ?>img/avatars/female.png" alt="me" class="online" />
                <span>
                    <?= get_display_name() ?>
                </span>                
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
        <ul>
            <li>
                <a href="<?= base_url() ?>admin/dashboard"title="Dashboard">
                    <i class="fa fa-lg fa-fw fa-home"></i>
                    <span class="menu-item-parent">Dashboard </span>
                </a>
            </li>  
            
            <?php 
                $lista = render_menu();
                $padres = render_menu_padres($lista);
            ?>
            
            <?  foreach ($padres as $padre):?>
            <li>
                <a href="#">
                    <i class="<?=$padre->icono?>"></i> <span><?=$padre->etiqueta?></span>
                </a>
                
                <?php 
                    $hijos = render_menu_hijos($lista, $padre);                    
                ?>
                
                <ul>                    
                    <?  foreach ($hijos as $hijo):?>
                    <li>
                        <a href="<?= base_url().$hijo->ruta ?>"><?=$hijo->etiqueta?></a>
                    </li>
                    <?  endforeach;?>
                </ul>
            </li>
            <?  endforeach;?>
            <!--
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Configuración</span></a>
                <ul>
                    <li>
                        <a href="<?= base_url() ?>usuarios">Usuarios</a>
                    </li>
                     <li>
                        <a href="<?= base_url() ?>parametros">Parámetros</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>establecimientos">Establecimientos</a>
                    </li>                            
                    <li>
                        <a href="<?= base_url() ?>empresas">Empresas</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>puntosemision">Puntos de emisón</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>entidades">Entidades</a>
                    </li>
                </ul>
            </li>            
                        
            <li>
                <a href="#" title="Inventario">
                    <i class="fa fa-lg fa-fw fa-inbox"></i>
                    <span class="menu-item-parent">Inventario</span>
                </a>

                <ul>
                    <li>
                        <a href="<?= base_url() ?>productos">Productos <span class="badge pull-right inbox-badge bg-color-yellow">new</span></a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>marcas">Marcas</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>categorias">Categorias</a>
                    </li>  
                    <li>
                        <a href="<?= base_url() ?>unidades">Unidades</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>stock">Stock</a>
                    </li> 
                </ul>
            </li>            
                        
            <li>
                <a href="#" title="Financiero">
                    <i class="fa fa-lg fa-fw fa-credit-card"></i>
                    <span class="menu-item-parent">Financiero</span>
                </a>

                <ul>
                    <li>
                        <a href="<?= base_url() ?>bancos">Bancos <span class="badge pull-right inbox-badge bg-color-yellow">new</span></a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>transacciones/cuentas_cobrar">Cuentas por cobrar</a>
                    </li>                     
                    <li>
                        <a href="<?= base_url() ?>transacciones/cuentas_pagar">Cuentas por pagar</a>
                    </li>                     
                </ul>
            </li>            
                        
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent">Compras</span></a>
                <ul>
                    <li>
                        <a href="<?= base_url() ?>compras">Comprobantes</a>
                    </li>
                </ul>
            </li>            
                        
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-shopping-cart"></i> <span class="menu-item-parent">Ventas</span></a>
                <ul>
                    <li>
                        <a href="<?= base_url() ?>ventas">Comprobantes</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>ventas/no_autorizados">Comprobantes no autorizados</a>
                    </li>                    
                </ul>
            </li>
            
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Reportes</span></a>
                <ul>
                    <li>
                        <a href="<?=  base_url()?>reportes/ventas">Ventas</a>
                    </li>
                    <li>
                        <a href="<?=  base_url()?>reportes/total_ventas">Total ventas</a>
                    </li>
                    <li>
                        <a href="<?=  base_url()?>reportes/compras">Compras</a>
                    </li>
                    <li>
                        <a href="<?=  base_url()?>reportes/total_compras">Total compras</a>
                    </li>
                    <li>
                        <a href="<?=  base_url()?>reportes/cierres_caja">Cierres de caja</a>
                    </li>
                </ul>
            </li>            
            
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-archive"></i> <span class="menu-item-parent">Caja</span></a>
                <ul>
                    <li>
                        <a href="<?=  base_url()?>caja/apertura">Apertura</a>
                    </li>
                    <li>
                        <a href="<?=  base_url()?>caja/cierre">Cierre</a>
                    </li>                    
                </ul>
            </li>
            -->
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
<!-- END NAVIGATION -->