<form ng-submit="salvar()"  ng-init="editar()" ng-controller="configRadio">
 <div class="row">
  <inpufield class="col s12 m8 l8 xl8">
   <label for="nome_radio">Nome da Rádio</label>
   <input type="text" class="form-control" required name="nome_radio" id="nome_radio" ng-model="form.nome_radio">    
  </inpufield> 
    <inpufield class="col s12 m4 l4 xl4">
   <label for="logoRadio">Logotipo</label>
   <input type="text" class="form-control"  name="logoRadio" id="logoRadio" ng-model="form.logoRadio">    
  </inpufield>   
  <inpufield class="col s12 m3 l3 xl3">
   <label for="site">Site</label>
   <input type="text" class="form-control"  name="site" id="site" ng-model="form.site">    
  </inpufield>  
  <inpufield class="col s12 m3 l3 xl3">
   <label for="email">Email</label>
   <input type="text" class="form-control" required name="email" id="email" ng-model="form.email">    
  </inpufield>  
  <inpufield class="col s12 m3 l3 xl3">
   <label for="telefone">Telefone</label>
   <input type="text" class="form-control"  name="telefone" id="telefone" ng-model="form.telefone">    
  </inpufield>  
  <inpufield class="col s12 m3 l3 xl3">
   <label for="whatsapp">Whatsapp</label>
   <input type="text" class="form-control" required name="whatsapp" id="whatsapp" ng-model="form.whatsapp">    
  </inpufield>  
  <inpufield class="col s12 m6 l6 xl6">
   <label for="stream1">Servidor de Stream1</label>
   <input type="text" class="form-control" required name="stream1" id="stream1" ng-model="form.stream1">    
  </inpufield>  
  <inpufield class="col s12 m6 l6 xl6">
   <label for="stream2">Servidor de Stream2</label>
   <input type="text" class="form-control"  name="stream2" id="stream2" ng-model="form.stream2">    
  </inpufield>  
  <inpufield class="col s12">
   <label for="streamYoutube">StreamYoutube</label>
   <input type="text" class="form-control"  name="streamYoutube" id="streamYoutube" ng-model="form.streamYoutube">    
  </inpufield>  <inpufield class="col s12">
   <label for="streamFacebook">StreamFacebook</label>
   <input type="text" class="form-control"  name="streamFacebook" id="streamFacebook" ng-model="form.streamFacebook">    
  </inpufield>  <inpufield class="col s12 m4 l4 xl4">
   <label for="facebook">Facebook</label>
   <input type="text" class="form-control"  name="facebook" id="facebook" ng-model="form.facebook">    
  </inpufield>  <inpufield class="col s12 m4 l4 xl4">
   <label for="youtube">Youtube</label>
   <input type="text" class="form-control"  name="youtube" id="youtube" ng-model="form.youtube">    
  </inpufield>  <inpufield class="col s12 m4 l4 xl4">
   <label for="instagram">Instagram</label>
   <input type="text" class="form-control"  name="instagram" id="instagram" ng-model="form.instagram">    
  </inpufield>  
  <inpufield class="col s6">
   <label for="googlePlay">GooglePlay</label>
   <input type="text" class="form-control"  name="googlePlay" id="googlePlay" ng-model="form.googlePlay">    
  </inpufield>  <inpufield class="col s6">
   <label for="appStore">AppStore</label>
   <input type="text" class="form-control"  name="appStore" id="appStore" ng-model="form.appStore">    
  </inpufield>      
 </div>
 <div class="row">
 <div class="col s12 m12 l12">  
  <button type="submit" class="btn btn-primary right">Salvar</button>
 </div>
 </div>
</form>