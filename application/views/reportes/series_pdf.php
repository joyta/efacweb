<html>
    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <link type="text/css"rel="stylesheet" href="<?=  base_url()?>css/pdf.css"/>                
    </head>
    <body>        
        <table>
            <tr>
                <td rowspan="3"><img alt="Logo" src="img/logo/logo_ride.jpg"/></td>                
                <td><h2>Reporte de series disponibles</h2></td>
            </tr>
            <tr>
                <td><strong>Producto:</strong></td>
                <td><?=$producto->codigo?> - <?=$producto->nombre?></td>
            </tr>
            <tr>
                <td><strong>Establecimiento:</strong></td>
                <td><?=$establecimiento->nombre?></td>
            </tr>            
        </table>
        
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>                    
                    <th>Número serie</th>
                    <th>Fecha compra</th>
                    <th>Número compra</th>                    
                </tr>
            </thead>
            <tbody>
                <? foreach ($lista as $item): ?>
                    <tr>
                        <td><?=$item->numero?></td>
                        <td><?=$item->fecha_compra?></td>                       
                        <td><?=$item->numero_compra?></td>
                    </tr>
                <? endforeach; ?>
            </tbody>            
        </table>
    </body>
</html>