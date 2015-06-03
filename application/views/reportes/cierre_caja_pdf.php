<html>
    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <link type="text/css"rel="stylesheet" href="<?= base_url() ?>css/pdf.css"/>                
    </head>
    <body>        
        <table>
            <tr>
                <td rowspan="3"><img alt="Logo" src="img/logo/logo_ride.jpg"/></td>                
                <td><h2>Reporte de cierre de caja</h2></td>
            </tr>            
            <tr>
                <td><strong>Apertura:</strong></td>
                <td><?= date('d-m-Y H:i:s', strtotime($model->fecha_apertura)) ?></td>
            </tr>
            <tr>
                <td><strong>Cierre:</strong></td>
                <td><?= date('d-m-Y H:i:s', strtotime($model->fecha_cierre)) ?></td>
            </tr>
        </table>

        <table>            
            <tr>
                <td><strong>Usuario:</strong></td>
                <td><?= $usuario->descripcion ?></td>
            </tr>
            <tr>
                <td><strong>Establecimiento:</strong></td>
                <td><?= $establecimiento->nombre ?></td>
            </tr>            
        </table>

        <br/>
        <br/>      

        <table style="width: 100%">
            <tr>
                <td style="width: 40%; vertical-align: top;">
                    <h4 style="color: #356635">Detalle del cierre</h4>

                    <table>            
                        <tr>
                            <td><strong>(+) Monto apertura:</strong></td>
                            <td><?= $model->monto_apertura ?></td>
                        </tr>
                        <tr>
                            <td><strong>(+) Ventas efectivo:</strong></td>
                            <td><?= $model->ventas_efectivo ?></td>
                        </tr>
                        <tr>
                            <td><strong>(+) Recaudaciones cxc:</strong></td>
                            <td><?= $model->recaudaciones_efectivo ?></td>
                        </tr>
                        <tr>
                            <td><strong>(-) Pagos cxp:</strong></td>
                            <td><?= $model->pagos_efectivo ?></td>
                        </tr>
                        <tr><td colspan="2">-----------------------------------------</td></tr>
                        <tr>
                            <td><strong>TOTAL EFECTIVO:</strong></td>
                            <td><?= $model->total_efectivo ?></td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL EXISTENTE:</strong></td>
                            <td><?= $model->total_existente ?></td>
                        </tr>
                        <tr><td colspan="2">-----------------------------------------</td></tr>
                        <tr>
                            <td><strong>DIFERENCIA:</strong></td>
                            <td><?= $model->diferencia ?></td>
                        </tr>

                    </table>
                </td>
                <td style="width: 20%"></td>
                <td style="width: 40%; vertical-align: top;">
                    <h4 style="color: #356635">Detalle de las ventas</h4>

                    <table>            
                        <tr>
                            <td><strong>Ventas al contado:</strong></td>
                            <td><?= $model->ventas_contado ?></td>
                        </tr>
                        <tr>
                            <td><strong>Ventas a crédito:</strong></td>
                            <td><?= $model->ventas_credito ?></td>
                        </tr>   
                        <tr><td colspan="2">-----------------------------------------</td></tr>
                        <tr>
                            <td><strong>TOTAL:</strong></td>
                            <td><?= $model->total_ventas ?></td>
                        </tr>   
                    </table>
                </td>
            </tr>
        </table>
        
        <br/>
        <br/>
        <br/>
        <br/>
        
        
        <table style="width: 100%">
            <tr>
                <td style="text-align: center;">--------------------------------------</td>
                <td style="width: 60px"></td>
                <td style="text-align: center;">--------------------------------------</td>
            </tr>
            <tr>
                <td style="text-align: center;"><?=$usuario->descripcion?></td>
                <td></td>
                <td style="text-align: center;">Autorizado por</td>
            </tr>
        </table>
        

    </body>
</html>