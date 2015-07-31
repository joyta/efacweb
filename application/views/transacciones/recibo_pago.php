<html>
    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <link type="text/css"rel="stylesheet" href="<?=  base_url()?>css/pdf.css"/>
        <script type="text/javascript">
            window.print();
        </script>
        <title>Recibo pago</title>
    </head>
    <body>        
        <table>
            <tr>
                <td rowspan="5"><img alt="Logo" src="<?=  base_url()?>img/logo/logo_ride.jpg"/></td>                
                <td><h2>COMPROBANTE DE PAGO</h2></td>
            </tr>
            <tr>
                <td><strong>Cliente:</strong></td>
                <td><?=$entidad->documento?> - <?=$entidad->razon_social?></td>
            </tr>
            <tr>
                <td><strong>Fecha:</strong></td>
                <td><?=$cobro->fecha?></td>
            </tr>
            <tr>
                <td><strong>Concepto:</strong></td>
                <td><?=$cobro->concepto?></td>
            </tr>
            <tr>
                <td><strong>Monto:</strong></td>
                <td><?=  number_format($cobro->monto, 2)?></td>
            </tr>
        </table>
        
        <br/>
        <br/>
        
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>                    
                    <th>Factura</th>                                        
                    <th>Usuario</th>                    
                    <th class="text-right">Monto</th>                                    
                    <th class="text-right">Saldo</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($pagos as $item): ?>
                    <tr>                        
                        <td><?=$item->concepto?></td>
                        <td></td>
                        <td class="text-right"><?=  number_format($item->monto,2)?></td>                                    
                        <td class="text-right"><?=  number_format($item->saldo,2)?></td>
                    </tr>
                <? endforeach; ?>
                <?if($cobro->saldo > 0):?>
                    <tr>
                        <td colspan="2">Anticipo</td>
                        <td class="text-right"><?=number_format($cobro->saldo,2)?></td>
                        <td class="text-right">0.00</td>
                    </tr>
                <?  endif;?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="2">Totales: </th>                   
                    <th class="text-right"><?=  number_format($cobro->saldo + array_reduce($pagos, function($i, $obj){return $i += $obj->monto;}),2)?></th>
                    <th class="text-right"><?=  number_format(array_reduce($pagos, function($i, $obj){return $i += $obj->saldo;}),2)?></th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>