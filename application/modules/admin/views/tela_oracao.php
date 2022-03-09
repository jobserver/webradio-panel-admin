		<div ng-controller="oracao">
			<div class="row">	
				<div class="col push-l8 s12 m4 l4">		
					<inputfield class="col s10 m8 l8 xl10 right">				 
						<input type="text" id="CampoBuscar" class="validate" ng-model="CampoBuscar" ng-keyup="CampoBuscar == '' && getBusca(0,CampoBuscar)" placeholder="Digite o que procura"  ng-keydown="$event.keyCode === 13 && getBusca(0,CampoBuscar)">    
					</inputfield>					
					<i class="fas fa-search right" style="line-height: 4;"></i>
				</div>
			</div>

			<table class="striped  z-depth-1" ng-init="getBusca()" >
				<thead>
					<tr>				
						<th class="hide-on-small-only"></th>	
						<th><a href="" ng-click="ordernar('nome');" title="ordernar por nome">Nome</a>
						<span class="sortorder" ng-show="ordenacao.campo === 'nome'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
					</th>					
						<th class="hide-on-small-only">Celular</th>
						<th class="hide-on-small-only"><a href="" ng-click="ordernar('cidade');" title="ordernar por cidade">Cidade</a>
						<span class="sortorder" ng-show="ordenacao.campo === 'cidade'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
					</th>										
						<th class="hide-on-small-only"><a href="" ng-click="ordernar('programacao.nome_programa');" title="ordernar por programa">Programa</a>
						<span class="sortorder" ng-show="ordenacao.campo === 'programacao.nome_programa'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
					</th class="hide-on-small-only">
						<th class="hide-on-small-only"><a href="" ng-click="ordernar('data_pedido');" title="ordernar por data_pedido">Data do pedido</a>
						<span class="sortorder" ng-show="ordenacao.campo === 'data_pedido'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
					</th>						
					</tr>
				</thead>

				<tbody class="grey-text lighten-4">
					<tr ng-repeat="v in lista.dados" ng-class="{'black-text accent-1':v.status}">																
						<th class="hide-on-small-only"><i ng-class="[{'far fa-eye':!v.status},{'far fa-eye-slash':v.status}]"></i></th>
						<th><a class="modal-trigger" href="#lerPedidoOracao" ng-click="lerPedido(v);" ng-bind="v.nome" modal></a></th>					
						<th class="hide-on-small-only" ng-bind="v.celular"></th>
						<th class="hide-on-small-only" ng-bind="v.cidade"></th>										
						<th class="hide-on-small-only" ng-bind="v.nome_programa"></th>
						<th class="hide-on-small-only" ng-bind="v.data_pedido |toDate|date:'dd/MM/yy hh:mm'"></th>
					</tr>
				</tbody>
			</table>

			<div class="row">
				<div class="col s3 m3 l3 xl3">
					<p class="left" style="line-height: 3;">Total de registros: <span ng-bind="lista.paginacao"></span></p>
				</div><div class="col s9 m9 l9 xl9">
					<div class="right">
						<pagination class="blue"
						page="1"
						page-size="15"
						total="lista.paginacao"
						pagination-action="getBusca(page-1,CampoBuscar)"
						ul-class="pagination">
					</div>
				</div>
			</div>
			

			<!-- Modal Structure -->
			<div id="lerPedidoOracao" class="modal">
				<div class="modal-content">										
						<i class="far fa-times-circle fa-2x right modal-close"></i>					
						<h5>Pedido de Oração</h5> 
					<b>Enviado por:</b> <span ng-bind="pedidoAtivo.nome"></span>
					<hr>
					<b>Pedido:</b> <p ng-bind="pedidoAtivo.pedido"></p>
				</div>
			</div>
		</div>


		<style>
			.sortorder:after {
  content: '\25b2';   // BLACK UP-POINTING TRIANGLE
}
.sortorder.reverse:after {
  content: '\25bc';   // BLACK DOWN-POINTING TRIANGLE
}
		</style>