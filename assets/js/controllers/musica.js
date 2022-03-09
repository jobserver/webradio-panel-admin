app.controller('musica',function($scope,$http,$sce,$window,$timeout,$location,$filter,$q)
{
	$scope.lista =[];

	$scope.ordenacao = { 'campo':'data_pedido','direcao':'desc'};
	$scope.CampoBuscar = null;

	$scope.pedidoAtivo = {};

	$scope.ordernar =function(campo)
	{
		$scope.ordenacao.direcao = $scope.ordenacao.direcao =='asc'? 'desc' : 'asc';
		$scope.ordenacao.campo = campo;		

		$scope.getBusca(0,$scope.CampoBuscar);
	};


	$scope.lerPedido = function(item)
	{
		$scope.pedidoAtivo = item;
		$scope.confirmarLeitura();
	};


	$scope.getBusca = function(pagina=0,campoBusca='')
	{ 
		$('#modalProcessando').modal('open');
		$http({
			method:'POST',
			url:$scope.instalacao+'/admin/musica/get/'+pagina,
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
			M.toast({html: 'Falha ao listar veículos. Verifiqe sua conexão ou tente mais tarde.',classes: 'red'});
		}
		);
	};


	$scope.confirmarLeitura=function()
	{		
		if ($scope.pedidoAtivo.status ==1) 
		{
			var elem = $scope.lista.dados.indexOf($scope.pedidoAtivo);
			$scope.lista.dados[elem].status =null;
			$http.post($scope.instalacao+'/admin/musica/confirmarLeitura',{'id':$scope.pedidoAtivo.id});	
			M.toast({html: 'Pedido Visualizado',classes: 'green'});
		}
	};


});