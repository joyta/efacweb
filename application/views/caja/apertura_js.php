<script src="<?= base_url() ?>js/plugin/autonumeric/autoNumeric.min.js"></script>

<script type="text/javascript">

    
    $(document).ready(function(){
        $('.numeric').autoNumeric(FormatoDecimal);
        $('#frmEdit').validate(); 
    });       
    
    function Apertura(){                        
        if($('#frmEdit').valid()){     
            var data = $('#frmEdit').serialize();
            $.ajax({
                url: '<?=  base_url()?>caja/save_apertura',
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