		<div ng-controller="programacao">
			<div class="row">	

				<div class="col s4 m4 l4">							
					<button type="button" class="waves-effect waves-light btn-small" href="#modalPrograma" ng-click="novoPrograma();" modal>Novo Programa</button>
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
							<a href="" ng-click="ordernar('nome_programa');" title="ordernar por programa">Programa</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'nome_programa'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>
						<th><a href="" ng-click="ordernar('locutor');" title="ordernar por locutor">Locutor</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'locutor'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>										
						<th class="hide-on-small-only">whatsapp</th>														
						<th class="hide-on-small-only">Horários</th>																				
						<th class="hide-on-small-only">
							<a href="" ng-click="ordernar('data_inicio');" title="ordernar por data_inicio">Data de Início</a>
							<span class="sortorder" ng-show="ordenacao.campo === 'data_inicio'" ng-class="{reverse: ordenacao.direcao=='desc'}"></span>
						</th>																				
					</tr>
				</thead>

				<tbody class="grey-text lighten-4">
					<tr ng-repeat="v in lista.dados">																												
						<th><a class="modal-trigger" href="#modalPrograma" ng-click="lerPrograma(v);" ng-bind="v.nome_programa" modal></a></th>					
						<th class="valign-wrapper"><img ng-src="{{(v.foto_locutor)? instalacao+'/uploads/'+configRadio.codigo+'/'+v.foto_locutor : instalacao+'assets/image/avatar.png'}}" height="60" width="60" style="object-fit: cover;" alt="imagem locutor aqui" class="circle"> <span ng-bind="v.locutor" style="margin-left: 10px;"></span></th>						
						<th class="hide-on-small-only" ng-bind="v.whatsapp"></th>
						<th class="hide-on-small-only">
							<button type="button" class="waves-effect waves-light btn-small" ng-click="horario(v)">Cadastrar horário</button>
							<div ng-repeat="hor in v.horarios">
								<p ng-bind="semana[hor.dia_semana]"></p>
								<a href="" ng-click="editarHorario(hor,v)">
									<b ng-bind="(hor.hora_inicio|limitTo:5)+' até'"></b>  
									<b ng-bind="hor.hora_fim|limitTo:5"></b>
								</a>
							</div>					
						</th>
						<th class="hide-on-small-only" ng-bind="v.data_inicio |toDate|date:'dd/MM/yy':'+0300'"></th>
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
			

			<!-- Modal Structure -->
			<div id="modalHorario" class="modal">
				<div class="modal-content">										
					<i class="far fa-times-circle fa-2x right modal-close"></i>										
					<?php $this->load->view('form_gradeProgramacao'); ?>
				</div>
			</div>

			<!-- Modal Structure -->
			<div id="modalPrograma" class="modal">
				<div class="modal-content">										
					<i class="far fa-times-circle fa-2x right modal-close"></i>										
					<?php $this->load->view('form_programacao'); ?>
				</div>
			</div>
			
		</div>


		<style scoped>
			.modal{ max-height: 91% !important; }
			#modalHorario{max-height: 91% !important; overflow-y: inherit;}
			.sortorder:after {
				content: '\25b2';   // BLACK UP-POINTING TRIANGLE
			}
			.sortorder.reverse:after {
				content: '\25bc';   // BLACK DOWN-POINTING TRIANGLE
			}
		</style>