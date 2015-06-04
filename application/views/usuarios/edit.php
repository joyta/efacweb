<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-usuario-edit" data-widget-editbutton="false">
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
                    <h2>Editar usuario</h2>
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
                        
                        <form id="frmEdit" class="form-horizontal" method="post" action="<?=  base_url()?>usuarios/save">
                            <input type="hidden" id="id" nombre="id" value="<?=$usuario->id?>"/>
                            
                            <fieldset>
                                <legend>Datos</legend>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nombre</label>
                                <div class="col-md-10">
                                    <input name="nombre" id="nombre" class="form-control required alphanumeric nowhitespace" placeholder="Login del usuario" type="text" maxlength="15" value="<?=$usuario->nombre?>" <?=$usuario->id ? 'readonly="readonly"':''?>/>
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-md-2 control-label">Clave</label>
                                <div class="col-md-10">
                                    <input name="clave" id="clave" class="form-control required" placeholder="Clave del usuario" type="password" maxlength="255" value="<?=$usuario->clave?>"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 control-label">Descripción</label>
                                <div class="col-md-10">
                                    <input name="descripcion" id="descripcion" class="form-control required" placeholder="Descripción o nombres completos" type="text" maxlength="255" value="<?=$usuario->descripcion?>">
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="establecimiento_id">Establecimiento</label>
                                <div class="col-md-10">
                                    <?= form_dropdown("establecimiento_id", $establecimientos, $usuario->establecimiento_id, 'id="establecimiento_id", class="form-control required"') ?>
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="estado">Rol</label>
                                <div class="col-md-10">
                                    <?= form_dropdown("rol", array('Administrador'=>'Administrador','Vendedor'=>'Vendedor','Bodeguero'=>'Bodeguero'), $usuario->estado, 'id="rol", class="form-control required"') ?>
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="estado">Estado</label>
                                <div class="col-md-10">
                                    <?= form_dropdown("estado", array('Activo'=>'Activo','Inactivo'=>'Inactivo'), $usuario->estado, 'id="estado", class="form-control required"') ?>
                                </div>
                            </div>
                                
                            </fieldset>
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>usuarios/index">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="GuardarUsuario();" class="btn btn-primary" type="button">
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