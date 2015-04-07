<script type="text/javascript">
    $(document).ready(function(){         
        $('#pago_monto').autoNumeric(FormatoDecimal);
        $('#pago_monto').val(saldo.toFixed(2));
        
        $('#pago_monto').blur(function(){
            var m = $(this).val() * 1;
            var c = m - saldo;
            $('#pago_cambio').val(c.toFixed(2));
        });
                
    });
</script>
    
<div class="form-group">
    <label class="col-md-3 control-label">Monto</label>
    <div class="col-md-8">
        <input id="pago_monto" name="pago[monto]" type="text" class="required form-control text-right"/>                            
    </div>
</div>

<div class="form-group cambio">
    <label class="col-md-3 control-label">Cambio</label>
    <div class="col-md-8">
        <input id="pago_cambio" name="pago[cambio]" type="text" class="required form-control text-right" value="0.00" readonly="readonly"/>                            
    </div>
</div>