<script src="<?= base_url() ?>js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    var dataTable = null;

    $(document).ready(function(){ 
        dataTable = $('#dt_basic').dataTable();
    });

    function EliminarCategoria(id, nombre, elm) {
        efac.deleteBox('Eliminar', '¿Desea eliminar la categoria?', function() {
            $.ajax({
                url: '<?= base_url() ?>categorias/delete/' + id,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'ok') {
                        dataTable.fnDeleteRow($(elm).parents('tr')).remove().draw(false);
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