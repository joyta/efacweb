<script src="<?= base_url() ?>js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    var dataTable = null;
    var target = null;
    var idm = 0;
    
    $(document).ready(function(){ 
        dataTable = $('#dt_basic').dataTable({ "order": [[ 1, "asc" ]]});          
    });
    
    function permisos(a, id){
        target = a;
        idm = id;
        $('#div-modals').load('<?=  base_url()?>menus/permisos/'+id,{}, function(){
            $('#modal-permisos').modal('show');
            
            $('#permisos').select2({
                placeholder: "Seleccione",
                allowClear: true,
                closeOnSelect: true,
                width: '100%'
            });
            
            $("#permisos").on("change", function (e) {        
                var tags = "" + e.val;                
                $('#roles').val(tags);        
            });
        });
    };
    
    function Guardar(){
        var datos = {
                id: idm,
                roles : $('#roles').val()                    
            };
            
        $.ajax({
            url: '<?=  base_url()?>menus/save_permisos',
            data: datos,
            type: 'post',
            dataType: 'json',
            cache:false,
            success: function(data){
                if(data.status === 'ok'){
                    $('#modal-permisos').modal('hide');
                    var td = $(target).parent().parent().find('td')[5];
                    $(td).text(datos.roles);
                }else{
                    alert(data.status);
                }
            },
            error: function(error){
                alert(error.responseText);
            }
        });
    }
    
</script>