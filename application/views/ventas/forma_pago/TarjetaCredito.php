<script type="text/javascript">
    $(document).ready(function(){         
        $('#pago_monto').autoNumeric(FormatoDecimal);
        $('#pago_monto').val(saldo.toFixed(2));                       
    });
</script>
    
<div class="form-group">
    <label class="col-md-3 control-label">Monto</label>
    <div class="col-md-8">
        <input id="pago_monto" name="pago[monto]" type="text" class="required form-control text-right"/>                            
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Fecha pago</label>
    <div class="col-md-4">
        <input id="pago_fecha_referencia" name="pago[fecha_referencia]" type="text" class="form-control required" dateITA = "true" placeholder = "aaaa-mm-dd"/>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Referencia (recap)</label>
    <div class="col-md-4">
        <input id="pago_referencia" name="pago[referencia]" type="text" class="form-control required"/>        
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Marca</label>
    <div class="col-md-8">
        <select id="pago_marca" name="pago[marca]" class="form-control required">
            <option value="VISA">VISA</option>
            <option value="MASTERCARD">MASTERCARD</option>
            <option value="CUOTA FACIL">CUOTA FACIL</option>
            <option value="DINERS">DINERS</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Nombre banco</label>
    <div class="col-md-8">
        <input id="pago_nombre_banco" name="pago[nombre_banco]" type="text" class="form-control required"/>        
    </div>
</div>