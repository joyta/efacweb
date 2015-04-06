<script type="text/javascript">
    $(document).ready(function(){
        $('#pago_monto').autoNumeric(FormatoDecimal);
    });
</script>

<div class="form-group">
    <label class="col-md-3 control-label">Monto</label>
    <div class="col-md-8">
        <input id="pago_monto" name="pago[monto]" type="text" class="required cantidad greater-than max_monto form-control text-right"/>                            
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Fecha depósito</label>
    <div class="col-md-4">
        <input id="pago_fecha_referencia" name="pago[fecha_referencia]" type="text" class="form-control required" dateITA = "true" placeholder = "aaaa-mm-dd"/>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Referencia</label>
    <div class="col-md-4">
        <input id="pago_referencia" name="pago[referencia]" type="text" class="form-control required"/>        
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Depositante ID</label>
    <div class="col-md-4">
        <input id="pago_depositanteid" name="pago[depositanteid]" type="text" class="form-control required" maxlength = 255/>        
    </div>
</div>



<!--Cxp: Número de cuenta y banco al que hizo el deposito-->
<?if($transaccion->grupo == 'Cxp'):?>
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
<?  endif;?>

<!--Cxc: Mi cuenta bancaria a la que hicieron el deposito-->
<?if($transaccion->grupo == 'Cxc'):?>
<div class="form-group">
    <label class="col-md-3 control-label">Cuenta bancaria</label>
    <div class="col-md-8">
        <?= form_dropdown('pago[cuentabancaria_id]', $cuentas, '', 'id="pago_cuentabancaria_id" class="form-control required"')?>
    </div>
</div>
<? endif; ?>