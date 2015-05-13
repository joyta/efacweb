<html>
    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <link type="text/css"rel="stylesheet" href="<?=  base_url()?>css/pdf.css"/>                
    </head>
    <body>        
        <table>
            <tr>
                <td rowspan="3"><img alt="Logo" src="img/logo/logo_ride.jpg"/></td>                
                <td><h2>Total de compras por establecimiento</h2></td>
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
                    <th>Establecimiento</th>
                    <th class="text-right">Base Iva 0</th>
                    <th class="text-right">Base Iva 12</th>
                    <th class="text-right">Total Iva 12</th>
                    <th class="text-right">Subtotal</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($lista as $item): ?>
                    <tr>
                        <td><?= $item->establecimiento ?></td>
                        <td class="text-right"><?= number_format($item->baseiva0, 2) ?></td>
                        <td class="text-right"><?= number_format($item->baseiva12, 2) ?></td>
                        <td class="text-right"><?= number_format($item->iva12, 2) ?></td>
                        <td class="text-right"><?= number_format($item->total_sin_impuestos, 2) ?></td>
                        <td class="text-right"><?= number_format($item->importe_total, 2) ?></td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>
    </body>
</html>