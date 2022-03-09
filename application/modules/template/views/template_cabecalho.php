<div class="navbar-fixed noprint">
	<nav>
		<div class="nav-wrapper blue-grey darken-4">
			<a href="<?=base_url(); ?>" class="brand-logo"><h5 class="truncate" ng-bind="configRadio.nome_radio"></h5>
			</a>
			<a data-target="slide-out" ng-if="telaAtiva!=''" class="sidenav-trigger"><i class="fas fa-bars"></i></a>
			<ul class="right">
					<!-- <li><a href="#"><i class="material-icons">search</i></a></li>
					<li><a href="#"><i class="material-icons">view_module</i></a></li>
					<li><a href="#"><i class="material-icons">refresh</i></a></li> -->
					<li><a ng-href="{{urlServidor+'admin/login/logout'}}" title="Sair do sistema"><i class="fas fa-sign-out-alt"></i></a></li>
				</ul>
			</div>
		</nav>
	</div>