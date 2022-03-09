<?php $this->load->view('template_cabecalho.php'); ?>
<div id="main">		
	<div class="col s12 m12 l12" style="padding:10px 0px 0px 10px;">		
		<h5 style="margin-bottom: 20px;"><i class="{{telas[telaAtiva].icone}}"></i> {{telas[telaAtiva].titulo}}</h5>
		<div class="card" ng-init="getEmpresa()">
			<div class="card-content black-text">	
				<!-- carrega as telas internas	 -->
				<div ng-include="telas[telaAtiva].tela"></div>					
			</div>
		</div>
	</div>
</div>
<style scoped>
	#main {    
		padding-left: 0px;
	}
</style>