<script src="<?= base_url() ?>js/plugin/autonumeric/autoNumeric.min.js"></script>

<script type="text/javascript">
    
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {                
                nombre: {minlength: 3}                
            }            
        });  
        
        $('.numeric').autoNumeric(FormatoDecimal);
    });       
    
    function GuardarPrecios(){
        if($('#frmEdit').valid()){            
            $.ajax({
                url: '<?=  base_url()?>productos/save_precios',
                data: $('#frmEdit').serialize(),
                type: 'post',
                dataType: 'json',
                cache:false,
                success: function(data){
                    if(data.status === 'ok'){
                        efac.infoBox('La información ha sido guardada correctamente.', function(){
                            $('#btn-cancel')[0].click();
                        });                        
                    }else{
                        alert(data.status);
                    }
                },
                error: function(error){
                    alert(error.responseText);
                }
            });
        }
    };
</script>