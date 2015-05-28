<script src="<?= base_url() ?>js/plugin/autonumeric/autoNumeric.min.js"></script>

<script type="text/javascript">
    
    $(document).ready(function(){
        $('#equivalencia').autoNumeric(FormatoDecimalFull);
        $('#frmEdit').validate({
            rules: {
                nombre: {validUnique: 'inventario.unidad.nombre', minlength: 3},
                equivalencia: {number:'true'},
            },
            messages: {
                nombre: {validUnique: 'Nombre ya registrado'}
            }                  
        }); 
        
        $('#tipo').change(function(){
            $.ajax({
                url: '<?=  base_url()?>unidades/get_bases',
                data: {
                    id: $('#id').val(),                    
                    tipo : $('#tipo').val(),                    
                    base_id: $('#base_id').val()
                },
                type: 'post',                
                cache:false,
                success: function(data){
                    $('.div-bases').html(data);
                },
                error: function(error){
                    alert(error);
                }
            });
        }).change();
    });       
    
    function GuardarUnidad(){
                
        
        if($('#frmEdit').valid()){                    
            $.ajax({
                url: '<?=  base_url()?>unidades/save',
                data: {
                    id: $('#id').val(),
                    nombre : $('#nombre').val(),
                    tipo : $('#tipo').val(),
                    equivalencia: $('#equivalencia').val(),
                    base_id: $('#base_id').val(),
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