<form id="form_programacao" name="forProgramacao"  ng-submit="salvar('salvar')">
 <h5>Programação</h5>
 <!-- <hr> -->
 <div class="row">
  <inputfield class="col s12 m4 l4 xl4">
   <label for="nome_programa" class="col-xs-3">Nome Programa</label>
   <input type="text" class="form-control" required  id="nome_programa" ng-model="form.nome_programa">    
 </inputfield>  

 <inputfield class="col s2 m2 l2 xl2">
   <label for="status">Status</label>   
   <select  id="status" ng-model="form.status" material-select>    
    <option value="" selected>Ativo</option>
    <option value="2">Suspenso</option>
    <option value="1">Removido</option>
  </select>
</inputfield>
   
    <inputfield class="col s2 m2 l2 xl2">
   <label for="status">Progração Padrão</label>   
   <select  id="status" ng-model="form.padrao" material-select>        
    <option value="0">Não</option>    
    <option value="1" selected>Sim</option>
  </select>
</inputfield>

<inputfield class="col s12 m4 l4 xl4">
 <label for="locutor" class="col-xs-3">Locutor</label>
 <input type="text" class="form-control" required  id="locutor" ng-model="form.locutor">    
</inputfield>  

<inputfield class="col s12 m6 l6 xl6">
   <label for="locutor" class="col-xs-3">Foto Locutor</label>
  <div class="file-field">    
   <div class="btn-small">
    <span><i class="fas fa-camera"></i> Foto</span>
    <input type='file' name='file[]' id='foto_locutor'><br/>
  </div>
       <div class="file-path-wrapper">
    <input class="file-path validate" type="text">
  </div>
</div>
</inputfield> 

<inputfield class="col s12 m6 l6 xl6">
   <label for="foto_programa" class="col-xs-3">Foto Programa</label>
  <div class="file-field">    
   <div class="btn-small">
    <span><i class="fas fa-camera"></i> Foto</span>
    <input type='file' name='file[]' id='foto_programa'><br/>
  </div>
       <div class="file-path-wrapper">
    <input class="file-path validate" type="text">
  </div>
</div>
</inputfield>  

<!-- <inputfield class="col s12 m3 l3 xl3">
 <label for="foto_programa" class="col-xs-3">Foto Programa</label>
 <input type="text" class="form-control"   id="foto_programa" ng-model="form.foto_programa">    
</inputfield>   -->

<inputfield class="col s12 m12 l12 xl12">
 <label for="descricao" class="col-xs-3">Descricão</label>
 <input type="text" class="form-control" required  id="descricao" ng-model="form.descricao">    
</inputfield>  

<inputfield class="col s12 m4 l4 xl4">
 <label for="facebook" class="col-xs-3">Facebook</label>
 <input type="text" class="form-control"   id="facebook" ng-model="form.facebook">    
</inputfield>  

<inputfield class="col s12 m4 l4 xl4">
 <label for="youtube" class="col-xs-3">Youtube</label>
 <input type="text" class="form-control"   id="youtube" ng-model="form.youtube">    
</inputfield>  

<inputfield class="col s12 m4 l4 xl4">
 <label for="instagram" class="col-xs-3">Instagram</label>
 <input type="text" class="form-control"   id="instagram" ng-model="form.instagram">    
</inputfield>  

<inputfield class="col s6 m6 l6 xl6">
 <label for="data_inicio" class="col-xs-3">Data de início do contrato</label>
 <input type="date" class="form-control" required  id="data_inicio" ng-model="form.data_inicio">    
</inputfield>  

<inputfield class="col s6 m6 l6 xl6">
 <label for="data_fim" class="col-xs-3">Data fFim do contrato</label>
 <input type="date" class="form-control"   id="data_fim" ng-model="form.data_fim">    
</inputfield>  

<inputfield class="col s12 m4 l4 xl4">
 <label for="email" class="col-xs-3">Email</label>
 <input type="email" class="form-control"   id="email" ng-model="form.email">    
</inputfield>  

<inputfield class="col s12 m4 l4 xl4">
 <label for="whatsapp" class="col-xs-3">Whatsapp</label>
 <input type="text" class="form-control" required  id="whatsapp" ng-model="form.whatsapp">    
</inputfield>  

<inputfield class="col s12 m4 l4 xl4">
 <label for="telefone" class="col-xs-3">Telefone</label>
 <input type="text" class="form-control"  id="telefone" ng-model="form.telefone">    
</inputfield>  

</div>
<div class="row" style="margin-bottom: 0px!important;">
  <div class="col s12">   
   <div class="right">
  <button type="button" class="btn red waves-effect waves-teal" ng-click="excluirPrograma()" ng-if="form.id">Excluir Programa</button>
  <button type="submit" class="btn green waves-effect waves-teal">Salvar</button>
  </div>
  </div>
</div>
</form>