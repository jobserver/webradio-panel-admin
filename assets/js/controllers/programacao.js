app.controller('programacao',function($scope,$http,$sce,$window,$timeout,$location,$filter,$q)
{
	$scope.lista =[];
	$scope.ordenacao = { 'campo':'data_inicio','direcao':'desc'};
	$scope.CampoBuscar = null;

	$scope.form = {};
	$scope.formHorario = {};
	$scope.progEdit = {};

	$scope.ordernar =function(campo)
	{
		$scope.ordenacao.direcao = $scope.ordenacao.direcao =='asc'? 'desc' : 'asc';
		$scope.ordenacao.campo = campo;		
		$scope.getBusca(0,$scope.CampoBuscar);
	};

	$scope.lerPrograma = function(item)
	{
		item.data_inicio = $filter('toDate')(item.data_inicio);
		item.data_fim = $filter('toDate')(item.data_fim);		
		$scope.form = item;		
	};
	$scope.novoPrograma = function()
	{
		$scope.form = {'radio_codigo':$scope.radioId};		
	};

	$scope.horario = function(programa)
	{
		$('#modalHorario').modal('open');
		$scope.progEdit = programa;
		$scope.formHorario = {'radio_codigo':$scope.radioId,'programacao_id':programa.id};		
	};
	$scope.editarHorario = function(programa,dp)
	{
		$scope.progEdit = dp;
		$scope.formHorario = angular.copy(programa);		
		$scope.formHorario.hora_inicio = new Date('2020-06-01T'+$scope.formHorario.hora_inicio);		
		$scope.formHorario.hora_fim = new Date('2020-06-01T'+$scope.formHorario.hora_fim);	
		$('#modalHorario').modal('open');
	};

	$scope.excluirPrograma = function()
	{
		$('#modalProcessando').modal('open');	
		$http.post($scope.instalacao+'admin/programacao/apagar',{'id':$scope.form.id}).
		then(
			function(response)
			{
				$('#modalProcessando').modal('close');			
				$('#modalPrograma').modal('close');
				M.toast({html: response.data.status.frase,classes: response.data.status.classe});		  
				$scope.getBusca();
			},
			function(response)
			{  
				$('#modalProcessando').modal('close');
				M.toast({html: 'Falha ao excluir. Verifiqe sua conexão ou tente mais tarde.',classes: 'red'});
			}
			);
	};

	$scope.excluirHorario = function()
	{
		$('#modalProcessando').modal('open');	
		$http.post($scope.instalacao+'admin/gradeProgramacao/apagar',{'id':$scope.formHorario.id}).
		then(
			function(response)
			{
				$('#modalProcessando').modal('close');			
				$('#modalHorario').modal('close');
				M.toast({html: response.data.status.frase,classes: response.data.status.classe});		  
				$scope.getBusca();
			},
			function(response)
			{  
				$('#modalProcessando').modal('close');
				M.toast({html: 'Falha ao excluir. Verifiqe sua conexão ou tente mais tarde.',classes: 'red'});
			}
			);
	};

	$scope.getBusca = function(pagina=0,campoBusca='')
	{ 
		$('#modalProcessando').modal('open');
		$http({
			method:'POST',
			url:$scope.instalacao+'admin/programacao/get/'+pagina,
			data:{'filtro':campoBusca,'ordenacao':$scope.ordenacao},
			headers:{
				'Content-Type'  : 'application/x-www-form-urlencoded',
				'Cache-Control' : 'no-cache'
			},
			timeout:30000
		}).then(
		function(response)
		{
			$scope.lista = response.data;
			$('#modalProcessando').modal('close');
			$('#CampoBuscar').focus();
		},
		function(response)
		{  
			$('#modalProcessando').modal('close');
			M.toast({html: 'Falha ao carregar dados. Verifiqe sua conexão ou tente mais tarde.',classes: 'red'});
		}
		);
	};

	/////////////////CALENDÁRIO///////////////////////////////////
	$scope.events = [];
	$scope.getProgramacao = function()
	{
		$http({
			method:'GET',
			url:$scope.instalacao+'admin/programacao/grade',
			headers:{'Cache-Control': 'no-cache'}
		}).then(
		function(response)
		{
			$scope.calendarOptions = {
				
				defaultView: "agendaWeek",
				height: 500,
				nowIndicator: true,
				locale: "pt-br",
				timeFormat: 'H(:mm)',				
				header: {
					right: "prev,next",
					center: "title",
 // left: "month,agendaWeek,agendaDay,listWeek"
 left: "agendaWeek,listWeek,agendaDay"
 // right: "month,listWeek"
}

};
$scope.events = (response.data);

$('#calendario').fullCalendar('rerenderEvents');	


});
	};
	$scope.getProgramacao();


	$scope.salvarHorario=function()
	{
		$('#modalProcessando').modal('open');
		var dados = angular.copy($scope.formHorario);
		dados.hora_inicio = $filter('date')(dados.hora_inicio,'HH:mm:ss','UTC-3h');
		dados.hora_fim = $filter('date')(dados.hora_fim,'HH:mm:ss','UTC-3h');
		$http.post($scope.instalacao+'admin/gradeProgramacao/salvar',dados)
		.then(
			response => {						
				$('#modalProcessando').modal('close');
				$('#modalHorario').modal('close');
				M.toast({html: response.data.status.frase,classes: response.data.status.classe});		  
				$scope.getBusca();
			})
		.catch(error => {		
			$('#modalProcessando').modal('close');
			M.toast({html:'Erro ao salvar, tente mais tarde' ,classes: 'red'});
		})
		.finally(() => {$('#modalProcessando').modal('close'); } );
	};


	$scope.salvar=function()
	{

		// configura os dados que serão enviados;

		var fd = new FormData();
		var files = document.getElementById('foto_locutor').files[0];
		fd.append('foto_locutor',files);
		var fotoPrograma = document.getElementById('foto_programa').files[0];
		fd.append('foto_locutor',files);
		fd.append('foto_programa',fotoPrograma);
		fd.append('dados', angular.toJson($scope.form));

		$('#modalProcessando').modal('open');

		$http({
			method:'POST',
			url:$scope.instalacao+'admin/programacao/salvar',
			data:fd,
			transformRequest:angular.identity,
			headers: {'Content-Type': undefined}
		}).then(
		response => {						
			$('#modalProcessando').modal('close');
			M.toast({html: response.data.status.frase,classes: response.data.status.classe});		  
			$scope.getBusca();
			$('#modalPrograma').modal('close');
		})
		.catch(error => {		
			$('#modalProcessando').modal('close');
			M.toast({html:'Erro ao salvar, tente mais tarde' ,classes: 'red'});
		})
		.finally(() => {$('#modalProcessando').modal('close'); } );
	};



});