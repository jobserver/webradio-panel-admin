<div class="row" ng-controller="aplicativo">
	<div class="col s12 m3 l3">
		<div class="card-panel stats-card purple purple-text text-lighten-5">
			<i class="fas fa-music"></i>
			<a href="#pedirMusica" class="purple-text text-lighten-5">
				<span class="count" ng-bind="configRadio.dashboard.musicaNova">---</span>
				<div class="name">Pedidos de Música</div>
			</a>
		</div>
	</div>
	<div class="col s12 m3 l3">
		<div class="card-panel stats-card blue-grey blue-text text-lighten-5">
			<i class="fa fa-sign-language"></i>
			<a href="#oracao" class="blue-text text-lighten-5">
				<span class="count" ng-bind="configRadio.dashboard.oracaoNova">---</span>
				<div class="name">Pedidos de Oração</div>
			</a>
		</div>
	</div>
	<div class="col s12 m3 l3">
		<div class="card-panel stats-card blue blue-text text-lighten-5">
			<i class="far fa-clock"></i>
			<a href="#programacao" class="blue-text text-lighten-5">
				<span class="count" ng-bind="configRadio.dashboard.programas.length">---</span>
				<div class="name">Programas</div>
			</a>
		</div>
	</div>
	<div class="col s12 m3 l3">
		<div class="card-panel stats-card amber darken-3 amber-text text-lighten-5">
			<i class="fas fa-birthday-cake"></i>
			<span class="count" ng-bind="configRadio.dashboard.aniversariantes.length">---</span>
			<div class="name">Aniversariantes do dia</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12 m5 l3">
		<div class="card-panel">
			<h6>Vídeo ao Vivo</h6>
			<form ng-submit="salvarVideoAovivo()">
				<div class="row">
					<inputfield class="col s12 m12 l12 xl12">
						<label for="url" >Live Youtube</label>
						<input type="text" id="url" ng-model="videoForm.url">    
					</inputfield>  
					<inputfield class="col s12 m12 l12 xl12">
						<label for="status">Programa</label>   
						<select class="browser-defaul"  id="status" ng-model="videoForm.programa" material-select>    
							<option value="{{value.id}}" ng-repeat="(key, value) in configRadio.dashboard.programas" ng-bind="value.nome_programa">Ativo</option>							 
						</select>
					</inputfield>					
				</div>
				 <div class="row">   
  <div class="col s12 m12 l12 xl12">
   <div class="right">   
    <button type="submit" class="btn">Salvar</button>
   </div>
  </div>
 </div>
			</form>
		</div>
	</div>

	<div class="col s12 m8 l5">
		<div class="card-panel" style="min-height: 320px;">
			<h6>Últimas músicas pedidas</h6>
			<table class="highlight">
				<thead>
					<tr>
						<th>Artista</th>
						<th>Música</th>						
						<th>Data</th>						
					</tr>
				</thead>

				<tbody>
					<tr ng-repeat="(key, v) in configRadio.dashboard.ultimasPedidas">
						<td ng-bind="v.artista"></td>						
						<td ng-bind="v.musica"></td>						
						<td ng-bind="v.data_pedido"></td>						
					</tr>			
				</tbody>
			</table>
		</div>
	</div>
	
</div>


<style>
	.stats-card {
		display: block;
		position: relative;
		overflow: hidden;
	}
	.card-panel {
		margin: 0;
	}
	.card-panel {
		padding: 2rem;
	}

	.stats-card .count {
		position: relative;
		font-weight: 700;
		font-size: 2rem;
		line-height: 2rem;
	}

	.stats-card .name {
		position: relative;
		font-size: 1rem;
		line-height: 1rem;
	}
	.stats-card>i {
		position: absolute;
		font-size: 6rem;
		right: 0;
		bottom: -1rem;
	}
</style>