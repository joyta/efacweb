<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-compra-ver" data-widget-editbutton="false">
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
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <label class="col-md-2 control-label">Partner: </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static">
                                            <a href="<?= base_url() ?>partners/edit/<?= $partner->id ?>" target="_blank" title="Editar partner">
                                                <i class="fa fa-pencil"></i>
                                                <?= $partner->documento ?> - <?= $partner->razon_social ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-2 control-label">Dirección: </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static"><?= $partner->direccion ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-2 control-label">Email: </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static"><?= $partner->email ?> | Teléfono: <?= $partner->telefono ?></p>
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
                                    <h1 class="font-400 col-md-12 text-right">Factura</h1>                                    
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
                            <legend></legend>                                                               

                            <table id="detalle" class="table table-bordered" style="width: 100%">
                                <col width="32"/>
                                <col width="120"/>
                                <col width="200"/>
                                <col width="120"/>
                                <col width="120"/>
                                <col width="120"/>                                    
                                <thead>
                                    <tr>                                            
                                        <th>Código</th>
                                        <th>Descripcion</th>                                            
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? foreach ($detalles as $d): ?>
                                        <tr>
                                            <td><?= $d->codigo ?></td>
                                            <td><?= $d->descripcion ?></td>
                                            <td class="text-right"><?= $d->cantidad ?></td>
                                            <td class="text-right"><?= $d->precio_unitario ?></td>
                                            <td class="text-right"><?= $d->descuento ?></td>
                                            <td class="text-right"><?= $d->precio_total_sin_impuestos ?></td>
                                        </tr>
                                    <? endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right">Sub Total</td>
                                        <td class="text-right">
                                            <span><?= $comprobante->total_sin_impuestos ?></span>                                                
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-right">Base Iva 0</td>
                                        <td class="text-right">                                                
                                            <span><?= $comprobante->baseIva0 ?></span>
                                        </td>
                                    </tr>                                        
                                    <tr>
                                        <td colspan="5" class="text-right">Base Iva 12</td>
                                        <td class="text-right">                                                
                                            <span><?= $comprobante->baseIva12 ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-right">Iva 12</td>
                                        <td class="text-right">
                                            <span><?= $comprobante->iva12 ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-right">Descuento</td>
                                        <td class="text-right">                                                
                                            <span><?= $comprobante->total_descuento ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-right">Total</td>
                                        <td class="text-right">                                                
                                            <span><?= $comprobante->importe_total ?></span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </fieldset>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <a id="btn-cancel" class="btn btn-default" href="<?= base_url() ?>compras/index">
                                        <i class="fa fa-backward"></i> Cancelar
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