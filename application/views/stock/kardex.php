<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-kardex" data-widget-editbutton="false">
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
                    <h2>Inventario / Stock / Kardex </h2>
                    
                    <div role="menu" class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->
                        <a href="<?=  base_url()?>stock/index" class="btn btn-success">
                            <i class="fa fa-mail-reply"></i> Stock
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
                                    <th></th>
                                    <th></th>
                                    <th colspan="3">Entrada</th>
                                    <th colspan="3">Salida</th>
                                    <th colspan="3">Existente</th>
                                </tr>
                                <tr>                                    
                                    <th>Fecha</th>
                                    <th>Detalle</th>									
                                    <th>Cantidad</th>
                                    <th>V.Unitario</th>
                                    <th>C.Total</th>
                                    <th>Cantidad</th>
                                    <th>V.Unitario</th>
                                    <th>C.Total</th>
                                    <th>Cantidad</th>
                                    <th>V.Unitario</th>
                                    <th>C.Total</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                <? foreach ($lista as $m): ?>                                    
                                    <tr>                                                                               
                                        <td><?= $m->fecha ?></td>
                                        <td><?= $m->detalle ?></td>
                                        <td><?= $m->c_entrada  > 0 ? $m->c_entrada : '---' ?></td>
                                        <td><?= $m->vu_entrada > 0 ? $m->vu_entrada : '---' ?></td>
                                        <td><?= $m->ct_entrada > 0 ? $m->ct_entrada : '---' ?></td>
                                        <td><?= $m->c_salida > 0 ? $m->c_salida : '---' ?></td>
                                        <td><?= $m->vu_salida > 0 ? $m->vu_salida : '---' ?></td>
                                        <td><?= $m->ct_salida > 0 ? $m->ct_salida : '---' ?></td>
                                        <td><?= $m->c_existente ?></td>
                                        <td><?= $m->vu_existente ?></td>
                                        <td><?= $m->ct_existente ?></td>
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