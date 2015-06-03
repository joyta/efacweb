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
                    <h2>Ver cierre de caja</h2>
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
                        
                        <form id="frmEdit" class="form-horizontal" method="post" action="<?=  base_url()?>caja/apertura">
                            <input type="hidden" id="id" nombre="id" value="<?=$model->id?>"/>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Datos del cierre</legend>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">(+) Apertura</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static"><?=$model->monto_apertura?></p>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">(+) Ventas efectivo</label>
                                                <div class="col-md-4">                                                    
                                                    <p class="form-control-static"><?=$model->ventas_efectivo?></p>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">(+) Recaudaciones cxc</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static"><?=$model->recaudaciones_efectivo?></p>                                                    
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">(-) Pagos cxp</label>
                                                <div class="col-md-4">                                                    
                                                    <p class="form-control-static"><?=$model->pagos_efectivo?></p>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Total efectivo</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static"><?=$model->total_efectivo?></p>                                                    
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Total existente</label>
                                                <div class="col-md-4">                                                    
                                                    <p class="form-control-static"><?=$model->total_existente?></p>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Diferencia</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static"><?=$model->diferencia?></p>
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
                                                <p class="form-control-static"><?=$model->total_ventas?></p>                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Ventas contado</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static"><?=$model->ventas_contado?></p>                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Ventas crédito</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static"><?=$model->ventas_credito?></p>                                                
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Datos generales</legend>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Usuario</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static"><?=$usuario->descripcion?></p>                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Establecimiento</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static"><?=$establecimiento->nombre?></p>                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Apertura</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static"><?=$model->fecha_apertura?></p>                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Cierre</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static"><?=$model->fecha_cierre?></p>                                                
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            
                            
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-download" class="btn btn-primary" href="<?=  base_url()?>caja/ver_cierre/<?=$model->id?>/download">
                                            <i class="fa fa-download"></i> Descargar
                                        </a>
                                        
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>admin/dashboard">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        
                                        
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