<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-parametro-edit" data-widget-editbutton="false">
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
                    <h2>Editar parámetro</h2>
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
                        
                        <form id="frmEdit" class="form-horizontal" method="post" action="<?=  base_url()?>parametros/save">
                            <input type="hidden" id="id" nombre="id" value="<?=$model->id?>"/>
                            
                            <fieldset>
                                <legend>Datos</legend>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Código</label>
                                <div class="col-md-10">
                                    <input name="codigo" id="codigo" class="form-control required" placeholder="Nombre del parámetro" type="text" value="<?=$model->codigo?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 control-label">Descripción</label>
                                <div class="col-md-10">
                                    <input name="descripcion" id="descripcion" class="form-control required" placeholder="Descripción del parámetro" type="text" value="<?=$model->descripcion?>">
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="tipo">Tipo dato</label>
                                <div class="col-md-4">
                                    <?= form_dropdown("tipo", array('Cadena'=>'Cadena','Decimal'=>'Decimal','Booleano'=>'Booleano'), $model->tipo, 'id="tipo", class="form-control required"') ?>
                                </div>
                            </div>
                                
                            <div class="value-editor">
                                <input type="hidden" id="valor" name="valor" value="<?=$model->valor?>"/>
                            </div>
                            </fieldset>
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>parametros/index">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="Guardar();" class="btn btn-primary" type="button">
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