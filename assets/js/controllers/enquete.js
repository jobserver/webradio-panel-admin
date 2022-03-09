app.controller('enquete',function($scope,$http,$sce,$window,$timeout,$location,$filter,$q)
{

$scope.lista =[];
$scope.enqueteStatus = ['','Ativo','Suspenso'];

	$scope.ordenacao = { 'campo':'data_criacao','direcao':'desc'};
	$scope.CampoBuscar = null;

	$scope.enqueteAtivo = {};
	$scope.form = {};

	$scope.ordernar =function(campo)
	{
		$scope.ordenacao.direcao = $scope.ordenacao.direcao =='asc'? 'desc' : 'asc';
		$scope.ordenacao.campo = campo;		

		$scope.getBusca(0,$scope.CampoBuscar);
	};

	$scope.lerEnquete = function(item)
	{
		$scope.form = angular.copy(item);	
		$scope.form.data_criacao = $filter('toDate')($scope.form.data_criacao);					
	};

	$scope.novaEnquete = function()
	{
		$scope.form = {};	
		$scope.form.itens = [{'item':'','valor':''},{'item':'','valor':''},{'item':'','valor':''},{'item':'','valor':''}];
	};


	$scope.getBusca = function(pagina=0,campoBusca='')
	{ 
		$('#modalProcessando').modal('open');
		$http({
			method:'POST',
			url:$scope.instalacao+'/admin/enquete/get/'+pagina,
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
			M.toast({html: 'Falha ao listar Enquetes. Verifiqe sua conexão ou tente mais tarde.',classes: 'red'});
		}
		);
	};


$scope.salvar=function()
{
	$('#modalProcessando').modal('open');
	var dados = angular.copy($scope.form);
	dados.radio_codigo = $scope.radioId;
	dados.itens = angular.toJson(dados.itens);

	$http.post($scope.instalacao+'/admin/enquete/salvar',dados)
	.then(
		response => {						
			$('#modalProcessando').modal('close');
			$('#lerEnquete').modal('close');
			M.toast({html: response.data.status.frase,classes: response.data.status.classe});		 
				$scope.getBusca();
		})
	.catch(error => {		
		$('#modalProcessando').modal('close');
		M.toast({html:'Erro ao salvar, tente mais tarde' ,classes: 'red'});
	})
	.finally(() => {$('#modalProcessando').modal('close'); } );
};

	$scope.excluir = function()
	{
		$('#modalProcessando').modal('open');	
		$http.post($scope.instalacao+'/admin/enquete/apagar',{'id':$scope.form.id}).
		then(
			function(response)
			{
				$('#modalProcessando').modal('close');			
				$('#lerEnquete').modal('close');
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

});