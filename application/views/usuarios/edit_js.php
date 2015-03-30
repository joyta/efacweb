<script type="text/javascript">
   
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                nombre: {minlength: 5, validUnique: 'seguridad.usuario.nombre'},
                clave: {minlength: 5},            
                descripcion: {minlength: 5}
            },
            messages: {
                nombre: {validUnique: 'Nombre de usuario ya registrado'}
            }                    
        }); 
    });       
    
    function GuardarUsuario(){
                
        
        if($('#frmEdit').valid()){                    
            $.ajax({
                url: '<?=  base_url()?>usuarios/save',
                data: {
                    id: $('#id').val(),
                    nombre : $('#nombre').val(),
                    descripcion: $('#descripcion').val(),
                    estado: $('#estado').val(),
                    rol: $('#rol').val(),
                    clave: $('#clave').val(),
                    establecimiento_id: $('#establecimiento_id').val()
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