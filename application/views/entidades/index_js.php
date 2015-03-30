<script type="text/javascript">

    var dataTable = null;

    pageSetUp();
    
    function EliminarEntidad(id, nombre, elm) {
        efac.deleteBox('Eliminar', '¿Desea eliminar la entidad?', function() {
            $.ajax({
                url: '<?= base_url() ?>entidades/delete/' + id,
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

    // pagefunction	
    var pagefunction = function() {
        dataTable = $('#dt_basic').dataTable();
    };

    // load related plugins
    loadScript("<?= base_url() ?>js/plugin/datatables/jquery.dataTables.min.js", function() {
        loadScript("<?= base_url() ?>js/plugin/datatables/dataTables.bootstrap.min.js", pagefunction);
    });
</script>