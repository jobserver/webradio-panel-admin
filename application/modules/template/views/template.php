<!DOCTYPE html>
<html lang="pt-br" ng-app="app" ng-controller="aplicativo">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
	<title>Sistema rádio - modificar nome da rádio</title>
	<!-- CSS  -->
	<!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
	<link href="<?=base_url('assets/css/materialize.css'); ?>" type="text/css" rel="stylesheet" />
	<link href="<?=base_url('assets/css/estilo.css'); ?>" type="text/css" rel="stylesheet" />
	<!-- <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->
	<!-- <link rel="stylesheet" href="css/fonts/fa/css/font-awesome.css"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body onclose="logout();">
  <!-- Modal Structure -->
  <div id="modalProcessando" class="modal" modal>
    <div class="modal-content center">

     <div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue">
       <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>

    <div class="spinner-layer spinner-red">
     <div class="circle-clipper left">
      <div class="circle"></div>
    </div><div class="gap-patch">
      <div class="circle"></div>
    </div><div class="circle-clipper right">
      <div class="circle"></div>
    </div>
  </div>

  <div class="spinner-layer spinner-yellow">
   <div class="circle-clipper left">
    <div class="circle"></div>
  </div><div class="gap-patch">
    <div class="circle"></div>
  </div><div class="circle-clipper right">
    <div class="circle"></div>
  </div>
</div>

<div class="spinner-layer spinner-green">
 <div class="circle-clipper left">
  <div class="circle"></div>
</div><div class="gap-patch">
  <div class="circle"></div>
</div><div class="circle-clipper right">
  <div class="circle"></div>
</div>
</div>
</div>
<p>Aguarde um momento</p>
</div>
</div>


<div class="container-fluid" ng-include="telas[telaAtiva].template"></div>
<style scoped>
	#modalProcessando{
		width: 200px !important;
	}
</style>

<!--  Scripts-->		
<script src="<?=base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>		 		
<!-- Configuração Angular -->
<script src="<?=base_url('assets/js/materialize.js'); ?>"></script>	
<script src="<?=base_url('assets/js/angular-1-7-9.min.js'); ?>"></script>
<script src="<?=base_url('assets/js/angular-locale_pt-br.js'); ?>"></script>
<script src="<?=base_url('assets/js/angular-sanitize.min.js'); ?>"></script>
<script src="<?=base_url('assets/js/jobsMaterialize.js'); ?>"></script>	
<script src="<?=base_url('assets/js/prog.js?v=1'); ?>"></script>
<script src="<?=base_url('assets/js/controllers/configRadio.js'); ?>"></script>
<script src="<?=base_url('assets/js/controllers/oracao.js'); ?>"></script>
<script src="<?=base_url('assets/js/controllers/musica.js'); ?>"></script>
<script src="<?=base_url('assets/js/controllers/programacao.js'); ?>"></script>
<script src="<?=base_url('assets/js/controllers/enquete.js'); ?>"></script>
<script src="<?=base_url('assets/js/controllers/banner.js'); ?>"></script>
<!-- <script src="/js/diretivas/ngUploadFileSindicoDirective.js"></script> -->
<!-- calendário -->
<link rel="stylesheet" href="<?=base_url('assets/calendario/fullcalendar-v3.6.1.css');?>">

<script src="<?=base_url('assets/calendario/moment.min.js');?>"></script>
<!-- <script src="calendario/fullcalendar.min.js?v=1.1"></script> -->
<script src="<?=base_url('assets/calendario/fullcalendar-v3.6.1.js?v=1.1');?>"></script>
<script src="<?=base_url('assets/calendario/pt-br.js?v=1.1');?>"></script>
<script src="<?=base_url('assets/calendario/angular-fullcalendar.js');?>"></script>
</body>
</html>