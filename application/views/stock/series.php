<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-series" data-widget-editbutton="false">
                <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

                -->
                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Inventario / Stock / Series </h2>
                    
                    <div role="menu" class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->
                        <a href="<?=  base_url()?>stock/index" class="btn btn-success">
                            <i class="fa fa-mail-reply"></i> Stock
                        </a>
                        
                        <a href="<?=  base_url()?>reportes/series_disponibles/<?=$establecimiento->id?>/<?=$producto->id?>" class="btn btn-primary">
                            <i class="fa fa-download"></i>
                        </a>
                    </div>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar form-inline">
                            <strong>Establecimiento: </strong> <span><?=$establecimiento->nombre?></span>,
                            <strong>Producto: </strong> <span><?=$producto->codigo?> - <?=$producto->nombre?></span>
                        </div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover">
                            <thead>                                
                                <tr>
                                    <th>Número serie</th>									
                                    <th>Fecha compra</th>                                    
                                    <th>Número compra</th>                                   
                                </tr>
                            </thead>
                            <tbody>                                
                                <? foreach ($lista as $m): ?>                                    
                                    <tr>
                                        <td><?= $m->numero ?></td>
                                        <td><?= $m->fecha_compra ?></td>                                        
                                        <td><?= $m->numero_compra?></td>                                        
                                    </tr>
                                <? endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- WIDGET END -->

    </div>

    <!-- end row -->

    <!-- end row -->

</section>
<!-- end widget grid -->