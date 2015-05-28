<script src="<?= base_url() ?>js/plugin/autonumeric/autoNumeric.min.js"></script>

<script type="text/javascript">

    
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                codigo: {validUnique: 'seguridad.parametro.codigo', minlength: 3},
                descripcion: {minlength: 5},
            },
            messages: {
                codigo: {validUnique: 'Código ya registrado'}
            }                  
        });
        
        $('#tipo').change(function(){
            var t = $(this).val();
            var v = $('#valor').val();
            
            $('.value-editor').load('<?=base_url()?>parametros/value_editor/'+t+'/'+v);
        }).change();
    });       
    
    function Guardar(){
                
        
        if($('#frmEdit').valid()){                    
            $.ajax({
                url: '<?=  base_url()?>parametros/save',
                data: {
                    id: $('#id').val(),
                    codigo : $('#codigo').val(),
                    descripcion: $('#descripcion').val(),
                    valor : $('#valor').val(),
                    tipo : $('#tipo').val(),
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