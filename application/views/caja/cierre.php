<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-cierre-caja" data-widget-editbutton="false">
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
                    <h2>Cierre de caja</h2>
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
                        <div class="widget-body-toolbar">                           
                        </div>
                        
                        <form id="frmEdit" class="form-horizontal" method="post" action="<?=  base_url()?>caja/apertura">
                            <input type="hidden" id="id" nombre="id" value="<?=$model->id?>"/>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Datos del cierre</legend>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">(+) Apertura</label>
                                                <div class="col-md-4">
                                                    <input name="monto_apertura" id="monto_apertura" class="form-control required text-right numeric" placeholder="Monto de apertura" type="text" readonly="readonly" value="<?=$model->monto_apertura?>">
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">(+) Ventas efectivo</label>
                                                <div class="col-md-4">
                                                    <input name="ventas_efectivo" id="ventas_efectivo" class="form-control required text-right numeric" placeholder="Monto de apertura" type="text" readonly="readonly" value="<?=$model->ventas_efectivo?>">
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">(+) Recaudaciones cxc</label>
                                                <div class="col-md-4">
                                                    <input name="recaudaciones_efectivo" id="recaudaciones_efectivo" class="form-control required text-right numeric" placeholder="Monto de apertura" readonly="readonly" type="text" value="<?=$model->recaudaciones_efectivo?>">
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">(-) Pagos cxp</label>
                                                <div class="col-md-4">
                                                    <input name="pagos_efectivo" id="pagos_efectivo" class="form-control required text-right numeric" placeholder="Monto de apertura" type="text" readonly="readonly" value="<?=$model->pagos_efectivo?>">
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Total efectivo</label>
                                                <div class="col-md-4">
                                                    <input name="total_efectivo" id="total_efectivo" class="form-control required text-right numeric" placeholder="Total efectivo" type="text" readonly="readonly" value="<?=$model->total_efectivo?>">
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Total existente</label>
                                                <div class="col-md-4">
                                                    <input name="total_existente" id="total_existente" class="form-control required text-right numeric" placeholder="Total efectivo" type="text" value="<?=$model->total_existente?>">
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Diferencia</label>
                                                <div class="col-md-4">
                                                    <input name="diferencia" id="diferencia" class="form-control required text-right numeric-neg" placeholder="Diferencia" type="text" readonly="readonly" value="<?=$model->diferencia?>">
                                                </div>
                                            </div>

                                        </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Ventas</legend>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Total ventas</label>
                                            <div class="col-md-4">
                                                <input name="total_ventas" id="total_ventas" class="form-control required text-right numeric" placeholder="Total de ventas" type="text" readonly="readonly" value="<?=$model->total_ventas?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Ventas contado</label>
                                            <div class="col-md-4">
                                                <input name="ventas_contado" id="ventas_contado" class="form-control required text-right numeric" placeholder="Ventas al contado" type="text" readonly="readonly" value="<?=$model->ventas_contado?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Ventas crédito</label>
                                            <div class="col-md-4">
                                                <input name="ventas_credito" id="ventas_credito" class="form-control required text-right numeric" placeholder="Ventas a crédito" type="text" readonly="readonly" value="<?=$model->ventas_credito?>">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            
                            
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>admin/dashboard">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="Cierre();" class="btn btn-primary" type="button">
                                            <i class="fa fa-save"></i> Cerrar caja
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