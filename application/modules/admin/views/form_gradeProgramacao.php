<form   ng-submit="salvarHorario()">
 <h5>Programa <span ng-bind="progEdit.nome_programa"></span></h5>    
 <div class="row">
  <inputfield class="col s12 m3 l3 xl3">
   <label for="dia_semana" class="col-xs-3">Dia Semana</label>   
   <select  name="dia_semana" id="dia_semana" ng-model="formHorario.dia_semana" material-select watch>    
    <option ng-repeat="(key, value) in semana" value="{{key}}" ng-bind="value"></option>        
   </select>

  </inputfield>  
  <inputfield class="col s12 m3 l3 xl3">
   <label for="hora_inicio" class="col-xs-3">Hora Inicio</label>
   <input type="time" class="form-control" required name="hora_inicio" id="hora_inicio" ng-model="formHorario.hora_inicio">    
  </inputfield>  
  <inputfield class="col s12 m3 l3 xl3">
   <label for="hora_fim" class="col-xs-3">Hora Fim</label>
   <input type="time" class="form-control" required name="hora_fim" id="hora_fim" ng-model="formHorario.hora_fim">    
  </inputfield>  
 <inputfield class="col s3 m3 l3 xl3">
   <label for="hstatus">Status</label>   
   <select  id="hstatus" ng-model="formHorario.status" material-select>    
    <option value="" selected>Ativo</option>    
    <option value="1">Cancelado</option>
   </select>
  </inputfield>
 </div>
 <div class="row">
  <div class="col s12">   
   <div class="right">
  <button type="button" class="btn red waves-effect waves-teal" ng-click="excluirHorario()" ng-if="formHorario.id">Excluir Horário</button>
  <button type="submit" class="btn green waves-effect waves-teal">Salvar</button>
  </div>
  </div>
 </div>
</form>