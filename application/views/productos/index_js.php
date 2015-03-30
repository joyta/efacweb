
<script src="<?= base_url() ?>js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    var dataTable = null;
    
    $(document).ready(function(){                        
        dataTable = $('#dt_basic').dataTable({            			         
            //"processing": true,
            "serverSide": true,            
            "sAjaxSource": "<?=  base_url()?>productos/index_handler",            
            "fnServerData": function (url, data, callback) {
                $.ajax({
                    "url": url,
                    "data": data,
                    "success": callback,
                    "dataType": "json",
                    "type": "POST",
                    "cache": false,
                    "error": function (e) {
                        alert(e.responseText);
                    }
                })
            },
            "aoColumns": [
                { "sName": "links", "bSearchable": false, "bSortable": false},
                { "sName": "id"},
                { "sName": "codigo" },
                { "sName": "nombre" },
                { "sName": "estado"},
                { "sName": "marca_nombre"},
                { "sName": "categoria_nombre" },                    
            ],
            "order": [[ 1, "asc" ]]            
        });
    });

    function EliminarProducto(id, nombre, elm) {
        efac.deleteBox('Eliminar', '¿Desea eliminar el producto '+nombre+'?', function() {
            $.ajax({
                url: '<?= base_url() ?>productos/delete/' + id,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    if (data.status === 'ok') {
                        dataTable.fnDeleteRow($(elm).parents('tr')).remove().draw(false);
                    } else {
                        alert('No se ha podido eliminar este producto');
                    }
                },
                error: function(error) {
                    alert(error);
                }
            });
        });
    };

</script>