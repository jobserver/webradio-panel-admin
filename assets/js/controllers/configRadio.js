app.controller('configRadio',function($scope,$http,$sce,$window,$timeout,$location,$filter,$q)
{

	$scope.editar=function()
	{			
			$('#modalProcessando').modal('open');
		return $q(function(resolve, reject) {	
			$http.get($scope.instalacao+'/admin/radio/editar/')
			.then(
				response => {				
					$scope.form =response.data;
					$('#modalProcessando').modal('close');
					resolve(true);				
			})
			.catch(error => {
				$('#modalProcessando').modal('close');
				reject(error);				
			})
			.finally(() => {$('#modalProcessando').modal('close');} );

		});
	};


$scope.salvar=function()
{
	$('#modalProcessando').modal('open');
	$http.post($scope.instalacao+'/admin/radio/salvar',angular.copy($scope.form))
	.then(
		response => {						
			$('#modalProcessando').modal('close');
			M.toast({html: response.data.status.frase,classes: response.data.status.classe});		  
		})
	.catch(error => {		
		$('#modalProcessando').modal('close');
		M.toast({html:'Erro ao salvar, tente mais tarde' ,classes: 'red'});
	})
	.finally(() => {$('#modalProcessando').modal('close'); } );
};


});