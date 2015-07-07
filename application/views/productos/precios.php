<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-precios-edit" data-widget-editbutton="false">
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
                    <h2>Precios producto: <?=$producto->codigo?> - <?=$producto->nombre?></h2>
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
                        
                        <form id="frmEdit" class="form-horizontal" method="post" action="<?=  base_url()?>productos/save_precios">
                            <input type="hidden" id="producto_id" name="producto_id" value="<?=$producto->id?>"/>
                            
                            <div class="row">                                    
                                
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Lista de precios</legend>
                                    </fieldset>
                                    
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <th>Unidad venta</th>
                                            <th>Precio</th>
                                        </thead>
                                        <tbody>
                                            <?$index = 0;?>
                                            <?foreach ($precios as $m):?>
                                            <tr>
                                                <td>
                                                    <?=  form_hidden("precio[$index][id]", $m->id)?>
                                                    <?=  form_hidden("precio[$index][unidad_id]", $m->unidad_id)?>
                                                    <?=$m->unidad_nombre?>
                                                </td>
                                                <td>
                                                    <input name="precio[<?=$index?>][valor]" type="text" value="<?=$m->valor?>" class="form-control numeric text-right" placeholder="Dejar vacío para no vender en esta unidad"/>
                                                </td>
                                            </tr>
                                            <?$index ++;?>
                                            <? endforeach;?>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                
                                
                            </div>
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>productos/index">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="GuardarPrecios();" class="btn btn-primary" type="button">
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