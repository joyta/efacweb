<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-empresa" data-widget-editbutton="false">
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
                    <h2>Editar empresa</h2>
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
                        
                        <form id="frmEdit" class="form-horizontal" method="post" action="<?=  base_url()?>empresas/save">
                            
                            <input type="hidden" id="id" nombre="id" value="<?=$model->id?>"/>
                            <input type="hidden" id="estado" nombre="estado" value="Activo"/>
                            <input type="hidden" id="tipo_documento" nombre="tipo_documento" value="Ruc"/>
                            <input type="hidden" id="is_proveedor" nombre="is_proveedor" value="<?=$model->is_proveedor=='t' ?"TRUE":"FALSE"?>"/>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Datos Generales</legend>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Ruc</label>
                                            <div class="col-md-10">
                                                <input name="documento" id="documento" class="form-control required" placeholder="Número de ruc" type="text" maxlength="14" value="<?= $model->documento ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Razón Social</label>
                                            <div class="col-md-10">
                                                <input name="razon_social" id="razon_social" class="form-control required" placeholder="Razón social" type="text" maxlength="255" value="<?= $model->razon_social ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nombre Comercial</label>
                                            <div class="col-md-10">
                                                <input name="nombre_comercial" id="nombre_comercial" class="form-control required" placeholder="Nombre comercial" type="text" maxlength="255" value="<?= $model->nombre_comercial ?>">
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
                                                <input name="celular" id="celular" class="form-control required" placeholder="Celular" type="text" maxlength="25" value="<?= $model->celular ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Teléfono</label>
                                            <div class="col-md-10">
                                                <input name="telefono" id="telefono" class="form-control required" placeholder="Teléfono" type="text" maxlength="25" value="<?= $model->telefono ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Email</label>
                                            <div class="col-md-10">
                                                <input name="email" id="email" class="form-control required email" placeholder="Email" type="text" maxlength="255" value="<?= $model->email ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Dirección</label>
                                            <div class="col-md-10">
                                                <input name="direccion" id="direccion" class="form-control required" placeholder="Dirección" type="text" maxlength="255" value="<?= $model->direccion ?>">
                                            </div>
                                        </div>
                                        
                                    </filedset>
                                </div>                                
                            </div>
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>empresas">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="GuardarEntidad();" class="btn btn-primary" type="button">
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