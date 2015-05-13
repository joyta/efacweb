<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-ventas" data-widget-editbutton="true" data-widget-refreshbutton="true">
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
                    <h2>Lista de comprobantes de compra </h2>

                    <div role="menu" class="widget-toolbar">                        
                        <button id="btnRefresh" type="button" class="btn btn-success"><i class="fa fa-refresh"></i> Refrescar</button>
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
                            <form class="form-inline" action="<?=  base_url()?>reportes/compras" method="post">
                            <div class="form-group">
                                <label>Desde</label>
                                <input type="text" name="desde" class="form-control fecha" value="<?=$desde?>"/>
                            </div>   
                            <div class="form-group">
                                <label>Hasta</label>
                                <input type="text" name="hasta" class="form-control fecha" value="<?=$hasta?>"/>
                            </div> 
                            <div class="form-group">
                                <label>Usuario</label>
                                <?=  form_dropdown("usuario", $usuarios, $usuario, 'class="form-control"')?>
                            </div>
                            <button class="btn btn-info" name="accion" value="buscar"><i class="fa fa-search"></i> Buscar</button>
                            <button class="btn btn-danger" name="accion" value="pdf"><i class="fa fa-file-pdf-o"></i> Pdf</button>
                        </form>
                        </div>
                        
                        <table id="dt_basic" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Número</th>
                                    <th>Establecimiento</th>
                                    <th>Entidad</th>     
                                    <th>Usuario</th>
                                    <th class="text-right">Subtotal 0%</th>
                                    <th class="text-right">Subtotal 12%</th>
                                    <th class="text-right">Iva 12%</th>                                    
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?  foreach ($lista as $item):?>
                                <tr>
                                    <td><?=  date('d-m-Y', strtotime($item->fecha))?></td>
                                    <td><?=$item->numero?></td>
                                    <td><?=$item->establecimiento?></td>
                                    <td><?=$item->documento?> - <?=$item->razon_social?></td>      
                                    <td><?=$item->usuario?></td>
                                    <td class="text-right"><?=  number_format($item->baseIva0,2)?></td>
                                    <td class="text-right"><?=  number_format($item->baseIva12,2)?></td>
                                    <td class="text-right"><?=  number_format($item->iva12,2)?></td>                                    
                                    <td class="text-right"><?=  number_format($item->importe_total,2)?></td>
                                </tr>
                                <? endforeach;?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-right" colspan="5">Totales: </th>
                                    
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->baseIva0;}), 2)?></th>
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->baseIva12;}),2)?></th>
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->iva12;}),2)?></th>
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->importe_total;}),2)?></th>
                                </tr>
                            </tfoot>
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

<script src="<?= base_url() ?>js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.fecha').datepicker({
            dateFormat : 'yy-mm-dd',
            prevText : '<i class="fa fa-chevron-left"></i>',
            nextText : '<i class="fa fa-chevron-right"></i>'            
        });
    });
</script>