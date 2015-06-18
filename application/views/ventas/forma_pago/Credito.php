<script type="text/javascript">
    $(document).ready(function(){
        $('#pago_monto').autoNumeric(FormatoDecimal);
        $('#pago_monto').val(saldo.toFixed(2));
        $('#pago_vence').datepicker({dateFormat:'yy-mm-dd'});
        
        $('#pago_dias_plazo').change(function(){
            var d = $(this).val() * 1;
            var f = $('#comprobante_fecha').datepicker('getDate');
            f.setDate(f.getDate() + d);
            $('#pago_vence').datepicker('setDate', f);            
        }).change();
    });
</script>

<div class="form-group">
    <label class="col-md-3 control-label">Monto</label>
    <div class="col-md-8">
        <input id="pago_monto" name="pago[monto]" type="text" class="required cantidad greater-than max_monto form-control text-right"/>                            
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Cuotas</label>
    <div class="col-md-8">
        <select id="pago_numero_cuotas" name="pago[numero_cuotas]" class="form-control required">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Plazo (Días)</label>
    <div class="col-md-8">
        <select id="pago_dias_plazo" name="pago[dias_plazo]" class="form-control required">
            <option value="1">1</option>
            <option value="5">5</option>
            <option value="7">7</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="60">60</option>
            <option value="90">90</option>
            <option value="120">120</option>
            <option value="150">150</option>
            <option value="180">180</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Vence</label>
    <div class="col-md-8">
        <input id="pago_vence" name="pago[vence]" type="text" class="required form-control text-right fecha" readonly="readonly"/>                            
    </div>
</div>