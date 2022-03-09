<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="<?=base_url('assets/css/materialize.css'); ?>" type="text/css" rel="stylesheet" />
	<link href="<?=base_url('assets/css/estilo.css'); ?>" type="text/css" rel="stylesheet" />

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>

	<div class="" style="margin-top: 50px;">
		<div class="row " >
			<form method="POST" action="<?=base_url('/admin/login/post');?>" class="col s12 m6 l4  offset-m3 offset-l3 offset-xl4">
				<div class="card-panel white ">
					<div class="row">
						<div class="input-field col s12">
							<i class="fas fa-user-circle prefix"></i>
							<input id="icon_prefix" type="text" name="login" class="validate">
							<label class="active" for="icon_prefix">Usuário</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<i class="fas fa-key prefix"></i>
							<input id="icon_telephone" type="password" name="senha" class="validate">
							<label class="active" for="icon_telephone">Senha</label>
						</div>
					</div>

					<button type="submit" class="btn btn-large btn-block purple waves-effect waves-light">
						<i class="fas fa-sign-in-alt"></i>
					Entrar</button>
				</div>
			</form>

		</div>
	</div>
	<style>
		body { background:#CBD3D0 url('<?=base_url('assets/image/login-background.jpg'); ?>') ;}
		.btn-block{width: 100%;}
		.fas {
vertical-align: top;
}
	</style>
</body>
</html>