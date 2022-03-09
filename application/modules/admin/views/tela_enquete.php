		<div ng-controller="enquete">
			<div class="row">	
				<div class="col s4 m4 l4">							
					<button type="button" class="waves-effect waves-light btn-small" href="#lerEnquete" ng-click="novaEnquete();" modal>Nova Emquete</button>
				</div>
				<div class="col push-l4 s12 m4 l4">							
					<inputfield class="col s10 m8 l8 xl10 right">				 
						<input type="text" id="CampoBuscar" class="validate" ng-model="CampoBuscar" ng-keyup="CampoBuscar == '' && getBusca(0,CampoBuscar)" placeholder="Digite o que procura"  ng-keydown="$event.keyCode === 13 && getBusca(0,CampoBuscar)">    
					</inputfield>					
					<i class="fas fa-search right" style="line-height: 4;"></i>
				</div>
			</div>
			<table class="striped z-depth-1" ng-init="getBusca()" >
				<thead>
					<tr>										
						<th>
							<a href="" ng-click="ordernar('pergunta');" title="ordernar por pergunta">Pergunta</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'pergunta'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>	
						<th>
							respostas
						</th>																			
						<th><a href="" ng-click="ordernar('data_criacao');" title="ordernar por data_criacao">Criado em</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'data_criacao'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>												
						<th><a href="" ng-click="ordernar('status');" title="ordernar por status">Status</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'status'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>															
					</tr>
				</thead>
				<tbody class="grey-text lighten-4">
					<tr ng-repeat="v in lista.dados">						
						<th>
							<a class="modal-trigger" href="#lerEnquete" ng-click="lerEnquete(v);" ng-bind="v.pergunta" modal></a>
						</th>
						<th>
							<div ng-if="value.item!=''" ng-repeat="(key, value) in v.itens">
								<span ng-bind="value.item"></span>
								<span ng-bind="value.porcentagem"></span>
								<div class="progress">
									<div class="determinate" ng-style="{'width':value.porcentagem}" ></div>
								</div>
							</div>
						</th>
						<th ng-bind="v.data_criacao|toDate|date:'dd/MM/yy hh:mm'"></th>																
						<th ng-bind="enqueteStatus[v.status]"></th>
					</tr>
				</tbody>
			</table>
			<div class="row">
				<div class="col s3 m3 l3 xl3">
					<p class="left" style="line-height: 3;">Total de registros: <span ng-bind="lista.paginacao">						
					</span>
				</p>
			</div>
			<div class="col s9 m9 l9 xl9">
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
		<!-- Modal Structure -->
		<div id="lerEnquete" class="modal">
			<div class="modal-content">										
				<i class="far fa-times-circle fa-2x right modal-close"></i>								
				<?php $this->load->view('form_enquete'); ?>
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
		.modal{ max-height: 91% !important; }
		#lerEnquete{max-height: 91% !important; overflow-y: inherit !important;}
	</style>