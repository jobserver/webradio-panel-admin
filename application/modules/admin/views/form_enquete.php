<form id="form_enquete"  ng-submit="salvar()">
  <h5>Programação</h5>
  <div class="row">
    <inputfield class="col s12 m10 l10 xl10">
     <label for="pergunta" >Pergunta</label>
     <input type="text" class="form-control" required name="pergunta" id="pergunta" ng-model="form.pergunta">    
   </inputfield>
   <inputfield class="col s12 m2 l2 xl2">
     <label for="status">Status</label>   
     <select  id="status" ng-model="form.status" material-select watch>    
      <option value="1" selected>Ativo</option>
      <option value="2">Suspenso</option>    
    </select>
  </inputfield>
  <div class="row">
   <div class="col offset-l1 s10 m10 l10">
    <div ng-repeat="(key, value) in form.itens">
     <inputfield class="col s10 m10 l10 xl10">
      <label>Alternativa</label>
      <input type="text" class="form-control"  ng-model="value.item">
    </inputfield> 
    <inputfield class="col s2 m2 l2 xl2">
      <label>Votos</label>
      <input type="text" readonly disabled class="form-control" ng-model="value.valor">
    </inputfield>  
  </div>
</div>
</div>
</div>
<div class="row">   
  <div class="col s12 m12 l12 xl12">
    <div class="right">
      <button type="button" ng-click="excluir()" ng-if="form.id" class="btn red">Excluir</button>
      <button type="submit" class="btn">Salvar</button>
    </div>
  </div>
</div>
</form>