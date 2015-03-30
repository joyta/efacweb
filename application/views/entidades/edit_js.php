<script type="text/javascript">
        
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                documento: {                    
                    minlength: 5,
                    validUnique: 'tributario.entidad.documento'
                },
                nombre_comercial: {minlength: 3},
                razon_social: {minlength: 3},            
            },
            messages: {
                documento: {validUnique: 'Número de documento duplicado'}                       
            }                    
        }); 
    });       
    
    function GuardarEntidad(){
        if($('#frmEdit').valid()){            
            $.ajax({
                url: '<?=  base_url()?>entidades/save',
                data: {
                    id: $('#id').val(),
                    tipo_documento : $('#tipo_documento').val(),
                    documento: $('#documento').val(),
                    nombre_comercial: $('#nombre_comercial').val(),
                    razon_social: $('#razon_social').val(),
                    estado: $('#estado').val(),
                    celular: $('#celular').val(),
                    telefono: $('#telefono').val(),
                    email: $('#email').val(),
                    direccion: $('#direccion').val(),
                    is_proveedor: $('#is_proveedor').is(':checked')
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