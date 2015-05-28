<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-puntoemision-edit" data-widget-editbutton="false">
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
                    <h2>Editar punto emisión</h2>
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
                        
                        <form id="frmEdit" class="form-horizontal" method="post" action="<?=  base_url()?>establecimientos/save">
                            <input type="hidden" id="id" nombre="id" value="<?=$model->id?>"/>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Datos Generales</legend>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Código</label>
                                            <div class="col-md-10">
                                                <input name="codigo" id="codigo" class="form-control required" placeholder="001-001" type="text" minlength="7" maxlength="7" value="<?= $model->codigo ?>" maxlength="7">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="usuario_id">Usuario</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("usuario_id", $usuarios, $model->usuario_id, 'id="usuario_id", class="form-control required"') ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="establecimiento_id">Establecimiento</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("establecimiento_id", $establecimientos, $model->establecimiento_id, 'id="establecimiento_id", class="form-control required"') ?>
                                            </div>
                                        </div>                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="tipo_documento">Tipo Documento</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("tipo_documento", array(''=>'--Seleccione--','1'=>'Factura','4'=>'Nota Crédito'), $model->tipo_documento, 'id="tipo_documento", class="form-control required"') ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Secuencial</label>
                                            <div class="col-md-10">
                                                <input name="secuencial" id="secuencial" class="form-control required text-right" placeholder="1" type="text" value="<?= $model->secuencial ?>">
                                            </div>
                                        </div>
                                                                                

                                    </fieldset>
                                </div>                                                                                               
                            </div>
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>puntosemision/index">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="GuardarPuntoEmision();" class="btn btn-primary" type="button">
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