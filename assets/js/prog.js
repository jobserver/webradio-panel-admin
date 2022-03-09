var app = angular.module('app',['ngSanitize','ui.materialize','angular-fullcalendar']);
app.controller('aplicativo',function($templateRequest,$scope,$http,$sce,$window,$timeout,$location,$filter,$q)
{
	$scope.semana= ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','sexta-feira','Sábado'];
	$scope.instalacao='https://radios.jobserver.com.br/';
	$scope.api='https://radios.jobserver.com.br/appradio';
	$scope.radioId=2020;
	$scope.configRadio={};
	$scope.status = false;
	$scope.loading=false;
	$scope.rand = Math.floor(Math.random() * 65536);
	$scope.form = {} ;
	$scope.dashboard= {} ;
	$scope.noAr = [{'nome_programa':'Programação Livre','locutor':'','foto_locutor':$scope.configRadio.logoRadio}];

	// console.log('hoje é:'+$scope.hoje);

	$scope.telaAtiva =  $location.hash();

	$scope.$watch(function(){ return $location.hash()}, function (newVal, oldVal) 
	{
		if (oldVal == newVal) return;  
		if ($scope.telas[$location.hash()] !==undefined) 
		{    
			$scope.telaAtiva = $location.hash(); 	
		}
	}, true);


	$timeout(function()
	{
		$scope.$on('$includeContentRequested', function (event, url) {
			$('#modalProcessando').modal('open');
		});

		$scope.$on('$includeContentLoaded', function (event, url) {
			if ($scope.loading ==false) {      		
				$('#modalProcessando').modal('close');
			}
		});

	}, 3000);

	$scope.telas =
	{
		'':
		{'titulo':'DashBoard','icone':'fas fa-tachometer-alt',
		'template':$scope.instalacao+'/template/templateNavbar',
		'tela':$scope.instalacao+'/admin/home?t='+$scope.rand,
	}
	,
	'pedirMusica': 
	{'titulo':'Pedidos de Música','icone':'fas fa-music',
	'template':$scope.instalacao+'/template/templateSidebar',
	'tela':$scope.instalacao+'/admin/pedirMusica?t='+$scope.rand
}
,
'oracao': 
{'titulo':'Pedidos de Oração','icone':'fa fa-sign-language',
'template':$scope.instalacao+'/template/templateSidebar',
'tela':$scope.instalacao+'/admin/oracao?t='+$scope.rand
}
,
'programacao': 
{'titulo':'Programação','icone':'far fa-clock',
'template':$scope.instalacao+'/template/templateSidebar',
'tela':$scope.instalacao+'/admin/programacao?t='+$scope.rand
}
,
'configuracao': 
{'titulo':'Configuração','icone':'fas fa-tools',
'template':$scope.instalacao+'/template/templateSidebar',
'tela':$scope.instalacao+'/admin/configuracao?t='+$scope.rand
}
,
'enquete': 
{'titulo':'Enquete','icone':'fas fa-poll',
'template':$scope.instalacao+'/template/templateSidebar',
'tela':$scope.instalacao+'/admin/enquete?t='+$scope.rand
}
,
'banner': 
{'titulo':'Banner','icone':'fas fa-poll',
'template':$scope.instalacao+'/template/templateSidebar',
'tela':$scope.instalacao+'/admin/banner?t='+$scope.rand
}

};

$scope.getConfigRadio=function()
{
	return $q(function(resolve, reject) {	
		$http.get($scope.instalacao+'/admin/getRadio')
		.then(
			response => {
				// console.log(response);
				if (response.data.hash !=='') 
				{
					// document.getElementById("radio").src=response.data.dados.stream1;										
					$scope.configRadio = response.data.dados;
					// $scope.getProgramacao();
					resolve('rádio carregada');
				}

			})
		.catch(error => {
			reject(error);
			console.log(error);
		})
		.finally(() => $scope.loading=false );

	});
};

$scope.getDashBoard=function()
{
	return $q(function(resolve, reject) {
		$http.post($scope.instalacao+'admin/dashboard',{'hash':	$scope.dashboard.hash})
		.then(
			response => {
				if (response.data.hash !==undefined) 
				{									
					$scope.configRadio.dashboard = response.data.dados;	
					$scope.dashboard.hash = response.data.hash;	

					// console.log($scope.configRadio.dashboard);
					resolve('Dashboard carregada');
				}

			})
		.catch(error => {
			console.log(error);
			reject(error);
		})
		.finally(() => $scope.loading=false );
	});
};

$scope.videoForm = {};
$scope.salvarVideoAovivo=function()
{
	$('#modalProcessando').modal('open');
	var dados = angular.copy($scope.videoForm);

	$http.post($scope.instalacao+'/admin/salvarVideoAoVivo',dados)
	.then(
		response => 
		{
			$('#modalProcessando').modal('close');
			$scope.videoForm = {};
			M.toast({html: response.data.status.frase,classes: response.data.status.classe});		 

		})
	.catch(error => {
		$('#modalProcessando').modal('close');
			M.toast({html: response.data.status.frase,classes: response.data.status.classe});		 
		console.log(error);
	})
	.finally(() => $scope.loading=false );

};


//Inicialização da aplicação///////////////////////////////
$scope.getConfigRadio().then(r =>{	
	$scope.getDashBoard();
}
);

$scope.reloadDados = function(){

 $scope.getDashBoard();	
$timeout( $scope.reloadDados, 10000);
};

 $timeout( $scope.reloadDados, 5000);

})
.config(function ($sceDelegateProvider) {
	$sceDelegateProvider.resourceUrlWhitelist([
        'self',                    // trust all resources from the same origin
        '*://www.youtube.com/**',   
        'https://www.youtube.com/embed/**',
        '*://www.facebook.com/**',   
        '*://plus.google.com/**',   
        'whatsapp://**' ,  
        'javascript:**'   

        ]);
})
.filter('pad', function() {
	return function(num) {
    return (num < 10 ? '0' + num : num); // coloca o zero na frente
   };
  })
.filter('toDate', function() {
	return function(num) {
		if (num) 
		{		
			if (num.length==10) 
			{			
				return new Date(num+'T03:00:00');
			}
			else {
				return new Date(num);
			};
		}
	}
})
.filter('toTime', function() {
	return function(num) {
		if (num) {    
			var data = new Date();
			return new Date(	data.getFullYear()+'-'+$filter('pad')(	data.getMonth()+1)+'-'+$filter('pad')(	data.getDate())+'T'+num);
		}
	}
});