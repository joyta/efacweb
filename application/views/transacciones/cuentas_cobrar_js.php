<script src="<?= base_url() ?>js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">
    var dataTable = null;

    $(document).ready(function(){ 
        dataTable = $('#dt_basic').dataTable({            			         
            //"processing": true,
            "serverSide": true,            
            "sAjaxSource": "<?=  base_url()?>transacciones/cuentas_cobrar_handler",            
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
            "fnRowCallback": function(tr,aData, iDisplayIndex ){
                //$(tr).find('td:last').addClass('text-right');
                if(aData[9]==='si'){
                    $(tr).addClass('danger');
                }
            },                    
            "aoColumns": [
                { "sName": "links", "bSearchable": false, "bSortable": false},
                { "sName": "id"},                
                { "sName": "fecha" },
                { "sName": "vence" },
                { "sName": "concepto" },
                { "sName": "entidad_razon_social" },
                { "sName": "estado" },
                { "sName": "monto" , "sClass":"text-right"},
                { "sName": "saldo", "sClass":"text-right"}                
            ],
            "order": [[ 1, "asc" ]]            
        });
        
    });       
</script>