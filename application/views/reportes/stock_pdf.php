<html>
    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <link type="text/css"rel="stylesheet" href="<?=  base_url()?>css/pdf.css"/>                
    </head>
    <body>        
        <table>
            <tr>
                <td rowspan="2"><img alt="Logo" src="img/logo/logo_ride.jpg"/></td>                
                <td><h2>Reporte de stock</h2></td>
            </tr>
            <tr>
                <td><strong>Establecimiento:</strong></td>
                <td><?=$establecimiento->nombre?></td>
            </tr>
            <tr>
                <td><strong>Fecha:</strong></td>
                <td><?=  date('d-m-Y H:i')?></td>
            </tr> 
        </table>
        
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <tr>                                                          
                        <th>Código</th>
                        <th>Nombre</th>									
                        <th class="text-right">Cantidad</th>                                    
                    </tr>
                </tr>
            </thead>
            <tbody>
                <? foreach ($lista as $item): ?>
                    <tr>                        
                        <td><?=$item->codigo?></td>
                        <td><?=$item->nombre?></td>                        
                        <td class="text-right"><?=  number_format($item->cantidad,2)?></td>
                    </tr>
                <? endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="2">Totales: </th>
                    <th class="text-right"><?=  number_format(array_reduce($lista, function($i, $obj){return $i += $obj->cantidad;}),2)?></th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>