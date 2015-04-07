<script src="<?= base_url() ?>js/plugin/autonumeric/autoNumeric.min.js"></script>

<script type="text/javascript">
    
    var saldo = '<?=$comprobante->importe_total?>' * 1;

    $(document).ready(function(){
        $('#frmCobro').validate();
        
        $('#comprobante_fecha').datepicker({dateFormat: 'yy-mm-dd'});
        
        $('#pago_forma_pago').change(function () {
            var fp = $(this).val();
            if ($(this).val()) {
                $.ajax({
                    url: "<?=  base_url()?>ventas/forma_pago/<?=$comprobante->id?>/"+fp,
                    type: 'POST',
                    data: {},
                    success: function (data) {
                        $('#formaPago').html(data);                        
                        $('#pago_fecha_referencia').datepicker({dateFormat : 'yy-mm-dd',
                        prevText : '<i class="fa fa-chevron-left"></i>',
                        nextText : '<i class="fa fa-chevron-right"></i>'});                        
                    }
                });
            }
        }).triggerHandler('change');
        
        $('#btnAddPago').click(function () { AddPago(); });
        
        
                
    });      
    
    function AddPago() {
        var cambio = $('#pago_cambio').val() * 1;
        var monto = (($('#pago_monto').val() * 1) - (cambio >= 0 ? cambio : 0)).toFixed(2) * 1;        

        if ($('#frmCobro').valid() === false) {return;}
        
        var fp = $("#pago_forma_pago").val();
        var fpmaxitems = $("#pago_forma_pago option:selected").attr('maxitems') * 1;

        var cbid = $('#pago_cuentabancaria_id').val();
        var cbtext = cbid ? $('#pago_cuentabancaria_id option:selected').text() : '--';

        var fecha = $('#pago_recha_referencia').val();
        var refer = $('#pago_referencia').val();
        var depid = $('#pago_depositanteid').val();
        var vence = $('#pago_vence').val();

        var marca = $('#pago_marca').val();
        var ncuenta = $('#pago_numero_cuenta').val();
        var nbanco = $('#pago_nombre_banco').val();    
        var ndias = $('#pago_dias_plazo').val();
        var ncuotas = $('#pago_numero_cuotas').val();

        if (monto > 0 && monto <= saldo) {
            var nitems = $('#dtPagos tbody tr[tipo=' + fp + ']').length;            
            if (nitems < fpmaxitems) {
                saldo = (saldo - monto).toFixed(2) * 1;
            } else {
                alert('Ya existe una forma de pago de este tipo');
                return;
            }
        } else {
            alert('Monto incorrecto: ' + monto + ', saldo: ' + saldo);
            return;
        }

        var tr = '\
            <tr tipo="' + fp + '" monto="' + monto + '">\
                <td><a href="javascript:void(0);" onclick="RemoverPago(this);" title="Eliminar"><i class="fa fa-ban"></i></a></td>\
                <td>\
                    <input type="hidden" property="forma_pago" value="' + fp + '"/>\
                    <input type="hidden" property="monto" value="' + (monto).toFixed(2) + '"/>' +
                    (cbid ?  '<input type="hidden" property="cuentabancaria_id" value="' + (cbid) + '"/>' : '')+
                    (fecha ? '<input type="hidden" property="fecha_referencia" value="' + (fecha) + '"/>' : '') +
                    (vence ? '<input type="hidden" property="vence" value="' + (vence) + '"/>' : '')+
                    '<input type="hidden" property="referencia" value="' + (refer ? refer : '') + '"/>\
                    <input type="hidden" property="depositanteid" value="' + (depid ? depid : '') + '"/>\
                    <input type="hidden" property="marca" value="' + (marca ? marca : '') + '"/>\
                    <input type="hidden" property="numero_cuenta" value="' + (ncuenta ? ncuenta : '') + '"/>\
                    <input type="hidden" property="nombre_banco" value="' + (nbanco ? nbanco : '') + '"/>\
                    <input type="hidden" property="dias_plazo" value="' + (ndias ? ndias : 0) + '"/>\
                    <input type="hidden" property="numero_cuotas" value="' + (ncuotas ? ncuotas : 0) + '"/>\
                    <span>' + fp + '</span>\
                </td>\
                <td class="text-right">\
                    <span>' + monto.toFixed(2) + '</span>\
                </td>\
                <td>\
                    <span>' + cbtext + '</span>\
                </td>\
                <td>\
                    <span>' + (fecha ? fecha : '---') + '</span>\
                </td>\
                <td>\
                    <span>' + (refer ? refer : '---') + '</span>\
                </td>\
                <td>\
                    <span>' + (depid ? depid : '---') + '</span>\
                </td>\
                <td>\
                    <span>' + (ncuotas ? ncuotas : '---') + '</span>\
                </td>\
                <td>\
                    <span>' + (vence ? vence : '---') + '</span>\
                </td>\
            </tr>';

        $('#dtPagos tbody').append(tr);
        $('.saldo-text').text(saldo.toFixed(2));                
    };
    
    function MapData() {
        $('#dtPagos tbody tr').each(function (i, tr) {
            $(tr).find('input').each(function (j, input) {
                var prp = $(input).attr('property');
                $(input).attr('name', 'pagos[' + i + '][' + prp+']');
            });
        });
    };

    function RemoverPago(a) {
        var tr = $(a).parent().parent();
        var monto = $(tr).attr('monto') * 1;        
        var newSaldo = (saldo + monto);        
        $('.saldo-text').text(newSaldo.toFixed(2));
        $(tr).remove();
    };
    
    function GuardarTransaccion(){
        if(saldo === 0){
            MapData();
            $('#frmCobro').submit();
        }        
    };
    
    
</script>