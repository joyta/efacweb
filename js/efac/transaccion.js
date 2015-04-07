var autoCalcularMonto = true;
var autoConcepto = true;
var autoCheck = true;

    $(document).ready(function(){
        $('#frmEdit').validate();
        
        $('#pago_forma_pago').change(function () {
            var fp = $(this).val();
            var trn = $('#transaccion_id').val();
            if ($(this).val()) {
                $.ajax({
                    url: efac.url("transacciones/forma_pago/"+trn+"/"+$(this).val()),
                    type: 'POST',
                    data: {},
                    success: function (data) {
                        $('#formaPago').html(data);
                        //$('#pago_fecha_referencia').mask('9999-99-99');
                        $('#pago_fecha_referencia').datepicker({dateFormat : 'yy-mm-dd',
                        prevText : '<i class="fa fa-chevron-left"></i>',
                        nextText : '<i class="fa fa-chevron-right"></i>'});
                        //var maskRef = $('#pago_Referencia').attr('mask');
                        /*if (maskRef) {
                            $('#pago_Referencia').mask(maskRef);
                        }*/
                        if(autoCheck){
                            $('.factura:checked').change();
                            autoCheck = false;
                        }
                    }
                });
            }
        }).triggerHandler('change');
        
        $('.lnk-cuotas').click(function () {
            var tg = $(this).attr('data-toogle');
            if ($(tg).is(':visible')) {
                $(tg).hide();
                $(this).find('i:first').removeClass('fa-minus-square').addClass('fa-plus-square');
            } else {
                $(tg).show();
                $(this).find('i:first').removeClass('fa-plus-square').addClass('fa-minus-square');
            }
        });
        
        $('.factura').change(function () {
            var facid = $(this).val();

            if (!$(this).is(':checked')) {
                $('.cuota-' + facid).prop('checked', false);
            } else {
                if ($('.cuota-' + facid + ':checked').length == 0) {
                    $('.cuota-' + facid).prop('checked', true);
                }
            }

            var monto = $('#pago_monto').val() * 1;
            if (autoCalcularMonto || monto == 0) {
                var saldo = GetSaldo();
                $('#pago_monto').autoNumeric('set', saldo);
            }
            VerificarCubre();
            CalcularAbono();            
        });
        
        $('.cuota').change(function () {
            var facid = $(this).attr('facid');

            if ($('.cuota-' + facid + ':checked').length == 0) {
                $('.factura-' + facid).prop('checked', false);
            }

            if ($(this).is(':checked')) {
                $('.factura-' + facid).prop('checked', true);
            }

            $('.factura-' + facid).change();
        });

        $('body').on('change', '#pago_monto', function () {
            var monto = GetMonto();
            autoCalcularMonto = false;
            if (monto == 0) {
                autoCalcularMonto = true;
            }

            VerificarCubre();
            CalcularAbono();
        });
        
    });   
    
function GetMonto() {
    return $('#pago_monto').autoNumeric('get');
}

function GetSaldo() {
    var saldo = 0;
    $('.factura:checked').each(function (i, item) {
        var facid = $(item).attr('value');
        $('.cuota-' + facid + ':checked').each(function (i, itemcuota) {
            saldo += $(itemcuota).attr('saldo') * 1;
        });
    });
    return saldo;
}

function VerificarCubre() {
    var monto = GetMonto();
    $('.cuota:checked').each(function (i, item) {
        var facid = $(this).attr('facid');

        var saldo = $(this).attr('saldo') * 1;
        if (monto <= 0) {
            $(this).prop('checked', false);
        }
        monto = monto - saldo;
    });

    $('.factura:checked').each(function (i, item) {
        var facid = $(this).val();
        if ($('.cuota-' + facid + ':checked').length == 0) {
            $(this).prop('checked', false);
        }
    });
}

function CalcularAbono() {
    var saldo = GetSaldo();
    var monto = GetMonto();
    var abono = 0;
    if (monto > saldo) {
        abono = monto - saldo;
    }
    $('#abono').val(abono.toFixed(2));

    if (abono != 0) $('.div-abono').show();
    else $('.div-abono').hide();
}