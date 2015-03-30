<div class="form-group">
    <label class="col-md-3 control-label">Fecha depósito</label>
    <div class="col-md-4">
        <input id="pago_fecha_referencia" name="pago.fecha_referencia" type="text" class="form-control required" dateITA = "true" placeholder = "aaaa-mm-dd"/>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Referencia</label>
    <div class="col-md-4">
        <input id="pago_referencia" name="pago.referencia" type="text" class="form-control required"/>        
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Depositante ID</label>
    <div class="col-md-4">
        <input id="pago_depositanteid" name="pago.depositanteid" type="text" class="form-control required" maxlength = 255/>        
    </div>
</div>



<!--cxp: Número de cuenta y banco al que hizo el deposito-->
<?if($transaccion->grupo == 'Cxp'):?>
<div class="form-group">
    <label class="col-md-3 control-label">Cuenta bancaria</label>
    <div class="col-md-8">
        <input id="pago_numero_cuenta" name="pago.numero_cuenta" type="text" class="form-control required" maxlength = 255/>
    </div>
</div>
    
<div class="form-group">
    <label class="col-md-3 control-label">Nombre banco</label>
    <div class="col-md-8">        
        <input id="pago_nombre_banco" name="pago.nombre_banco" type="text" class="form-control required" maxlength = 255/>
    </div>
</div>
<?  endif;?>

<!--Cxc: Mi cuenta bancaria a la que hicieron el deposito-->
<?if($transaccion->grupo == 'Cxc'):?>
<div class="form-group">
    <label class="col-md-2 control-label">Cuenta bancaria</label>
    <div class="col-md-4">
        <!--@Html.DropDownListFor(p => pago.CuentaBancaria.Id, Model, new { @class = "form-control required" })-->
        <select></select>
    </div>
</div>
<? endif; ?>
