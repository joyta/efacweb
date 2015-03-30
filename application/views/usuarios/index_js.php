<script src="<?= base_url() ?>js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    var dataTable = null;

    $(document).ready(function(){ 
        dataTable = $('#dt_basic').dataTable();
    });

    function EliminarUsuario(id, nombre, elm) {
        efac.deleteBox('Eliminar', '¿Desea eliminar el usuario?', function() {
            $.ajax({
                url: '<?= base_url() ?>usuarios/delete/' + id,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    if (data.status === 'ok') {                        
                        $(elm).parents('tr').find('.estado:first').html('<span class="label label-danger">Eliminado</span>');
                        $(elm).parents('tr').find('.lnk-delete:first').attr('disabled','disabled');                        
                    } else {
                        alert(data.status);
                    }
                },
                error: function(error) {
                    alert(error.reponseText);
                }
            });
        });
    };

</script>