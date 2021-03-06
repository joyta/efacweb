<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-marcas" data-widget-editbutton="true">
                <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

                -->
                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Lista de marcas </h2>

                    <div role="menu" class="widget-toolbar">
                        <!-- add: non-hidden - to disable auto hide -->
                        <a href="#marcas/create" class="btn btn-success">
                            <i class="fa fa-plus"></i> Nueva
                        </a>
                    </div>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->                        
                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar">

                        </div>


                        <table id="dt_basic" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>									
                                </tr>
                            </thead>
                            <tbody>                                
                                <? foreach ($marcas as $m): ?>                                    
                                    <tr>
                                        <td>
                                            <a href="#marcas/edit/<?= $m->id ?>" class="btn btn-primary btn-xs" title="Editar"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-xs" title="Eliminar" onclick="EliminarMarca(<?= $m->id ?>, '<?= $m->nombre ?>', this);"><i class="fa fa-recycle"></i></a>
                                        </td>
                                        <td><?= $m->id ?></td>
                                        <td><?= $m->nombre ?></td>
                                        <td><?= $m->descripcion ?></td>
                                    </tr>
                                <? endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- WIDGET END -->

    </div>

    <!-- end row -->

    <!-- end row -->

</section>
<!-- end widget grid -->


<script type="text/javascript">
    var dataTable = null;

    pageSetUp();

    function EliminarMarca(id, nombre, elm) {
        efac.deleteBox('Eliminar', '¿Desea eliminar la marca?', function() {
            $.ajax({
                url: '<?= base_url() ?>marcas/delete/' + id,
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