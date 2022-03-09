		<div ng-controller="musica">
			<div class="row">	
				<div class="col push-l8 s4 m4 l4">		
					<inputfield class="col s8 m8 l8 xl10 right">				 
						<input type="text" id="CampoBuscar" class="validate" ng-model="CampoBuscar" ng-keyup="CampoBuscar == '' && getBusca(0,CampoBuscar)" placeholder="Digite o que procura"  ng-keydown="$event.keyCode === 13 && getBusca(0,CampoBuscar)">    
					</inputfield>					
					<i class="fas fa-search right" style="line-height: 4;"></i>
				</div>
			</div>
			<table class="striped z-depth-1" ng-init="getBusca()" >
				<thead>
					<tr>				
						<th></th>	
						<th><a href="" ng-click="ordernar('artista');" title="ordernar por artista">Artista</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'artista'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>										
						<th><a href="" ng-click="ordernar('musica');" title="ordernar por musica">Música</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'musica'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>										
						<th><a href="" ng-click="ordernar('data_pedido');" title="ordernar por data_pedido">Data do pedido</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'data_pedido'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>					
						<th><a href="" ng-click="ordernar('programacao.nome_programa');" title="ordernar por programa">Programa</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'programacao.nome_programa'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>				
						<th><a href="" ng-click="ordernar('seu_nome');" title="ordernar por seu_nome">Pedido por</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'seu_nome'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>										
						<th><a href="" ng-click="ordernar('data_nascimento');" title="ordernar por data_nascimento">Data de Nascimento</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'data_nascimento'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>						
					</tr>
				</thead>

				<tbody class="grey-text lighten-4">
					<tr ng-repeat="v in lista.dados" ng-class="{'black-text accent-1':v.status}">																<th><i ng-class="[{'far fa-eye':!v.status},{'far fa-eye-slash':v.status}]"></i></th>
						<th><a href=""  ng-click="lerPedido(v);" ng-bind="v.artista"></a></th>					
						<th ng-bind="v.musica"></th>
						<th ng-bind="v.data_pedido|toDate|date:'dd/MM/yy hh:mm'"></th>										
						<th ng-bind="v.nome_programa"></th>
						<th ng-bind="v.seu_nome"></th>
						<th ng-bind="v.data_nascimento |toDate|date:'dd/MM/yy'"></th>
					</tr>
				</tbody>
			</table>

			<div class="row">
				<div class="col s3 m3 l3 xl3">
					<p class="left" style="line-height: 3;">Total de registros: <span ng-bind="lista.paginacao"></span></p>
				</div><div class="col s9 m9 l9 xl9">
					<div class="right">
						<pagination
						page="1"
						page-size="15"
						total="lista.paginacao"
						pagination-action="getBusca(page-1,CampoBuscar)"
						ul-class="pagination">
					</div>
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