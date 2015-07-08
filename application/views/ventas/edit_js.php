<script src="<?= base_url() ?>js/plugin/autonumeric/autoNumeric.min.js"></script>
<script src="<?= base_url() ?>js/efac/identificacion_validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        jQuery.validator.addMethod("seriesValidate", function (value, element, param) {
            var tr = $(element).closest('tr');
            if(param==='Serie'){
                var can = $(tr).find('input[property=cantidad]').val() * 1;
                var series = $(tr).find('input[property=series]').val();
                series = series ? series.split(',') : [];                
                return (can === series.length);
            }
            return true;
        }, "(*) Series");
        
        $('#frmEdit').validate({
            ignore: [],
            rules: {
                'entidad[documento]': {
                    numeroDocumento: '#entidad_tipo_documento'
                }
            },
            messages: { }                  
        });  
    });
</script>

<script type="text/javascript">
    var piva = '<?=$model->porcentaje_iva?>' * 1 / 100;
    var nitem = 0;

    $(document).ready(function(){
        
        $('.cliente').autocomplete(MapAutoCompleteCliente());
        $('.producto').autocomplete(MapAutoCompleteProducto());
        $('.producto').change(function(){
            //CargarProducto();
        });
        
        $('body').on('change', '.cantidad', function (e) {	    
            CalcularTotal();
	});
        
        $('body').on('change', '#tarifa_id', function (e) {	    
            CambiarTarifa();
	});
                
        $('body').on('click', '.delete', function (e) {
	    $(this).closest('tr').remove();
            CalcularTotal();
	});
        
        $('body').on('click', '.desc-valor', function (e) {
            var d = prompt('Ingrese el valor a descontar','0') * 1;
            if(!isNaN(d)){
                var tr = $(this).closest('tr');
                var c = $(tr).find("input[property=cantidad]").val() * 1;
                var p = $(tr).find("input[property=precio_unitario]").val() * 1;
                
                if(c*p - d >= 0 ){                
                    $(tr).find("input[property=descuento]").val(d);
                    CalcularTotal();
                }
            }
	});
        
        $('body').on('click', '.desc-porce', function (e) {
            var dp = prompt('Ingrese el porcentaje a descontar','0') * 1;
            if(!isNaN(dp)){
                
                var tr = $(this).closest('tr');
                var c = $(tr).find("input[property=cantidad]").val() * 1;
                var p = $(tr).find("input[property=precio_unitario]").val() * 1;
                
                var d = ((c * p * dp) / 100).toFixed(2);                
                
                if(c*p - d >= 0 ){                
                    $(tr).find("input[property=descuento]").val(d);
                    CalcularTotal();
                }
            }
	});
           
        InitItems();
    });      
    
    function GenerarComprobante(){
        $("#detalle tbody tr").each(function(i, tr){
            $(tr).find("input[property]").each(function(j, input){
                $(input).attr('name', 'detalles['+i+']['+$(input).attr('property')+']');
            });                    
        });
    };
    
    function GuardaComprobante(){
        if($('#frmEdit').valid()){  
            GenerarComprobante();
            var data = $('#frmEdit').serialize();
            $.ajax({
                url: '<?=  base_url()?>ventas/save',
                data: data,
                type: 'post',
                dataType: 'json',
                cache:false,
                success: function(data){
                    if(data.status == 'ok'){
                        efac.infoBox('La información ha sido guardada correctamente.', function(){
                            //$('#btn-cancel')[0].click();
                            window.location = data.redirect;
                        });                        
                    }else{
                        alert(data.status);
                    }
                },
                error: function(error){
                    alert(error);
                }
            });
        }
    };
    
    function MapAutoCompleteCliente() {
        return {
            source: function (request, response) {
                $.ajax({
                    url: '<?=  base_url()?>entidades/get_autocomplete_clientes/'+request.term,
                    dataType: "json",                
                    success: function (data) {
                        if (data.error) {
                            alert(data.error);                        
                        } else {
                            response(data);
                        }
                    }
                });
            },
            minLength: 4,
            select: function (event, ui) {        
                $("#entidad_documento").val(ui.item.documento);
                $("#entidad_razon_social").val(ui.item.razon_social);
                $("#entidad_direccion").val(ui.item.direccion);
                $("#entidad_email").val(ui.item.email);
                $("#entidad_telefono").val(ui.item.telefono);
                $('#entidad_tipo_documento').val(ui.item.tipo_documento);
                $('#frmEdit').valid();
                event.preventDefault();
            },
            open: function () { }, close: function () { }
        };
    }
    
    function MapAutoCompleteProducto() {
        return {
            source: function (request, response) {
                $.ajax({
                    url: '<?=  base_url()?>productos/get_autocomplete_productos_venta/'+request.term+'/'+$('#tarifa_id').val(),
                    dataType: "json",                
                    success: function (data) {
                        if (data.error) {
                            alert(data.error);                        
                        } else {
                            response(data);
                        }
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {                
                AgregarItem(ui.item);
                CalcularTotal();
            },
            open: function () { }, close: function () { }
        };
    }
    
    function GetCantidad(){
        var c = $('#cantidad').val();
        if(isNaN(c)){
            return 1;
        }else{
            c = c * 1;
            return c > 0 ? c : 1;
        }        
    }        
    
    function AgregarItem(item){
        var uid = item.id+'-'+item.unidad_id;
        var tro = $('#detalle tr[data-uid="'+uid+'"]');
        var cantidadAnt = 0;
        nitem += 1;
        
        $('#detalle tr[data-id="'+item.id+'"]').each(function(i, tr){
            cantidadAnt += ($(tr).attr('data-cantidad')*1) / item.equivalencia;
        });        
        
        var cantidad = GetCantidad() + cantidadAnt;        
        
        if(item.tipo === 'Servicio' || cantidad <= item.stock){
        
            item.cantidad = cantidad;
            item.total = (cantidad * item.precio) - item.descuento;
            
            if(item.tipo_stock==='Serie'){
                
            }

            var trn = "\
            <tr data-uid='"+uid+"' data-id='"+item.id+"' data-cantidad='"+cantidad+"' data-iva='"+item.iva+"'>\
                <td style='white-space: nowrap'>\
                    <input type='hidden' property='producto_id' value='"+item.id+"'/>\
                    <input type='hidden' property='unidad_id' value='"+item.unidad_id+"'/>" +
                    (item.tipo_stock === 'Serie' ? "<a class='btn btn-xs btn-info' href='javascript:void(0);' title='Series' onclick='showModalSeries(this);'><i class='fa fa-slack'></i></a> ": "") +
                    "<a class='delete btn btn-danger btn-xs' title='Eliminar'><i class='fa fa-trash'></i></a>\
                    <input type='hidden' name='series_"+nitem+"' property='series' seriesValidate='"+item.tipo_stock+"'/>\
                </td>\
                <td><input type='text' class='form-control required' style='width: 100px' readonly='' property='codigo' value='"+item.codigo+"'/></td>\
                <td><input type='text' class='form-control required' style='width: 300px' readonly='' property='descripcion' value='"+item.nombre+' - '+ item.unidad_nombre+"'/></td>\
                <td><input type='text' class='form-control required text-right cantidad' style='width: 100px' property='cantidad' value='"+item.cantidad+"'/></td>\
                <td><input type='text' class='form-control required text-right' style='width: 100px' readonly='' property='precio_unitario' value='"+item.precio+"'/></td>\
                <td>\
                    <div class='input-group'>\
                        <input type='text' class='form-control required text-right' readonly='' property='descuento' value='"+item.descuento+"'/>\
                        <div class='input-group-btn'>\
                             <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' tabindex='-1'>\
                                     <span class='caret'></span>\
                             </button>\
                             <ul class='dropdown-menu pull-right' role='menu'>\
                                 <li><a href='javascript:void(0);' class='desc-valor'>Valor ($)</a></li>\
                                 <li><a href='javascript:void(0);' class='desc-porce'>Porcentaje (%)</a></li>\
                             </ul>\
                        </div>\
                    </div>\
                </td>\
                <td><input type='text' class='form-control required text-right total' style='width: 100px' readonly='' property='precio_total_sin_impuestos' value='"+item.total+"'/></td>\
            </tr>";
                    
            if(tro.length === 1){
                $(tro).before(trn);
                $(tro).remove();
            }else{
                $("#detalle tbody").append(trn);
            }
            
            InitItems();
        }else{
            efac.infoBox('Cantidad superior al stock actual -> Stock: ' + item.stock + ", Catidad: "+cantidad);
        }
    }    
    
    function InitItems(){
        $('.cantidad').autoNumeric(FormatoDecimalFull);
        $('.total').autoNumeric(FormatoDecimal);
    }
    
    function CalcularTotal(){
        var total = 0;
        var subtotal = 0;
        var baseIva0 = 0;
        var baseIva12 = 0;
        var iva0 = 0;
        var iva12 = 0;
        var descuento=0;
        
        $("#detalle tbody tr").each(function(i, tr){
            var cantidad = $(tr).find("input[property=cantidad]").val() * 1;
            var precio = $(tr).find("input[property=precio_unitario]").val() * 1;
            var subtotalitem = (cantidad * precio).toFixed(2) * 1; 
            
            $(tr).find("input[property=precio_total_sin_impuestos]").autoNumeric('set',subtotalitem);
            
            var descuentoitem = $(tr).find("input[property=descuento]").val() * 1;
            subtotal += subtotalitem;
            descuento += descuentoitem;
            if($(tr).attr('data-iva') === '1'){
                baseIva12 += subtotalitem;
            }else{
                baseIva0 += subtotalitem;
            }
        });                
        
        iva12 = (baseIva12 * piva).toFixed(2) * 1;
        total = (baseIva0 + baseIva12 + iva12 - descuento).toFixed(2) * 1;        
        
        $('#subtotal').autoNumeric('set',subtotal);
        
        $('#baseIva0').autoNumeric('set',baseIva0);
        $('#iva0').autoNumeric('set',iva0);
        
        $('#baseIva12').autoNumeric('set',baseIva12);
        $('#iva12').autoNumeric('set',iva12);
        
        $('#descuento').autoNumeric('set',descuento);
        $('#total').autoNumeric('set',total);      
        
        $('#frmEdit').valid();
    }
    
    function showModalSeries(a){
        var tr = $(a).closest('tr');
        var pid = $(tr).find('input[property=producto_id]').val();
        var can = $(tr).find('input[property=cantidad]').val() * 1;
        var series = $(tr).find('input[property=series]').val();
        
        $('#div-modals').load('<?=  base_url()?>productos/get_modal_series_venta/'+pid, {}, function(){
            $('#modal-series').modal('show');            
            series = series === '' ? [] : series.split(',');
            
            $(series).each(function(i, s){                
                $("#select-series option[value="+s+"]").attr('selected','selected');
            });                        
            
            $('#select-series').select2({
                placeholder: "Seleccione las series",
                allowClear: true,
                maximumSelectionSize: can
            });
            
            $("#select-series").on("change", function (e) {        
                var tags = "" + e.val;                
                $(tr).find('input[property=series]').val(tags);   
                $(tr).find('input[property=series]').valid();
            });
        });
    };
    
    function CambiarTarifa(){
        GenerarComprobante();
        
        var tid = $('#tarifa_id').val();                
        var data = $('#frmEdit').serialize();
        
        $.ajax({
            url: '<?=  base_url()?>ventas/cambiar_tarifa',
            data: data,
            type: 'post',
            dataType: 'json',
            cache:false,
            success: function(data){                
                if(data.error){
                    alert(data.error);                       
                }else{
                    var trs = $("#detalle tbody tr");
                    $(data).each(function(i, item){    
                        var tr = trs[i];
                        var p = $(tr).find('input[property=precio_unitario]:first');
                        $(p).val(item.precio_unitario);
                    });                                      
                }
                CalcularTotal();
            },
            error: function(error){
                alert(error);
            }
        });
        
    }

</script>