<script type="text/javascript">    
    
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                codigo: {minlength: 7},                
                secuencial: {digits: true, min: 1}
            },
            messages: {                
            }                    
        });                
    });       
    
    function GuardarPuntoEmision(){
        if($('#frmEdit').valid()){            
            $.ajax({
                url: '<?=  base_url()?>puntosemision/save',
                data: {
                    id: $('#id').val(),
                    codigo : $('#codigo').val(),
                    secuencial: $('#secuencial').val(),
                    tipo_documento: $('#tipo_documento').val(),
                    usuario_id: $('#usuario_id').val(),
                    establecimiento_id: $('#establecimiento_id').val(),
                    autsri_id: $('#autsri_id').val()
                },
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