
<script type="text/javascript">

    $(document).ready(function(){
        $('#frmEdit').validate({
            rules: {
                nombre: {validUnique: 'inventario.unidad.nombre', minlength: 3},
                equivalencia: {number:'true'},
            },
            messages: {
                nombre: {validUnique: 'Nombre ya registrado'}
            }                  
        });
        
        $('.cliente').autocomplete(MapAutoCompleteCliente());
        $('.producto').autocomplete(MapAutoCompleteProducto());
        $('.producto').change(function(){
            CargarProducto();
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
                event.preventDefault();
            },
            open: function () { }, close: function () { }
        };
    }
    
    function MapAutoCompleteProducto() {
        return {
            source: function (request, response) {
                $.ajax({
                    url: '<?=  base_url()?>productos/get_autocomplete_productos_venta/'+request.term,
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
        $('#detalle tr[data-id="'+item.id+'"]').each(function(i, tr){
            cantidadAnt += ($(tr).attr('data-cantidad')*1) / item.equivalencia;
        });        
        
        var cantidad = GetCantidad() + cantidadAnt;        
        
        if(cantidad <= item.stock){
        
            item.cantidad = cantidad;
            item.total = (cantidad * item.precio) - item.descuento;

            var trn = "\
            <tr data-uid='"+uid+"' data-id='"+item.id+"' data-cantidad='"+cantidad+"' data-iva='"+item.iva+"'>\
                <td>\
                    <input type='hidden' property='producto_id' value='"+item.id+"'/>\
                    <input type='hidden' property='unidad_id' value='"+item.unidad_id+"'/>\
                    <a class='delete btn btn-danger btn-xs' title='Eliminar'><i class='fa fa-trash'></i></a>\
                </td>\
                <td><input type='text' class='form-control required' style='width: 100px' readonly='' property='codigo' value='"+item.codigo+"'/></td>\
                <td><input type='text' class='form-control required' style='width: 300px' readonly='' property='descripcion' value='"+item.nombre+' - '+ item.unidad_nombre+"'/></td>\
                <td><input type='text' class='form-control required text-right' style='width: 100px' readonly='' property='cantidad' value='"+item.cantidad+"'/></td>\
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
                <td><input type='text' class='form-control required text-right' style='width: 100px' readonly='' property='precio_total_sin_impuestos' value='"+item.total+"'/></td>\
            </tr>";
                    
            if(tro.length === 1){
                $(tro).before(trn);
                $(tro).remove();
            }else{
                $("#detalle tbody").append(trn);
            }
        }else{
            efac.infoBox('Cantidad superior al stock actual -> Stock: ' + item.stock + ", Catidad: "+cantidad);
        }
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
            var subtotalitem = $(tr).find("input[property=precio_total_sin_impuestos]").val() * 1;
            var descuentoitem = $(tr).find("input[property=descuento]").val() * 1;
            subtotal += subtotalitem;
            descuento += descuentoitem;
            if($(tr).attr('data-iva') === '1'){
                baseIva12 += subtotalitem;
            }else{
                baseIva0 += subtotalitem;
            }
        });                
        
        iva12 = (baseIva12 * 0.12).toFixed(2) * 1;
        total = (baseIva0 + baseIva12 + iva12 - descuento).toFixed(2) * 1;        
        
        $('#subtotal').val(subtotal);
        
        $('#baseIva0').val(baseIva0);
        $('#iva0').val(iva0);
        
        $('#baseIva12').val(baseIva12);
        $('#iva12').val(iva12);
        
        $('#descuento').val(descuento);
        $('#total').val(total);        
    }

</script>