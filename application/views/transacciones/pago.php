<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-trn_cxp_pago" data-widget-editbutton="true">
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
                    <h2>Cuentas por pagar (<?=$transaccion->concepto?>)</h2>

                    <div role="menu" class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->

                    </div>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->                        
                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body form-horizontal">  
                        <div class="row">
                            <div class="pull-left">
                                <h1 class="page-title txt-color-blueDark">                            
                                    <i class="fa-fw fa fa-user"></i> Entidad: 
                                    <a title="Editar" href="<?= base_url() ?>entidades/edit/<?= $entidad->id ?>" target="_blank">
                                        <span class="txt-color-blue"><?= $entidad->documento ?> - <?= $entidad->razon_social ?></span>
                                    </a>                                                        
                                </h1>
                            </div>
                            
                            <small class="pull-left">
                                <strong>Número cuotas: </strong> <?= $transaccion->numero_cuotas ?> | 
                                <strong>Días plazo: </strong> <?= $transaccion->dias_plazo?> | 
                                <strong>Vencimiento: </strong> <?= date('d-m-Y', strtotime($transaccion->vence))?>
                            </small>
                        </div>
                                                
                        <form id="frmEdit" action="<?=  base_url()?>transacciones/save_pago/<?=$transaccion->id?>" method="post">
                            
                            <input type="hidden" id="transaccion_id" value="<?=$transaccion->id?>"/>
                            
                        <div class="row">
                            <? if ($transaccion->saldo > 0): ?>
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Pago</legend>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Forma de pago</label>
                                            <div class="col-md-8">
                                                <select class="form-control required" id="pago_forma_pago" name="pago[forma_pago]">                            
                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="Deposito">Deposito</option>
                                                    <option value="Transferencia">Transferencia</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <!--<option value="TarjetaCredito">Tarjeta de crédito</option>-->
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Concepto</label>
                                            <div class="col-md-8">
                                                <input id="pago_concepto" name="pago[concepto]" type="text" class="required form-control" maxlength = "255"/>                            
                                            </div>
                                        </div>
                                        
                                        <div id="formaPago">
                                        </div>

                                        <div class="form-group has-warning div-abono" style="display: none;">
                                            <label class="col-md-4 control-label"><strong>Importe a abonar</strong></label>
                                            <div class="col-md-6">                            
                                                <input id="Abono" type="text" class="form-control text-right" disabled = ""/>     
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3"></label>
                                            <div class="col-md-8">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-save"></i> Guardar
                                                </button>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>
                            
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Pendientes</legend>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>                                                    
                                                    <th>Concepto</th>
                                                    <th>Vence</th>
                                                    <th>Estado</th>
                                                    <th class="text-right">Monto</th>
                                                    <th class="text-right">Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?  foreach ($pendientes as $item):?>
                                                <tr class="<?=$item->id == $transaccion->id ? 'info':''?>">
                                                    <td>
                                                        <a href="javascript:void(0);" class="lnk-cuotas" data-toogle=".tr-cuota-<?=$item->id?>">
                                                            <i class="fa fa-plus-square"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?if($item->saldo > 0):?>
                                                        <input type="checkbox" <?=$item->id == $transaccion->id ? 'checked':''?> name="facturas[]" value="<?=$item->id?>" saldo="<?=$item->saldo?>" numero="<?=$item->concepto?>" class="factura factura-<?=$item->id?>"/> 
                                                        <?endif;?>
                                                    </td>                                                    
                                                    <td><a href="<?=  base_url()?>transacciones/pago/<?=$item->id?>"><?=$item->concepto?></a></td>
                                                    <td><?=  date('d-m-Y',strtotime($item->vence))?></td>
                                                    <td><?= label_estado_transaccion($item->estado)?></td>
                                                    <td class="text-right"><?= number_format($item->monto,2)?></td>
                                                    <td class="text-right"><?= number_format($item->saldo,2)?></td>
                                                </tr>
                                                
                                                <?  foreach ($item->cuotas as $cuota):?>
                                                <tr class="tr-cuota-<?=$item->id?>" style="display: none">
                                                    <td>&brvbar;--</td>
                                                    <td>
                                                        <?if($cuota->saldo > 0):?>
                                                        <input type="checkbox" <?=$item->id == $transaccion->id ? 'checked':''?> name="cuotas[]" value="<?=$cuota->id?>" facid="<?=$item->id?>" saldo="<?=$cuota->saldo?>" numero="<?=$cuota->numero?>" class="cuota cuota-<?=$item->id?>"/>                                                        
                                                        <?endif;?>
                                                    </td>                                                    
                                                    <td><?=$cuota->numero ? 'Cuota n° '.$cuota->numero : 'Saldo inicial'?></td>
                                                    <td><?=  date('d-m-Y', strtotime($cuota->vence))?></td>
                                                    <td>---</td>
                                                    <td class="text-right"><?= number_format($cuota->monto,2)?></td>
                                                    <td class="text-right"><?= number_format($cuota->saldo,2)?></td>                                                    
                                                </tr>
                                                <?  endforeach;?>
                                                <?  endforeach;?>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                            <? endif; ?>            


                        </div>
                        </form>
                        
                        <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend>Pagos realizados: <?=$transaccion->concepto?></legend>                    
                        <table class="table table-striped">
                            <thead>  
                                <tr>                                    
                                    <th></th>
                                    <th>Concepto</th>                                    
                                    <th>Forma</th>
                                    <th>Registro</th>
                                    <th>Fecha</th>
                                    <th>Referencia</th>
                                    <th class="text-right">Monto</th>
                                    <th class="text-right">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                <?foreach($pagos as $item):?>                                
                                    <tr>                                        
                                        <td>
                                            <a href="<?=  base_url()?>transacciones/recibo_pago/<?=$item->id?>/<?=$item->pago_id?>" target="_blank" title="Imprimir recibo">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            
                                            <a title="Anular pago" onclick="return confirm('¿Desea anular este pago?');" href="<?=  base_url()?>transacciones/anular_pago/<?=$item->id?>">
                                                <i class="fa fa-ban"></i>
                                            </a>                                            
                                        </td>
                                        <td>
                                            <?=$item->concepto?>
                                        </td>                                        
                                        <td><?=$item->forma_pago?></td>
                                        <th>                                            
                                            <?=$item->fecha?>
                                        </th>
                                        <th>
                                            <?=$item->fecha_referencia?>
                                        </th>
                                        <td>
                                            <?=$item->referencia?>
                                        </td>
                                        <td class="text-right">
                                            <?=  number_format($item->monto, 2)?>
                                        </td>
                                        <td class="text-right">
                                            <?=  number_format($item->saldo, 2)?>
                                        </td>
                                    </tr> 
                                <?  endforeach;?>
                            </tbody>                            
                        </table>    
                    </fieldset>   
                </div>
            </div>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- WIDGET END -->

    </div>

</section>
<!-- end widget grid -->