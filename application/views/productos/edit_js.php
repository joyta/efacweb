<script src="<?= base_url() ?>js/plugin/autonumeric/autoNumeric.min.js"></script>
<script type="text/javascript">
    
    //VALIDATE USER EMAIL


    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    pageSetUp();
    
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                codigo: {                    
                    minlength: 5,
                    validUnique: 'inventario.producto.codigo'
                },
                nombre: {minlength: 3}                
            },
            messages: {
                codigo: {validUnique: 'Código duplicado'},
                marca_id: {required: 'Seleccione una marca'},
                categoria_id: {required: 'Seleccione una categoria'}            
            }                    
        });
                
        $('#tipo_unidad').change(function(){
            $.ajax({
                url: '<?=  base_url()?>productos/get_unidades',
                data: {                    
                    tipo : $('#tipo_unidad').val()                    
                },
                type: 'post',                
                dataType: 'json',
                cache:false,
                success: function(data){
                    $('.div-unidades-inv').html(data.unidad_inv);
                    $('.div-unidades-cmp').html(data.unidad_cmp);
                },
                error: function(error){
                    alert(error);
                }
            });
        });
        
        $('.numeric').autoNumeric(FormatoDecimal);
    });       
    
    function GuardarProducto(){
        if($('#frmEdit').valid()){            
            $.ajax({
                url: '<?=  base_url()?>productos/save',
                data: {
                    id: $('#id').val(),
                    codigo : $('#codigo').val(),
                    nombre: $('#nombre').val(),
                    marca_id: $('#marca_id').val(),
                    categoria_id: $('#categoria_id').val(),
                    tipo: $('#tipo').val(),
                    tipo_stock: $('#tipo_stock').val(),
                    estado: $('#estado').val(),
                    iva: $('#iva:checked').val(),
                    tipo_unidad: $('#tipo_unidad').val(),
                    unidad_id: $('#unidad_id').val(),
                    unidadcompra_id: $('#unidadcompra_id').val(),
                    cantidad_minima: $('#cantidad_minima').val(),
                    cantidad_maxima: $('#cantidad_maxima').val()
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