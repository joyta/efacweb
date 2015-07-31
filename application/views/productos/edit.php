<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-categoria-edit" data-widget-editbutton="false">
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
                    <h2>Editar producto</h2>
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
                        
                        <form id="frmEdit" class="form-horizontal" method="post" action="<?=  base_url()?>productos/save">
                            <input type="hidden" id="id" nombre="id" value="<?=$producto->id?>"/>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Datos Generales</legend>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Codigo</label>
                                            <div class="col-md-10">
                                                <input name="codigo" id="codigo" class="form-control required" placeholder="Código del producto" type="text" maxlength="15" value="<?= $producto->codigo ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nombre</label>
                                            <div class="col-md-10">
                                                <input name="nombre" id="nombre" class="form-control required" placeholder="Nombre del producto" type="text" maxlength="255" value="<?= $producto->nombre ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="marca_id">Marca</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("marca_id", $marcas, $producto->marca_id, 'id="marca_id", class="select2 required"') ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="categoria_id">Categoria</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("categoria_id", $categorias, $producto->categoria_id, 'id="categoria_id", class="required select2"') ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="tipo">Tipo</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("tipo", array('Final'=>'Final','Servicio'=>'Servicio'), $producto->tipo, 'id="tipo", class="form-control required"') ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="tipo">Tipo stock</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("tipo_stock", array('Normal'=>'Normal','Serie'=>'Serie'), $producto->tipo_stock, 'id="tipo_stock", class="form-control required"') ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="estado">Estado</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("estado", array('Activo'=>'Activo','Inactivo'=>'Inactivo'), $producto->estado, 'id="estado", class="form-control required"') ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Cantidad mínima</label>
                                            <div class="col-md-10">
                                                <input name="cantidad_minima" id="cantidad_minima" class="form-control required numeric text-right" placeholder="Cantidad mínima" type="text" maxlength="15" value="<?= $producto->cantidad_minima ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Cantidad máxima</label>
                                            <div class="col-md-10">
                                                <input name="cantidad_maxima" id="cantidad_maxima" class="form-control required numeric text-right" placeholder="Cantidad máxima" type="text" maxlength="15" value="<?= $producto->cantidad_maxima ?>">
                                            </div>
                                        </div>
                                        
                                    </fieldset>
                                </div>                                                                
                                
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Impuestos</legend>                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">IVA</label>
                                            <div class="col-md-10">
                                                <div class="radio">
                                                    <label>                                                        
                                                        <input class="radiobox style-0" <?=($producto->iva=='f'?'checked="checked"':'')?> id="iva" name="iva" value="iva0" type="radio"/>
                                                        <span>IVA 0%</span> 
                                                    </label>
                                                </div>
                                                
                                                <div class="radio">
                                                    <label>
                                                        <input class="radiobox style-0" <?=($producto->iva=='t'?'checked="checked"':'')?> id="iva" name="iva" value="iva12" type="radio"/>
                                                        <span>IVA 12%</span> 
                                                    </label>
                                                </div>                                                
                                            </div>
                                        </div>                                                                                
                                    </filedset>
                                </div>
                                
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Unidades</legend>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="tipo_unidad">Tipo</label>
                                            <div class="col-md-10">
                                                <?= form_dropdown("tipo_unidad", array('Unidades'=>'Unidades','Longitud'=>'Longitud','Volumen'=>'Volumen','Peso'=>'Peso','Tiempo'=>'Tiempo'), $producto->tipo_unidad, 'id="tipo_unidad", class="form-control required"') ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="unidad_id">Unidad Inventario</label>
                                            <div class="col-md-10 div-unidades-inv">
                                                <?= form_dropdown("unidad_id", $unidades, $producto->unidad_id, 'id="unidad_id" class="form-control required"') ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="unidadcompra_id">Unidad Compra</label>
                                            <div class="col-md-10 div-unidades-cmp">
                                                <?= form_dropdown("unidadcompra_id", $unidades, $producto->unidadcompra_id, 'id="unidadcompra_id" class="form-control required"') ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>productos/index">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="GuardarProducto();" class="btn btn-primary" type="button">
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