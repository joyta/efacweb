

<script type="text/javascript">

    
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                nombre: {validUnique: 'inventario.marca.nombre', minlength: 3},
                descripcion: {minlength: 5},
            },
            messages: {
                nombre: {validUnique: 'Nombre ya registrado'}
            }                  
        }); 
    });       
    
    function GuardarMarca(){
                
        
        if($('#frmEdit').valid()){                    
            $.ajax({
                url: '<?=  base_url()?>marcas/save',
                data: {
                    id: $('#id').val(),
                    nombre : $('#nombre').val(),
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