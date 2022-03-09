	<div class="card " ng-init="listarBruteForce()">
		<div class="card-content black-text">
			<span class="card-title"><i class="fas fa-bomb"></i> {{telas[telaAtiva].titulo}}</span>
			<div class="row">
				<div  class="col-md-6 col-sm-6 col-xs-12">
					<div class="x_panel">
						<div class="x_title">			
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table class="countries_list">
								<thead>
									<tr>
										<th>IP</th>
										<th>DATA</th>
										<th>HORÁRIO</th>
										<th>TENTATIVAS</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="(key, value) in bruteForce">
										<td>{{value.ip}}</td>							
										<td>{{value.data|date}}</td>							
										<td>{{value.horario}}</td>							
										<td>{{value.tentativas}}</td>							
										<td><button type="button" class="btn btn-danger btn-xs" ng-click="bruteForceRemover(value.ip)">Remover</button></td>					
									</tr>					
								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>