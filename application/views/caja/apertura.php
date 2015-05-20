<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-apertura-caja" data-widget-editbutton="false">
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
                    <h2>Apertura de caja</h2>
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
                            
                            <fieldset>
                                <legend>Datos de apertura</legend>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Apertura</label>
                                <div class="col-md-4">
                                    <input name="monto_apertura" id="monto_apertura" class="form-control required text-right numeric" placeholder="Monto de apertura" type="text" value="<?=$model->monto_apertura?>">
                                </div>
                            </div>
                            
                            </fieldset>
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>admin/dashboard">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="Apertura();" class="btn btn-primary" type="button">
                                            <i class="fa fa-save"></i> Abrir caja
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