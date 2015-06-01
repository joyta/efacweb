<?if($tipo=="Cadena"):?>                            
<div class="form-group">
    <label class="col-md-2 control-label">Valor</label>
    <div class="col-md-10">
        <input name="valor" id="valor" class="form-control" placeholder="Valor" type="text" maxlength="255" value="<?=$valor?>">
    </div>
</div>
<?  endif;?>
<?if($tipo=="Email"):?>                            
<div class="form-group">
    <label class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
        <input name="valor" id="valor" class="form-control email" placeholder="Email" type="text" maxlength="255" value="<?=$valor?>">
    </div>
</div>
<?  endif;?>
<?if($tipo=="Clave"):?>                            
<div class="form-group">
    <label class="col-md-2 control-label">Clave</label>
    <div class="col-md-10">
        <input name="valor" id="valor" class="form-control" placeholder="Email" type="password" maxlength="255" value="<?=$valor?>">
    </div>
</div>
<?  endif;?>

<?if($tipo=="Decimal"):?>                            
<div class="form-group">
    <label class="col-md-2 control-label">Valor</label>
    <div class="col-md-4">
        <input name="valor" id="valor" class="form-control numeric text-right" placeholder="Valor" type="text" maxlength="255" value="<?=$valor?>">
    </div>
</div>
<script type="text/javascript">
    $('.numeric').autoNumeric(FormatoDecimal);
</script>
<?  endif;?>

<?if($tipo=="Booleano"):?>                            
<div class="form-group">
    <label class="col-md-2 control-label">Valor</label>
    <div class="col-md-4">
        <select id="valor" name="valor" class="form-control required">
            <option value="SI" <?=$valor=='SI'?'selected':''?>>SI</option>
            <option value="NO" <?=$valor=='NO'?'selected':''?>>NO</option>
        </select>
    </div>
</div>
<?  endif;?>