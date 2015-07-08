<script type="text/javascript">
    
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                nombre: {minlength: 2, validUnique: 'inventario.tarifa.nombre'},
                descripcion: {minlength: 2},
            },
            messages: {
                nomre: {validUnique: 'Nombre ya registrado'}             
            }                  
        }); 
    });       
    
    function GuardarTarifa(){
                
        
        if($('#frmEdit').valid()){                    
            $.ajax({
                url: '<?=  base_url()?>tarifas/save',
                data: {
                    id: $('#id').val(),
                    nombre : $('#nombre').val(),
                    descripcion: $('#descripcion').val()
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