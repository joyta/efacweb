<?if($tipo=="Cadena"):?>                            
<div class="form-group">
    <label class="col-md-2 control-label">Valor</label>
    <div class="col-md-10">
        <input name="valor" id="valor" class="form-control" placeholder="Valor" type="text" value="<?=$valor?>">
    </div>
</div>
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