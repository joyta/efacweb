<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-partner-edit" data-widget-editbutton="false">
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
                    <h2>Editar partner</h2>
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
                        
                        <form id="frmEdit" class="form-horizontal" method="post" action="<?=  base_url()?>productos/save">
                            <input type="hidden" id="id" nombre="id" value="<?=$model->id?>"/>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Datos Generales</legend>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="tipo_documento">Tipo Documento</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("tipo_documento", array('Cedula'=>'Cédula','Ruc'=>'Ruc','Pasaporte'=>'Pasaporte','ClienteOcacional'=>'Cliente ocacional'), $model->tipo_documento, 'id="tipo_documento", class="form-control required"') ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Documento</label>
                                            <div class="col-md-10">
                                                <input name="documento" id="documento" class="form-control required" placeholder="Número del documento" type="text" value="<?= $model->documento ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Razón Social</label>
                                            <div class="col-md-10">
                                                <input name="razon_social" id="razon_social" class="form-control required" placeholder="Razón social" type="text" value="<?= $model->razon_social ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nombre Comercial</label>
                                            <div class="col-md-10">
                                                <input name="nombre_comercial" id="nombre_comercial" class="form-control required" placeholder="Nombre comercial" type="text" value="<?= $model->nombre_comercial ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Es proveedor</label>
                                            <div class="col-md-10">
                                                <input name="is_proveedor" id="is_proveedor" class="form-control" placeholder="Es proveedor" type="checkbox" value="1" <?= $model->is_proveedor=='t' ?"checked=''":""?> />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="estado">Estado</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("estado", array('Activo'=>'Activo','Inactivo'=>'Inactivo'), $model->estado, 'id="estado", class="form-control required"') ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>                                                                
                                
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Direción </legend>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Celular</label>
                                            <div class="col-md-10">
                                                <input name="celular" id="celular" class="form-control required" placeholder="Celular" type="text" value="<?= $model->celular ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Teléfono</label>
                                            <div class="col-md-10">
                                                <input name="telefono" id="telefono" class="form-control required" placeholder="Teléfono" type="text" value="<?= $model->telefono ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Email</label>
                                            <div class="col-md-10">
                                                <input name="email" id="email" class="form-control required email" placeholder="Email" type="text" value="<?= $model->email ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Dirección</label>
                                            <div class="col-md-10">
                                                <input name="direccion" id="direccion" class="form-control required" placeholder="Dirección" type="text" value="<?= $model->direccion ?>">
                                            </div>
                                        </div>
                                        
                                    </filedset>
                                </div>                                
                            </div>
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>partners">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="GuardarPartner();" class="btn btn-primary" type="button">
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