<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-stock-edit" data-widget-editbutton="false">
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
                    <h2>Editar stock</h2>
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
                            <input type="hidden" id="producto_id" nombre="producto_id" value="<?=$producto->id?>"/>
                            <input type="hidden" id="establecimiento_id" nombre="establecimiento_id" value="<?=$stock->establecimiento_id?>"/>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Datos Generales</legend>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Codigo</label>
                                            <div class="col-md-10">
                                                <input name="codigo" id="codigo" class="form-control required" readonly="readonly" placeholder="Código del producto" type="text" value="<?= $producto->codigo ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nombre</label>
                                            <div class="col-md-10">
                                                <input name="nombre" id="nombre" class="form-control required" readonly="readonly" placeholder="Nombre del producto" type="text" value="<?= $producto->nombre ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Cantidad</label>
                                            <div class="col-md-10">
                                                <input name="cantidad" id="cantidad" class="form-control required" placeholder="Cantidad en stock" type="text" value="<?= $stock->cantidad ?>">
                                            </div>
                                        </div>

                                        
                                    </fieldset>
                                </div>                                                                
                                
                                <div class="col-md-6">
                                    
                                </div>                                
                            </div>
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>stock/index">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="GuardarStock();" class="btn btn-primary" type="button">
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

<script type="text/javascript">
    
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                cantidad: {                    
                    min: 0                    
                }                
            }                              
        }); 
    });       
    
    function GuardarStock(){
        if($('#frmEdit').valid()){            
            $.ajax({
                url: '<?=  base_url()?>stock/save',
                data: {
                    producto_id: $('#producto_id').val(),
                    establecimiento_id : $('#establecimiento_id').val(),
                    cantidad: $('#cantidad').val()                    
                },
                type: 'post',
                dataType: 'json',
                cache:false,
                success: function(data){
                    if(data.status === 'ok'){
                        efac.infoBox('La información ha sido guardada correctamente.', function(){
                            $('#btn-cancel')[0].click();
                        });                        
                    }else{
                        alert(data.status);
                    }
                },
                error: function(error){
                    alert(error.responseText);
                }
            });
        }
    };
</script>