
<script type="text/javascript">    
    
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                codigo: {                    
                    minlength: 3,
                    validUnique: 'tributario.establecimiento.codigo'
                },
                nombre: {minlength: 3}
            },
            messages: {
                codigo: {validUnique: 'Código duplicado'}                
            }                    
        }); 
    });       
    
    function GuardarEstablecimiento(){
        if($('#frmEdit').valid()){            
            $.ajax({
                url: '<?=  base_url()?>establecimientos/save',
                data: {
                    id: $('#id').val(),
                    codigo : $('#codigo').val(),
                    nombre: $('#nombre').val(),
                    direccion: $('#direccion').val(),
                    telefono: $('#telefono').val()                    
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