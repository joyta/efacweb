<script src="<?= base_url() ?>js/plugin/autonumeric/autoNumeric.min.js"></script>

<script type="text/javascript">

    
    $(document).ready(function(){
        $('.numeric').autoNumeric(FormatoDecimal);
        $('.numeric-neg').autoNumeric(FormatoDecimalNeg);
        
        $('#frmEdit').validate(); 
        
        $('#total_existente').change(function(){
            var t = $('#total_efectivo').autoNumeric('get');
            var r = $('#total_existente').autoNumeric('get');
            var d = r - t;
            $('#diferencia').autoNumeric('set', d);
        });
    });       
    
    function Cierre(){                        
        if($('#frmEdit').valid()){     
            var data = $('#frmEdit').serialize();
            $.ajax({
                url: '<?=  base_url()?>caja/save_cierre',
                data: data,
                type: 'post',
                dataType: 'json',
                cache:false,
                success: function(data){
                    if(data.status == 'ok'){
                        efac.infoBox('La caja ha sido abierta correctamente.', function(){
                            $('#btn-cancel')[0].click();
                        });                        
                    }else{
                        efac.infoBox(data.status, function(){});                         
                    }
                },
                error: function(error){
                    alert(error);
                }
            });
        }
    };
</script>