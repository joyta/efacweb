
<script type="text/javascript">   
    $(document).ready(function(){            
        $('#pago_forma_pago').change(function () {
            var fp = $(this).val();
            if ($(this).val()) {
                $.ajax({
                    url: "<?=  base_url()?>transacciones/forma_pago/<?=$transaccion->id?>/"+$(this).val(),
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
                    }
                });
            }
        }).triggerHandler('change');
    });       
</script>