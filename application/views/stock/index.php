<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-stock" data-widget-editbutton="false">
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
                    <h2>Inventario / Stock </h2>
                    
                    <div role="menu" class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->
                        <!--
                        <a href="<?=  base_url()?>productos/create" class="btn btn-success">
                            <i class="fa fa-plus"></i> Nuevo
                        </a>
                        -->
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
                        <div class="widget-body-toolbar form-inline text-center">
                            <label>Establecimiento</label>
                            <?=  form_dropdown("est", $establecimientos,$est_id, 'class="form-control" id="est"')?>
                        </div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>                                    
                                    <th>Código</th>
                                    <th>Nombre</th>									
                                    <th>Cantidad</th>                                    
                                </tr>
                            </thead>
                            <tbody>                                
                                <? foreach ($lista as $m): ?>                                    
                                    <tr>
                                        <td>
                                            <a href="<?=  base_url()?>stock/edit/<?= $m->establecimiento_id ?>/<?= $m->producto_id ?>" class="btn btn-primary btn-xs" title="Editar"><i class="fa fa-edit"></i></a>
                                            <a href="<?=  base_url()?>stock/kardex/<?= $m->establecimiento_id ?>/<?= $m->producto_id ?>" class="btn btn-default btn-xs" title="Kardex"><i class="fa fa-tasks"></i></a>
                                        </td>                                        
                                        <td><?= $m->codigo ?></td>
                                        <td><?= $m->nombre ?></td>
                                        <td><span class="label label-<?=$m->id ? 'info' : 'danger'?>"><?= $m->cantidad == NULL ? '--No existe--' : $m->cantidad ?></span></td>                                        
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