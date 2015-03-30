<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-trn_cxp_pago" data-widget-editbutton="true">
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
                    <h2>Cuentas por pagar </h2>

                    <div role="menu" class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->

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
                            <div class="col-md-6">
                                <h1 class="page-title txt-color-blueDark">
                                    <i class="fa-fw fa fa-user"></i> Proveedor: 
                                    <a title="Editar" href="<?= base_url() ?>partners/edit/<?= $partner->id ?>" target="_blank">
                                        <span class="txt-color-blue"><?= $partner->documento ?> - <?= $partner->razon_social ?></span>
                                    </a>
                                </h1>
                            </div>
                            <div class="col-md-6">                    
                                <dl class="dl-horizontal">
                                    <dt>Número cuotas: </dt>
                                    <dd><?= 0 ?></dd>

                                    <dt>Días plazo: </dt>
                                    <dd><?= $transaccion->dias_plazo ?></dd>

                                    <dt>Vencimiento: </dt>
                                    <dd><?= $transaccion->vence ?></dd>                        
                                </dl>
                            </div>
                        </div>

                        <div class="row">
                            <? if ($transaccion->saldo > 0): ?>
                                <div class="col-md-6">  
                                    <fieldset>
                                        <legend>Pago</legend>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Forma de pago</label>
                                            <div class="col-md-8">
                                                <select class="form-control required" id="pago_forma_pago" name="pago.forma_pago">                            
                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="Deposito">Deposito</option>
                                                    <option value="Transferencia">Transferencia</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="TarjetaCredito">Tarjeta de crédito</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Monto</label>
                                            <div class="col-md-8">
                                                <input id="pago_monto" name="pago.monto" type="text" class="required cantidad greater-than max_monto form-control text-right"/>                            
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Concepto</label>
                                            <div class="col-md-8">
                                                <input id="pago_concepto" name="pago.concepto" type="text" class="required form-control" maxlength = 255/>                            
                                            </div>
                                        </div>

                                        <div id="formaPago">
                                        </div>

                                        <div class="form-group has-warning div-abono" style="display: none;">
                                            <label class="col-md-4 control-label"><strong>Importe a abonar</strong></label>
                                            <div class="col-md-6">                            
                                                <input id="Abono" type="text" class="form-control text-right" disabled = ""/>     
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>   
                            <? endif; ?>            


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

</section>
<!-- end widget grid -->