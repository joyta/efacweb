<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-rep-cierres" data-widget-editbutton="true" data-widget-refreshbutton="true">
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
                    <h2>Lista de cierres de caja </h2>

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
                            <form class="form-inline" action="<?=  base_url()?>reportes/cierres_caja" method="post">
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
                                    <th></th>
                                    <th>Apertura</th>
                                    <th>Cierre</th>
                                    <th>Usuario</th>
                                    <th>Establecimiento</th>    
                                    <th class="text-right">Apertura</th>
                                    <th class="text-right">Ventas efectivo</th>
                                    <th class="text-right">Recaudaciones</th>
                                    <th class="text-right">Pagos</th>
                                    <th class="text-right">Total</th>
                                    <th class="text-right">Existente</th>
                                    <th class="text-right">Diferencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?  foreach ($lista as $item):?>
                                <tr>
                                    <td><a href="<?=  base_url()?>caja/ver_cierre/<?=$item->id?>/download"><i class="fa fa-download"></i></a></td>
                                    <td><?=  date('d-m-Y H:i', strtotime($item->fecha_apertura))?></td>
                                    <td><?=  date('d-m-Y H:i', strtotime($item->fecha_cierre))?></td>
                                    <td><?=$item->usuario?></td>
                                    <td><?=$item->establecimiento?></td>                                                                        
                                    <td class="text-right"><?=  number_format($item->monto_apertura,2)?></td>
                                    <td class="text-right"><?=  number_format($item->ventas_efectivo,2)?></td>
                                    <td class="text-right"><?=  number_format($item->recaudaciones_efectivo,2)?></td>
                                    <td class="text-right"><?=  number_format($item->pagos_efectivo,2)?></td>
                                    <td class="text-right"><?=  number_format($item->total_efectivo,2)?></td>
                                    <td class="text-right"><?=  number_format($item->total_existente,2)?></td>
                                    <td class="text-right"><?=  number_format($item->diferencia,2)?></td>
                                </tr>
                                <? endforeach;?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-right" colspan="5">Totales: </th>                                                                        
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->monto_apertura;}),2)?></th>
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->ventas_efectivo;}),2)?></th>
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->recaudaciones_efectivo;}),2)?></th>
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->pagos_efectivo;}),2)?></th>
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->total_efectivo;}),2)?></th>
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->total_existente;}),2)?></th>
                                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->diferencia;}),2)?></th>
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