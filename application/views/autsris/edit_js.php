
<script type="text/javascript">    
    
    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                numero: {digits: true, minlength: 10},
                descripcion: {minlength: 3},
                inicio: {date:true},
                fin: {date: true}
            },
            messages: {                
            }                    
        });
        
        $('#inicio, #fin').datepicker({dateFormat: 'yy-mm-dd'});
    });       
    
    function GuardarAut(){
        if($('#frmEdit').valid()){            
            $.ajax({
                url: '<?=  base_url()?>autsris/save',
                data: {
                    id: $('#id').val(),
                    numero : $('#numero').val(),
                    descripcion: $('#descripcion').val(),
                    inicio: $('#inicio').val(),
                    fin: $('#fin').val(),
                    estado: $('#estado').is(':checked') ? '1':'0',
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