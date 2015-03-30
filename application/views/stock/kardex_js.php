<script src="<?= base_url() ?>js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

    var dataTable = null;

    $(document).ready(function(){ 
        dataTable = $('#dt_basic').dataTable();
    }); 
</script>