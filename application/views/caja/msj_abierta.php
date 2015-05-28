<h4><i class="fa fa-warning txt-color-orangeDark"></i> Estimado usuario, usted ya ha hecho la apertura de caja</h4>

<hr/>

<div class="row">
    <div class="form-group">
        <label class="col-md-3 control-label"><strong>Fecha apertura:</strong></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?=$model->fecha_apertura?>
            </p>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-md-3 control-label"><strong>Monto apertura:</strong></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?=  number_format($model->monto_apertura, 2)?>
            </p>
        </div>
    </div>
</div>