<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-rep-stock-min" data-widget-editbutton="true" data-widget-refreshbutton="true">
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
                    <h2>Lista de productos bajo la cantidad mínima </h2>

                    <div role="menu" class="widget-toolbar">
                    </div>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-refres">
                        <!-- This area used as dropdown edit box -->                                
                    </div>
                    <!-- end widget edit box -->
                    
                    

                    <!-- widget content -->
                    <div class="widget-body">
                        
                        <div class="widget-body-toolbar">
                        <form class="form-inline" action="<?=  base_url()?>reportes/stock_minimo" method="post">                            
                            <div class="form-group">
                                <label>Establecimiento: </label>
                                <?=  form_dropdown("establecimiento", $establecimientos, $establecimiento->id, 'class="form-control"')?>
                            </div>
                            <button class="btn btn-info" name="accion" value="buscar"><i class="fa fa-search"></i> Buscar</button>
                            <button class="btn btn-danger" name="accion" value="pdf"><i class="fa fa-file-pdf-o"></i> Pdf</button>
                        </form>
                        </div>
                        
                        <table id="dt_basic" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>                                                                        
                                    <th class="text-right">Cantidad</th>
                                    <th class="text-right">Cant. Mínima</th>
                                    <th class="text-right">Cant. Máxima</th>
                                    <th class="text-right">Faltante</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?  foreach ($lista as $item):?>
                                <tr>                                    
                                    <td><?=$item->codigo?></td>
                                    <td><?=$item->nombre?></td>                                    
                                    <td class="text-right"><?=  number_format($item->cantidad,2)?></td>
                                    <td class="text-right"><?=  number_format($item->cantidad_minima,2)?></td>
                                    <td class="text-right"><?=  number_format($item->cantidad_maxima,2)?></td>                                    
                                    <td class="text-right"><?=  number_format($item->cantidad_minima - $item->cantidad,2)?></td>                                    
                                </tr>
                                <? endforeach;?>
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