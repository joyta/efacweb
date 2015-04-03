<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-venta-nc" data-widget-editbutton="false">
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
                    <h2>Nota de crédito</h2>
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
                        
                        <form id="frmEdit" class="form-horizontal" method="post" action="<?=  base_url()?>ventas/save_nota_credito">
                                                        
                            <input type="hidden" id="comprobante_referencia_id" name="comprobante[referencia_id]" value="<?=$comprobante->referencia_id?>"/>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                <legend>Datos</legend>
                            
                            <div class="form-group">
                                <label class="col-md-2 control-label">Identificación</label>
                                <div class="col-md-3">
                                    <?= form_dropdown("entidad[tipo_documento]", array('Cedula'=>'Cédula','Ruc'=>'Ruc','Pasaporte'=>'Pasaporte','ClienteOcacional'=>'Cliente ocacional'), 'Cedula', 'id="entidad_tipo_documento", class="form-control required"') ?>                                    
                                </div>
                                <div class="col-md-7">
                                    <input name="entidad[documento]" id="entidad_documento" class="form-control required cliente" placeholder="Ci / ruc o pasaporte" type="text" value="<?=$entidad->documento?>">
                                </div>
                            </div>                                                            
                                
                            <div class="form-group">
                                <label class="col-md-2 control-label">Razon Social</label>
                                <div class="col-md-10">
                                    <input name="entidad[razon_social]" id="entidad_razon_social" class="form-control required cliente" placeholder="Apellidos y Nombres" type="text" value="<?=$entidad->razon_social?>">
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-md-2 control-label">Dirección</label>
                                <div class="col-md-10">
                                    <input name="entidad[direccion]" id="entidad_direccion" class="form-control required" placeholder="Dirección" type="text" value="<?=$entidad->direccion?>">
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-md-2 control-label">Email</label>
                                <div class="col-md-10">
                                    <input name="entidad[email]" id="entidad_email" class="form-control required" placeholder="Email" type="text" value="<?=$entidad->email?>">
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-md-2 control-label">Teléfono</label>
                                <div class="col-md-10">
                                    <input name="entidad[telefono]" id="entidad_telefono" class="form-control required" placeholder="Teléfono" type="text" value="<?=$entidad->telefono?>">
                                </div>
                            </div>
                                
                                
                            
                            </fieldset>
                                </div>
                            </div>
                            
                            <fieldset>
                                <legend>Productos</legend>
                                <!---
                                <div class="form-group">
                                    <label class="col-md-1 control-label">Cantidad</label>
                                    <div class="col-md-1">
                                        <input id="cantidad" type="text" value="1" class="form-control"/>
                                    </div>
                                    
                                    <label class="col-md-1 control-label">Producto</label>
                                    <div class="col-md-8">
                                        <input id="producto" type="text" value="" class="form-control producto"/>
                                    </div>                                    
                                </div> 
                                -->
                                
                                <table id="detalle" class="table table-bordered">
                                    <col width="32"/>
                                    <col width="100"/>
                                    <col width="300"/>
                                    <col width="100"/>
                                    <col width="100"/>
                                    <col width="150"/>
                                    <col width="100"/>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Código</th>
                                            <th>Descripcion</th>                                            
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Descuento</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?  foreach ($detalles as $item):?>
                                        <tr data-uid='"+uid+"' data-id='"+item.id+"' data-cantidad='"+cantidad+"' data-iva='"+item.iva+"'>
                                            <td>
                                                <input type='hidden' property='producto_id' value='<?=$item->producto_id?>'/>
                                                <input type='hidden' property='unidad_id' value='<?=$item->unidad_id?>'/>
                                            </td>
                                            <td><input type='text' class='form-control required' style='width: 100px' readonly='' property='codigo' value='<?=$item->producto->codigo?>'/></td>
                                            <td><input type='text' class='form-control required' style='width: 300px' readonly='' property='descripcion' value='<?=$item->producto->nombre?>'/></td>
                                            <td><input type='text' class='form-control required text-right' style='width: 100px' readonly='' property='cantidad' value='<?=$item->cantidad?>'/></td>
                                            <td><input type='text' class='form-control required text-right' style='width: 100px' readonly='' property='precio_unitario' value='<?=$item->precio_unitario?>'/></td>
                                            <td>
                                                <div class='input-group'>
                                                    <input type='text' class='form-control required text-right' readonly='' property='descuento' value='<?=$item->descuento?>'/>
                                                    <div class='input-group-btn'>
                                                         <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' tabindex='-1'>
                                                                 <span class='caret'></span>
                                                         </button>
                                                         <ul class='dropdown-menu pull-right' role='menu'>
                                                             <li><a href='javascript:void(0);' class='desc-valor'>Valor ($)</a></li>
                                                             <li><a href='javascript:void(0);' class='desc-porce'>Porcentaje (%)</a></li>
                                                         </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><input type='text' class='form-control required text-right' style='width: 100px' readonly='' property='precio_total_sin_impuestos' value='<?=$item->precio_total_sin_impuestos?>'/></td>
                                        </tr>
                                        <?  endforeach;?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-right">Sub Total</td>
                                            <td>
                                                <input id="subtotal" name="comprobante[total_sin_impuestos]" value="<?=$comprobante->total_sin_impuestos?>" class="form-control text-right" readonly="readonly" style="width: 100px"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right">Base Iva 0</td>
                                            <td>
                                                <input id="baseIva0" name="comprobante[baseIva0]" value="<?=$comprobante->baseIva0?>" class="form-control text-right" readonly="readonly" style="width: 100px"/>
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td colspan="6" class="text-right">Base Iva 12</td>
                                            <td>
                                                <input id="baseIva12" name="comprobante[baseIva12]" value="<?=$comprobante->baseIva12?>" class="form-control text-right" readonly="readonly" style="width: 100px"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right">Iva 12</td>
                                            <td>
                                                <input id="iva12" name="comprobante[iva12]" value="<?=$comprobante->iva12?>" class="form-control text-right" readonly="readonly" style="width: 100px"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right">Descuento</td>
                                            <td>
                                                <input id="descuento" name="comprobante[total_descuento]" value="<?=$comprobante->total_descuento?>" class="form-control text-right" readonly="readonly" style="width: 100px"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right">Total</td>
                                            <td>
                                                <input id="total" name="comprobante[importe_total]" value="<?=$comprobante->importe_total?>" class="form-control text-right" readonly="readonly" style="width: 100px"/>					
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </fieldset>
                                                                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a id="btn-cancel" class="btn btn-default" href="<?=  base_url()?>ventas/ver/<?=$comprobante->id?>">
                                            <i class="fa fa-backward"></i> Cancelar
                                        </a>
                                        <button onclick="GuardaComprobante();" class="btn btn-primary" type="button">
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