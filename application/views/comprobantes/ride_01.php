<?php    
    $EMPRESA_OBLIGADA_CONTABILIDAD=get_valor_parametro("EMPRESA_OBLIGADA_CONTABILIDAD");
    $EMPRESA_NUMERO_RESOLUCION=get_valor_parametro("EMPRESA_NUMERO_RESOLUCION");
?>

<table style="width: 100%">
    <tr>
        <td style="width: 50%">            
            <img alt="Logo empresa" src="img/logo/logo_ride.jpg"/>
        </td>        
        <td rowspan="2" style="vertical-align: bottom; padding-left: 8px;">
            <div style="border: 1px solid #cacaca; border-radius: 4px; padding: 5px; line-height: 18px;">
                RUC.: <?=$empresa->documento?>
                <h2 class="heading">FACTURA</h2>
                <strong>No. <?=$comprobante->numero?></strong>
                <br/>
                NÚMERO DE AUTORIACIÓN
                <br/>
                <?=$comprobante->numero_autorizacion?>
                <br/>
                FECHA Y HORA DE AUTORIZACIÓN
                <br/>
                <?=$comprobante->fecha_autorizacion?>
                <br/>
                AMBIENTE: <?=$comprobante->ambiente?>
                <br/>
                EMISIÓN: NORMAL
                <br/>
                CLAVE DE ACCESO
                <br/>
                <img src="<?=  base_url()?>efacapi/barcode/<?=$comprobante->clave_acceso?>">
                <br/>
                <?=$comprobante->clave_acceso?>
            </div>
        </td>
    </tr>
    <tr>        
        <td style="vertical-align: bottom;">
            <div style="border: 1px solid #cacaca; border-radius: 4px; padding: 5px;">
                <strong><?=$empresa->razon_social?></strong>
                <br/>
                Dirección Matriz: <?=$empresa->direccion?>
                <br/>
                Dirección Sucursal: <?=$establecimiento->direccion?>
                <br/>
                <?if($EMPRESA_NUMERO_RESOLUCION):?>
                Contribuyente Especial Nro: <?=$EMPRESA_NUMERO_RESOLUCION?>
                <?  endif;?>
                <br/>
                OBLIGADO A LLEVAR CONTABILIDAD: <?=$EMPRESA_OBLIGADA_CONTABILIDAD?>
            </div>
        </td>        
    </tr>    
</table>

<div style="border: 1px solid #cacaca; border-radius: 4px; padding: 5px; margin-top: 8px;">                
    <table style="width: 100%">
        <tr>
            <td><strong>Razón Social/Nombres y Apellidos:</strong></td>
            <td><?=$entidad->razon_social?></td>
            <td><strong>Identificación:</strong></td>
            <td><?=$entidad->documento?></td>
        </tr>
        <tr>
            <td><strong>Fecha Emisión:</strong></td>
            <td><?=date('d/m/Y', strtotime($comprobante->fecha))?></td>
            <td><strong>Guía Remisión:</strong></td>
            <td></td>
        </tr>
    </table>
</div>

<table class="table table-bordered" style="width: 100%; margin-top: 10px;">
    <thead>
        <tr>
            <th>Cod. Principal</th>
            <th>Cod. Auxiliar</th>
            <th>Cant</th>
            <th>Descripción</th>
            <th>Precio Unitario</th>
            <th>Descuento</th>
            <th>Precio Total</th>
        </tr>
    </thead>
    <tbody>
        <?  foreach ($detalles as $item):?>
        <tr>
            <td><?=$item->codigo?></td>
            <td><?=$item->codigo?></td>
            <td><?=$item->descripcion?></td>
            <td class="text-right"><?=  number_format($item->cantidad, 2)?></td>
            <td class="text-right"><?=  number_format($item->precio_unitario, 6)?></td>
            <td class="text-right"><?=  number_format($item->descuento, 2)?></td>
            <td class="text-right"><?=  number_format($item->precio_total_sin_impuestos, 2)?></td>
        </tr>
        <?  endforeach;?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" rowspan="6" style="vertical-align: bottom; padding-left: 0px; padding-bottom: 0px; border-left: 1px solid #ffffff !important; border-bottom: 1px solid #ffffff !important;">
                <div style="border: 1px solid #cacaca; padding: 5px; margin-right: 10px">
                    <strong>Informacion Adicional</strong>
                    <br/>
                    <br/>
                    Dirección:&nbsp;&nbsp;&nbsp;&nbsp; <?=$entidad->direccion?>
                    <br/>
                    Teléfono&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp; <?=$entidad->telefono?>
                    <br/>
                    Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp; <?=$entidad->email?>
                </div>
            </td>
            <td colspan="2" class="text-right">SUBTOTAL <?=$comprobante->porcentaje_iva * 1?>%</td>
            <td class="text-right"><?=  number_format($comprobante->baseIva12, 2)?></td>
        </tr>
        <tr>            
            <td colspan="2" class="text-right">SUBTOTAL 0%</td>
            <td class="text-right"><?=  number_format($comprobante->baseIva0, 2)?></td>
        </tr>
        <tr>            
            <td colspan="2" class="text-right">SUBTOTAL</td>
            <td class="text-right"><?=  number_format($comprobante->total_sin_impuestos, 2)?></td>
        </tr>
        <tr>            
            <td colspan="2" class="text-right">DESCUENTO</td>
            <td class="text-right"><?=  number_format($comprobante->total_descuento, 2)?></td>
        </tr>
        <tr>            
            <td colspan="2" class="text-right">IVA <?=$comprobante->porcentaje_iva * 1?>%</td>
            <td class="text-right"><?=  number_format($comprobante->iva12, 2)?></td>
        </tr>
        <tr>            
            <td colspan="2" class="text-right">TOTAL</td>
            <td class="text-right"><?=  number_format($comprobante->importe_total, 2)?></td>
        </tr>
    </tfoot>
</table>