<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-venta-cobro" data-widget-editbutton="false">
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
                    <h2>Cobro venta</h2>
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
                            <div class="pull-left">
                                <h1 class="page-title txt-color-blueDark">
                                    <i class="fa-fw fa fa-dollar"></i> Total: 
                                    <?=  number_format($comprobante->importe_total, 2)?>
                                </h1>
                            </div>   
                            <div class="pull-right">
                                <h1 class="page-title txt-color-blueDark">
                                    Saldo: 
                                    <i class="fa-fw fa fa-dollar"></i>                                    
                                    <label class="saldo-text"><?=  number_format($comprobante->importe_total, 2)?></label>
                                    &nbsp;
                                </h1>
                            </div>
                        </div>
                        

                        <form id="frmCobro" class="form-horizontal" method="post" action="<?= base_url() ?>ventas/save_cobro/<?=$comprobante->id?>">
                            
                            <input id="comprobante_fecha" type="hidden" value="<?=$comprobante->fecha?>"/>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Datos cobro</legend>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Forma</label>
                                            <div class="col-md-8">                                                
                                                <select class="form-control required" id="pago_forma_pago" name="pago[forma_pago]">                            
                                                    <option value="Efectivo" maxitems="1">Efectivo</option>
                                                    <option value="Deposito" maxitems="1000">Deposito</option>
                                                    <option value="Transferencia" maxitems="1000">Transferencia</option>
                                                    <option value="Cheque" maxitems="1000">Cheque</option>
                                                    <option value="TarjetaCredito" maxitems="1000">Tarjeta de crédito</option>
                                                    <option value="Credito" maxitems="1">Crédito</option>
                                                </select>
                                            </div>                                            
                                        </div>                                        
                                        
                                        <div id="formaPago">
                                        </div>         
                                        
                                        <div class="text-center">
                                            <button type="button" id="btnAddPago" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
                                        </div>
                                    </fieldset>
                                </div>
                                
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Datos factura</legend>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Número: </label>
                                            <p class="col-md-8 form-control-static"><?=$comprobante->numero?></p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Entidad: </label>
                                            <p class="col-md-8 form-control-static"><?=$entidad->documento?> - <?=$entidad->razon_social?></p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Fecha: </label>
                                            <p class="col-md-8 form-control-static"><?=$comprobante->fecha?></p>
                                        </div>
                                        
                                    </fieldset>
                                </div>
                                
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend>Cobros registrados</legend>
                                        <table id="dtPagos" class="table table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Forma de Pago</th>
                                                    <th>Monto</th>
                                                    <th>Cuenta Bancaria</th>
                                                    <th>Fecha Ref</th>
                                                    <th>Referencia</th>
                                                    <th>Depositante</th>
                                                    <th>Cuotas</th>
                                                    <th>Vence</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                            </div>



                            <div class="form-actions">
                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?= base_url() ?>ventas/index">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="GuardarTransaccion();" class="btn btn-success" type="button">
                                            <i class="fa fa-save"></i> Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>


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