<html>
    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <link type="text/css"rel="stylesheet" href="<?=  base_url()?>css/pdf.css"/>                
    </head>
    <body>        
        <table>
            <tr>
                <td rowspan="3"><img alt="Logo" src="img/logo/logo_ride.jpg"/></td>                
                <td><h2>Compras</h2></td>
            </tr>
            <tr>
                <td><strong>Desde:</strong></td>
                <td><?=$desde?></td>
            </tr>
            <tr>
                <td><strong>Hasta:</strong></td>
                <td><?=$hasta?></td>
            </tr>
        </table>
        
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Número</th>
                    <th>Establecimiento</th>
                    <th>Entidad</th>                    
                    <th class="text-right">Subtotal 0%</th>
                    <th class="text-right">Subtotal 12%</th>
                    <th class="text-right">Iva 12%</th>                                    
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($lista as $item): ?>
                    <tr>
                        <td><?=  date('d-m-Y', strtotime($item->fecha))?></td>
                        <td><?=$item->numero?></td>
                        <td><?=$item->establecimiento?></td>
                        <td><?=$item->documento?> - <?=$item->razon_social?></td>                        
                        <td class="text-right"><?=  number_format($item->baseIva0,2)?></td>
                        <td class="text-right"><?=  number_format($item->baseIva12,2)?></td>
                        <td class="text-right"><?=  number_format($item->iva12,2)?></td>                                    
                        <td class="text-right"><?=  number_format($item->importe_total,2)?></td>
                    </tr>
                <? endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="4">Totales: </th>

                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->baseIva0;}), 2)?></th>
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->baseIva12;}),2)?></th>
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->iva12;}),2)?></th>
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->importe_total;}),2)?></th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>