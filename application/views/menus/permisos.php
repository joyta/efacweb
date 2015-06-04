<!-- Modal -->
<div class="modal fade" id="modal-permisos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Permisos: <?=$model->etiqueta?></h4>
      </div>
      <div class="modal-body form-horizontal">                  
          
          <input type="hidden" id="roles" name="roles" value="<?=$model->roles?>"/>
              
          
          <div class="form-group">
              <label class="col-md-2 control-label"><strong>Ruta</strong></label>
              <div class="col-md-10">
                  <p class="form-control-static"><?=$model->ruta?></p>
              </div>
          </div>
          
          <div class="form-group">
              <label class="col-md-2 control-label"><strong>Icono</strong></label>
              <div class="col-md-10">
                  <p class="form-control-static"><?=$model->icono?></p>
              </div>
          </div>
          
          <div class="form-group">
              <label class="col-md-2 control-label"><strong>Permisos</strong></label>
              <div class="col-md-10">
                  <select id="permisos" multiple="true">
                      <option value="Administrador" <?=  strpos($model->roles, 'Administrador') === FALSE ? "" : "selected"?>>Administrador</option>
                      <option value="Vendedor" <?=  strpos($model->roles, 'Vendedor') === FALSE ? "" : "selected"?>>Vendedor</option>
                      <option value="Bodeguero" <?=  strpos($model->roles, 'Bodeguero') === FALSE ? "" : "selected"?>>Bodeguero</option>
                  </select>
              </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
        <button type="button" class="btn btn-success" onclick="Guardar(<?$model->id?>);"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>