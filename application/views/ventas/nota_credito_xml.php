<?php
    $numero = explode('-', $comprobante->numero);
    $tipoidentificacion = "08";
    switch ($entidad->tipo_documento) {
        case 'Ruc': $tipoiden = '04';break;
        case 'Cedula': $tipoiden = '05';break;
        case 'Pasaporte': $tipoiden = '06';break;    
        case 'ClienteOcacional': $tipoiden = '07';break;    
    default: break;
}
?>
<?='<?xml version="1.0" encoding="utf-8"?>'?>

<notaCredito id="comprobante" version="1.1.0">
    <infoTributaria>
        <ambiente><?=config_item('sri_ambiente')?></ambiente>
        <tipoEmision>1</tipoEmision>
        <razonSocial><?=$empresa->razon_social?></razonSocial>
        <nombreComercial><?=$empresa->nombre_comercial?></nombreComercial>
        <ruc><?=$empresa->documento?></ruc>
        <claveAcceso><?=$comprobante->clave_acceso?></claveAcceso>
        <codDoc><?=$comprobante->tipo?></codDoc>
        <estab><?=$numero[0]?></estab>
        <ptoEmi><?=$numero[1]?></ptoEmi>
        <secuencial><?=$numero[2]?></secuencial>
        <dirMatriz><?=$empresa->direccion?></dirMatriz>
    </infoTributaria>
    <infoNotaCredito>
        <fechaEmision><?=date("d/m/Y", strtotime($comprobante->fecha));?></fechaEmision>
        <dirEstablecimiento><?=$establecimiento->direccion?></dirEstablecimiento>		
        <tipoIdentificacionComprador><?=$tipoidentificacion?></tipoIdentificacionComprador>                                
        <razonSocialComprador><?=$entidad->razon_social?></razonSocialComprador>
        <identificacionComprador><?=$entidad->documento?></identificacionComprador>                
        <obligadoContabilidad>SI</obligadoContabilidad>                
        <codDocModificado><?=$referencia->tipo?></codDocModificado>
        <numDocModificado><?=$referencia->numero?></numDocModificado>
        <fechaEmisionDocSustento><?=date("d/m/Y", strtotime($referencia->fecha));?></fechaEmisionDocSustento>                
        <totalSinImpuestos><?= number_format($comprobante->total_sin_impuestos, 2)?></totalSinImpuestos>
        <valorModificacion><?= number_format($comprobante->importe_total, 2)?></valorModificacion>
        <moneda>DOLAR</moneda>                
        <totalConImpuestos>
            <totalImpuesto>
                <codigo>2</codigo>
                <codigoPorcentaje>0</codigoPorcentaje>
                <baseImponible><?=number_format($comprobante->baseIva0, 2)?></baseImponible>                
                <valor>0.00</valor>
            </totalImpuesto>
            <totalImpuesto>
                <codigo>2</codigo>
                <codigoPorcentaje>2</codigoPorcentaje>
                <baseImponible><?=number_format($comprobante->baseIva12, 2)?></baseImponible>                
                <valor><?=number_format($comprobante->iva12, 2)?></valor>
            </totalImpuesto>
        </totalConImpuestos>
        <motivo>DEVOLUCIÓN</motivo>
    </infoNotaCredito>
    <detalles>
        <?foreach($detalles as $detalle):?>
        <detalle>
            <codigoInterno><?=$detalle->codigo?></codigoInterno>
            <codigoAdicional><?=$detalle->codigo?></codigoAdicional>
            <descripcion><?=$detalle->descripcion?></descripcion>
            <cantidad><?=$detalle->cantidad?></cantidad>
            <precioUnitario><?=number_format($detalle->precio_unitario, 6)?></precioUnitario>
            <descuento><?=number_format($detalle->descuento, 2)?></descuento>
            <precioTotalSinImpuesto><?=number_format($detalle->precio_total_sin_impuestos - $detalle->descuento, 2)?></precioTotalSinImpuesto>
            <impuestos>
                <impuesto>
                    <?if($detalle->producto->iva == 't'):?>
                    <codigo>2</codigo>
                    <codigoPorcentaje>2</codigoPorcentaje>
                    <tarifa>12</tarifa>
                    <baseImponible><?=number_format($detalle->precio_total_sin_impuestos - $detalle->descuento, 2)?></baseImponible>
                    <valor><?=number_format(($detalle->precio_total_sin_impuestos -  $detalle->descuento) *  0.12, 2)?></valor>
                    <?else:?>
                    <codigo>2</codigo>
                    <codigoPorcentaje>0</codigoPorcentaje>
                    <tarifa>0</tarifa>
                    <baseImponible><?=number_format($detalle->precio_total_sin_impuestos - $detalle->descuento, 2)?></baseImponible>
                    <valor>0.00</valor>
                    <?endif;?>
                </impuesto>
            </impuestos>
        </detalle>
        <?endforeach;?>
    </detalles>
    <infoAdicional>
        <campoAdicional nombre="email"><?=$entidad->email?></campoAdicional>
        <campoAdicional nombre="direccion"><?=$entidad->direccion?></campoAdicional>
        <campoAdicional nombre="telefono"><?=$entidad->telefono?></campoAdicional>
    </infoAdicional>
</notaCredito>