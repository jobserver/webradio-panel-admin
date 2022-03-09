<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="/css/icon.css" rel="stylesheet">
	<link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<script src="/js/materialize.js"></script>
</head>
<body>

	<div class="" style="margin-top: 50px;">
		<div class="row " >
			<form method="POST" action="/sindico/login/post" class="col s12 m6 l4  offset-m3 offset-l3 offset-xl4">
				<div class="card-panel white ">
					<div class="row">
						<div class="col s12 m12 l12 center">    
							<img src="/img/logo-condominio.png" width="120" >
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">account_circle</i>
							<input id="icon_prefix" type="text" name="login" class="validate">
							<label class="active" for="icon_prefix">Usuário</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">lock</i>
							<input id="icon_telephone" type="password" name="senha" class="validate">
							<label class="active" for="icon_telephone">Senha</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<inputfield>
								<label class="right">         
									<input type="checkbox" ng-model="formAut.memorizar"  value="1">
									<span>Salvar dados de acesso</span>
								</label>
							</inputfield>
						</div>
					</div>
					<button type="submit" class="btn btn-large btn-block waves-effect waves-light"><i class="mdi-content-send right"></i>
					Entrar</button>
				</div>
			</form>

		</div>
	</div>
	<style>
		body { background:#CBD3D0;}
		.btn-block{width: 100%;}
	</style>
</body>
</html>