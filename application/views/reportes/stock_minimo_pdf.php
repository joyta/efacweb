<html>
    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <link type="text/css"rel="stylesheet" href="<?=  base_url()?>css/pdf.css"/>                
    </head>
    <body>        
        <table>
            <tr>
                <td rowspan="4"><img alt="Logo" src="img/logo/logo_ride.jpg"/></td>                
                <td><h2>Productos bajo la cantidad mínima</h2></td>
            </tr>
            <tr>
                <td><strong>Establecimiento: </strong></td>
                <td><?=$establecimiento->nombre?></td>
            </tr>
            <tr>
                <td><strong>Fecha:</strong></td>
                <td><?=  date('d/m/Y H:m')?></td>
            </tr>
            <tr>
                <td><strong>Usuario:</strong></td>
                <td><?= $user['nombre']?></td>
            </tr>
        </table>
        
        <br/>
        
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>                                                                        
                    <th class="text-right">Cantidad</th>
                    <th class="text-right">Cant. Mínima</th>
                    <th class="text-right">Cant. Máxima</th>
                    <th class="text-right">Faltante</th>                    
                </tr>
            </thead>
            <tbody>
                <? foreach ($lista as $item): ?>
                    <tr>                                    
                        <td><?=$item->codigo?></td>
                        <td><?=$item->nombre?></td>                                    
                        <td class="text-right"><?=  number_format($item->cantidad,2)?></td>
                        <td class="text-right"><?=  number_format($item->cantidad_minima,2)?></td>
                        <td class="text-right"><?=  number_format($item->cantidad_maxima,2)?></td>                                    
                        <td class="text-right"><?=  number_format($item->cantidad_minima - $item->cantidad,2)?></td>                                    
                    </tr>
                <? endforeach; ?>
            </tbody>            
        </table>
    </body>
</html>