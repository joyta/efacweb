

<script type="text/javascript">

    
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {                
                nombre: {minlength: 5},
            }                           
        }); 
    });       
    
    function GuardarChequera(){                
        
        if($('#frmEdit').valid()){                    
            $.ajax({
                url: '<?=  base_url()?>bancos/save_chequera',
                data: {
                    id: $('#id').val(),
                    cuenta_id: $('#cuenta_id').val(),
                    numero : $('#numero').val(),
                    descripcion: $('#descripcion').val()                    
                },
                type: 'post',
                dataType: 'json',
                cache:false,
                success: function(data){
                    if(data.status == 'ok'){
                        efac.infoBox('La información ha sido guardada correctamente.', function(){
                            $('#btn-cancel')[0].click();
                        });                        
                    }else{
                        alert(data.status);
                    }
                },
                error: function(error){
                    alert(error);
                }
            });
        }
    };
</script>