<?php $this->load->view('template_cabecalho.php'); ?>
	<div id="main">
		<ul class="sidenav sidenav-fixed noprint" id="slide-out" sidenav data-direcao="left" collapsible>
			<!-- 	<li><a class="subheader">Always out except</a></li> -->
			<li>
				<a href="#"  class="collapsible-header waves-effect waves-teal sidenav-close" tabindex="0"><i class="fas fa-tachometer-alt"></i> DashBoard</a><div class="collapsible-body"></div>
			</li>
			<li><a href="#banner"  class="collapsible-header waves-effect waves-teal sidenav-close" tabindex="0"><i class="fas fa-city fa-lg	"></i> Banners</a>
				<div class="collapsible-body"></div>
			</li>
			<li><a href="#pedirMusica"  class="collapsible-header waves-effect waves-teal sidenav-close" tabindex="0"><i class="fas fa-music  fa-lg	"></i> Pedidos de música</a><div class="collapsible-body"></div>
			</li>
			<li><a href="#oracao"  class="collapsible-header waves-effect waves-teal sidenav-close" tabindex="0"><i class="fa fa-sign-language  fa-lg"></i> Pedidos de oração</a><div class="collapsible-body"></div></li>
			<li><a href="#programacao"  class="collapsible-header waves-effect waves-teal sidenav-close" tabindex="0"><i class="far fa-clock"></i>Programação</a><div class="collapsible-body"></div></li>
			<li><a href="#enquete"  class="collapsible-header waves-effect waves-teal sidenav-close" tabindex="0"><i class="fas fa-poll"></i> Enquete</a><div class="collapsible-body"></div></li>
			<li>
				<a href="#configuracao" class="collapsible-header waves-effect waves-teal sidenav-close" tabindex="0"><i class="fas fa-tools"></i> Configurações</a>				
			</li>
			<!-- <li>
				<a class="collapsible-header waves-effect waves-teal" tabindex="0"><i class="fas fa-chart-bar"></i> Relatórios <i style="font-size: 15px !important;" class="fas fa-angle-down  right"></i></a>
				<div class="collapsible-body">
					<ul>
						<li><a class="sidenav-close" href="#relatorio_reservas" >Reservas</a></li>
						<li><a class="sidenav-close" href="#relatorio_ocorrencias" >Ocorrências</a></li>
						<li><a class="sidenav-close" href="#relatorio_pessoas" >Acesso ao condomínio</a></li>
						<li><a class="sidenav-close" href="#relatorio_historico" >Histórico de ações</a></li>						
					</ul>
				</div>
			</li> -->
			
		</ul>
		<div class="col s12 m12 l12" style="padding:10px 20px 0px 20px;">		
			<h5 style="margin-bottom: 20px;"><i class="{{telas[telaAtiva].icone}}"></i> {{telas[telaAtiva].titulo}}</h5>
			<div class="card" ng-init="getEmpresa()">
				<div class="card-content black-text">	
				<!-- carrega as telas internas	 -->
					<div ng-include="telas[telaAtiva].tela"></div>					
				</div>
			</div>
		</div>
	</div>