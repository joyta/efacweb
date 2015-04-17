<div style="border: #004d60 solid 1px; width: 599px">
    
    <img alt="<?=$empresa->nombre_comercial?>" src="https://docs.google.com/uc?id=0B8m9lRdua28eYXFFT25YclBqLUU&export=download"/>
    
    <div style="padding: 10px">
    
        <h1 style="font-family:Arial;font-size:24px;font-weight:normal;color:#333333;margin:20px 0 20px 0;padding:0">
            Nuevo Comprobante
        </h1>

        <p style="font-family:Arial;font-size:13px;font-weight:normal;color:#888888;margin:0 0 20px 0;padding:0">
            Estimado(a) <strong><?=  strtoupper($entidad->razon_social)?>.- </strong>
        </p>

        <p style="font-family:Arial;font-size:13px;font-weight:normal;color:#888888;margin:0 0 20px 0;padding:0">
            Le informamos que "<?=$empresa->nombre_comercial?>" le ha emitido un comprobante electrónico:<br/><br/>
            <strong>Tipo: </strong> <?= label_tipo_comprobante($comprobante->tipo)?><br/>
            <strong>Número: </strong> <?= $comprobante->numero?><br/>
            <strong>Emisión: </strong> <?= date('d/m/Y H:m', strtotime($comprobante->fecha))?><br/>
            <strong>Ambiente: </strong> <?= $comprobante->ambiente?><br/>
        </p>

        <p style="font-family:Arial;font-size:13px;font-weight:normal;color:#888888;margin:0 0 20px 0;padding:0">
            Para revisar sus comprobantes electrónicos puede hacerlo en el sitio: 
            <a href="#">http://efac.com</a>
        </p>

        <p style="font-family:Arial;font-size:13px;font-weight:normal;color:#888888;margin:0 0 20px 0;padding:0">
            <small>Este correo ha sido enviado de forma automática, por favor no responder el mismo.</small>
        </p>
    
    </div>
</div>