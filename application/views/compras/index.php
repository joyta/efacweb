<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-compras" data-widget-editbutton="true">
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
                    <h2>Lista de comprobantes de compra</h2>

                    <div role="menu" class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->
                        <a href="<?=  base_url()?>compras/create" class="btn btn-success">
                            <i class="fa fa-plus"></i> Nueva
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

                        <table id="dt_basic" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>                                    
                                    <th>Número</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Proveedor</th>
                                    <th>Establecimiento</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                <? foreach ($lista as $m): ?>                                    
                                    <tr>
                                        <td>
                                            <a href="<?=  base_url()?>compras/ver/<?= $m->id ?>" class="btn btn-default btn-xs" title="Ver"><i class="fa fa-eye"></i></a>                                            
                                        </td>
                                        <td><?= $m->id ?></td>
                                        <td><?= $m->numero ?></td>
                                        <td><?= date('d-m-Y', strtotime($m->fecha)) ?></td>
                                        <td><?= label_tipo_comprobante($m->tipo) ?></td>
                                        <td><?= $m->ruc.' - '.$m->nombre_proveedor?></td>
                                        <td><?= $m->establecimiento_nombre ?></td>
                                        <td><?= label_estado_comprobante($m->estado) ?></td>
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