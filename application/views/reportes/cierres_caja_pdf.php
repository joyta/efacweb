<html>
    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <link type="text/css"rel="stylesheet" href="<?=  base_url()?>css/pdf.css"/>                
    </head>
    <body>        
        <table>
            <tr>
                <td rowspan="4"><img alt="Logo" src="img/logo/logo_ride.jpg"/></td>                
                <td><h2>Reporte de cierres de caja</h2></td>
            </tr>
            <tr>
                <td><strong>Desde:</strong></td>
                <td><?=$desde?></td>
            </tr>
            <tr>
                <td><strong>Hasta:</strong></td>
                <td><?=$hasta?></td>
            </tr>
            <tr>
                <td><strong>Usuario:</strong></td>
                <td><?=$usuario?></td>
            </tr>
        </table>
        
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>                                    
                    <th>Apertura</th>
                    <th>Cierre</th>
                    <th>Usuario</th>
                    <th>Establecimiento</th>    
                    <th class="text-right">Apertura</th>
                    <th class="text-right">Ventas efectivo</th>
                    <th class="text-right">Recaudaciones</th>
                    <th class="text-right">Pagos</th>
                    <th class="text-right">Total</th>
                    <th class="text-right">Existente</th>
                    <th class="text-right">Diferencia</th>
                </tr>
            </thead>
            <tbody>
                <?  foreach ($lista as $item):?>
                <tr>                                    
                    <td><?=  date('d-m-Y H:i', strtotime($item->fecha_apertura))?></td>
                    <td><?=  date('d-m-Y H:i', strtotime($item->fecha_cierre))?></td>
                    <td><?=$item->usuario?></td>
                    <td><?=$item->establecimiento?></td>                                                                        
                    <td class="text-right"><?=  number_format($item->monto_apertura,2)?></td>
                    <td class="text-right"><?=  number_format($item->ventas_efectivo,2)?></td>
                    <td class="text-right"><?=  number_format($item->recaudaciones_efectivo,2)?></td>
                    <td class="text-right"><?=  number_format($item->pagos_efectivo,2)?></td>
                    <td class="text-right"><?=  number_format($item->total_efectivo,2)?></td>
                    <td class="text-right"><?=  number_format($item->total_existente,2)?></td>
                    <td class="text-right"><?=  number_format($item->diferencia,2)?></td>
                </tr>
                <? endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="4">Totales: </th>                                                                        
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->monto_apertura;}),2)?></th>
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->ventas_efectivo;}),2)?></th>
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->recaudaciones_efectivo;}),2)?></th>
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->pagos_efectivo;}),2)?></th>
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->total_efectivo;}),2)?></th>
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->total_existente;}),2)?></th>
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->diferencia;}),2)?></th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>