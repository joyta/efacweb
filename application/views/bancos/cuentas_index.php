<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-cuentas_bancarias" data-widget-editbutton="true">
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
                    <h2>Lista de cuentas bancarias </h2>

                    <div role="menu" class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->
                        <a href="<?=  base_url()?>bancos/create_cuenta/<?=$model->id?>" class="btn btn-success">
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
                                    <th>Descripción</th>									
                                </tr>
                            </thead>
                            <tbody>                                
                                <? foreach ($lista as $m): ?>                                    
                                    <tr>
                                        <td>
                                            <a href="<?=  base_url()?>bancos/edit_cuenta/<?= $m->id ?>" class="btn btn-primary btn-xs" title="Editar"><i class="fa fa-edit"></i></a>
                                            <a href="<?=  base_url()?>bancos/chequeras/<?= $m->id ?>" class="btn btn-success btn-xs" title="Chequeras"><i class="fa fa-credit-card"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-xs" title="Eliminar" onclick="EliminarCuenta(<?= $m->id ?>, '<?= $m->descripcion ?>', this);"><i class="fa fa-recycle"></i></a>
                                        </td>
                                        <td><?= $m->id ?></td>
                                        <td><?= $m->numero ?></td>
                                        <td><?= $m->descripcion ?></td>
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