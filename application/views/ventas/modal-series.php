<!-- Modal -->
<div class="modal fade" id="modal-series" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Series <?=$producto->codigo?> - <?=$producto->nombre?></h4>
      </div>
      <div class="modal-body form-horizontal">                  
          <div class="form-group">
              <div class="col-md-12">
                  <select id="select-series" multiple="true" style="width: 100%">
                      <?  foreach ($series as $s):?>                      
                      <option value="<?=$s->numero?>"><?=$s->numero?></option>
                      <?  endforeach;?>
                  </select>
                  <p class="help-block text-warning">Seleccione las series</p>
              </div>              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Aceptar</button>        
      </div>
    </div>
  </div>
</div>