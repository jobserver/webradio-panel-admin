<form id="form_banner"  ng-submit="salvar()">
 <h5>Banner</h5>
 <div class="row">
  <inputfield class="col s12 m10 l10 xl10">
   <label for="link" >Empresa</label>
   <input type="text" class="form-control" name="empresa" id="empresa" ng-model="form.empresa">    
  </inputfield>  
  <inputfield class="col s12 m2 l2 xl2">
   <label for="status">Status</label>   
   <select  id="status" ng-model="form.status" material-select watch>    
    <option value="Ativo" selected>Ativo</option>
    <option value="Suspenso">Suspenso</option>    
   </select>
  </inputfield>
  <inputfield class="col s12 m12 l12 xl12">
   <label class="col-xs-3">Arquivo</label>
   <div class="file-field">    
    <div class="btn-small">
     <span><i class="fas fa-camera"></i> Foto do banner</span>
     <input type='file' name='file[]' id='arquivo'><br/>
    </div>
    <div class="file-path-wrapper">
     <input class="file-path validate" type="text">
    </div>
   </div>
  </inputfield> 

  <inputfield class="col s12 m12 l12 xl12">
   <label for="link" >Link</label>
   <input type="text" class="form-control" name="link" id="link" ng-model="form.link">    
  </inputfield>  
  
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