<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-puntosemision" data-widget-editbutton="false">
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
                    <h2>Lista de puntos de emisión </h2>
                    
                    <div role="menu" class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->
                        <a href="<?=  base_url()?>puntosemision/create" class="btn btn-success">
                            <i class="fa fa-plus"></i> Nuevo
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
                                    <th>Código</th>
                                    <th>Secuencial</th>									
                                    <th>Documento</th>
                                    <th>Usuario</th>
                                    <th>Establecimiento</th>                                    
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                <? foreach ($lista as $m): ?>                                    
                                    <tr>
                                        <td>
                                            <a href="<?=  base_url()?>puntosemision/edit/<?= $m->id ?>" class="btn btn-primary btn-xs" title="Editar"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-xs lnk-delete" title="Eliminar" <?=$m->estado=='f' ? 'disabled="disabled"':''?> onclick="EliminarPuntoEmision(<?= $m->id ?>, '<?= $m->codigo ?>', this);"><i class="fa fa-recycle"></i></a>
                                        </td>
                                        <td><?= $m->id ?></td>
                                        <td><?= $m->codigo ?></td>
                                        <td><?= $m->secuencial ?></td>
                                        <td><?= $m->tipo_documento ?></td>
                                        <td><?= $m->usuario_nombre ?></td>
                                        <td><?= $m->establecimiento_nombre ?></td>                                        
                                        <td class="estado"><span class="label label-<?= $m->estado == 't'?'success':'danger' ?>"><?= $m->estado == 't'?'Activa':'Inactiva' ?></span></td>
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