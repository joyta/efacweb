<script type="text/javascript">
    $(document).ready(function(){
        $('#pago_monto').autoNumeric(FormatoDecimal);
        
        $('#pago_chequera_id').change(function(){
            var opt = $('#pago_chequera_id option:selected');            
            $('#pago_cuentabancaria_id').val($(opt).attr('cuenta_id'));
            $('#pago_referencia').val($(opt).attr('numero'));
        });
    });
</script>

<div class="form-group">
    <label class="col-md-3 control-label">Monto</label>
    <div class="col-md-8">
        <input id="pago_monto" name="pago[monto]" type="text" class="required cantidad greater-than max_monto form-control text-right"/>                            
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Fecha emisión</label>
    <div class="col-md-4">
        <input id="pago_fecha_referencia" name="pago[fecha_referencia]" type="text" class="form-control required" dateITA = "true" placeholder = "aaaa-mm-dd"/>
    </div>
</div>

<!--Emito el cheque-->
<?if($transaccion->grupo=='Cxp'):?>
<div class="form-group">
    <label class="col-md-3 control-label">Chequera</label>
    <div class="col-md-8">
        <input type="hidden" name="pago[cuentabancaria_id]" id="pago_cuentabancaria_id" value=""/>
        <select name="pago[chequera_id]" id="pago_chequera_id" class="form-control required">
            <option>--Seleccione--</option>
            <?  foreach ($chequeras as $c):?>
                <option value="<?=$c->id?>" cuenta_id="<?=$c->cuenta_id?>" numero="<?=$c->numero?>"><?=$c->descripcion?></option>                
            <?  endforeach;?>
        </select>        
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Número cheque</label>
    <div class="col-md-4">
        <input id="pago_referencia" name="pago[referencia]" type="text" value="" class="form-control required"/>        
    </div>
</div>
<? endif; ?>

<!--Recibo el cheque-->
<?if($transaccion->grupo=='Cxc'):?>
<div class="form-group">
    <label class="col-md-3 control-label">Número cheque</label>
    <div class="col-md-4">
        <input id="pago_referencia" name="pago[referencia]" type="text" value="" class="form-control required"/>        
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Cuenta bancaria</label>
    <div class="col-md-8">
        <input id="pago_numero_cuenta" name="pago[numero_cuenta]" type="text" class="form-control required" maxlength = 255/>
    </div>
</div>
    
<div class="form-group">
    <label class="col-md-3 control-label">Nombre banco</label>
    <div class="col-md-8">        
        <input id="pago_nombre_banco" name="pago[nombre_banco]" type="text" class="form-control required" maxlength = 255/>
    </div>
</div>
<? endif; ?>
