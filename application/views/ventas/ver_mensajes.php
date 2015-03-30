<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-venta-ver" data-widget-editbutton="false">
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
                    <h2>Ver comprobante</h2>
                    <div class="widget-toolbar">                        
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
                    <div class="widget-body form-horizontal">

                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <label class="col-md-2 control-label">Entidad: </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static">
                                            <a href="<?= base_url() ?>entidades/edit/<?= $entidad->id ?>" target="_blank" title="Editar entidad">
                                                <i class="fa fa-pencil"></i>
                                                <?= $entidad->documento ?> - <?= $entidad->razon_social ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-2 control-label">Dirección: </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static"><?= $entidad->direccion ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-2 control-label">Email: </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static"><?= $entidad->email ?> | Teléfono: <?= $entidad->telefono ?></p>
                                    </div>                                    
                                </div>

                                <div class="row">
                                    <label class="col-md-2 control-label">Clave acceso: </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static"><?= $comprobante->clave_acceso ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-2 control-label">Autorización: </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static"><?= $comprobante->numero_autorizacion ?></p>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="row">
                                    <h1 class="font-400 col-md-12 text-right text-success">Factura</h1>                                    
                                </div>
                                <div class="row">
                                    <label class="col-md-3 control-label">Número: </label>
                                    <div class="col-md-9 text-right">
                                        <p class="form-control-static"><strong><?= $comprobante->numero ?></strong></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-3 control-label">Fecha: </label>
                                    <div class="col-md-9 text-right">
                                        <p class="form-control-static"><?= $comprobante->fecha ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-2 control-label">Estado: </label>
                                    <div class="col-md-10 text-right">                                        
                                        <p class="form-control-static"><?= label_estado_comprobante($comprobante->estado) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        
                        <fieldset>
                            <legend>Mensajes</legend>                                                               

                            <table id="detalle" class="table table-bordered" style="width: 100%">                                                                
                                <thead>
                                    <tr>                                            
                                        <th>Identificador</th>
                                        <th>Mensaje</th>                                            
                                        <th>Información adicional</th>
                                        <th>Tipo</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <? foreach ($mensajes as $d): ?>
                                        <tr>
                                            <td><?= $d->identificador ?></td>
                                            <td><?= $d->mensaje ?></td>
                                            <td><?= $d->informacion_adicional ?></td>
                                            <td><?= $d->tipo ?></td>                                            
                                        </tr>
                                    <? endforeach; ?>
                                </tbody>                                
                            </table>
                        </fieldset>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <a id="btn-cancel" class="btn btn-default" href="<?= base_url() ?>ventas/no_autorizados">
                                        <i class="fa fa-backward"></i> Cancelar
                                    </a>    
                                    <a id="btn-cancel" class="btn btn-success" href="<?= base_url() ?>ventas/reenviar/<?=$comprobante->id?>" onclick="return confirm('¿Desea reenviar el comprobante?');">
                                        <i class="fa fa-repeat"></i> Reenviar
                                    </a> 
                                </div>
                            </div>
                        </div>                                               

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