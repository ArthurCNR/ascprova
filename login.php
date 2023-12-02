<? if(!defined("CONFIG")) exit(); ?>
<?php
require_once ("php/session_start.php");

if(isset($_SESSION['login'])) {
    header('Location: painel/inicio');
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Entrar - MyKart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">MyKart</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2>Bem vindo!</h2>
								<p>Não tem uma conta?</p>
								<a href="registro" class="btn btn-white btn-outline-white">Registrar-se</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Entrar</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
                            <form id="login-form" action="php/login_do.php" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="email">E-mail</label>
			      			<input type="email" id="email" name="email" class="form-control" placeholder="exemplo@exemplo.com" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="senha">Senha</label>
		              <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" id="submit" name="submit" class="form-control btn btn-primary submit px-3">Entrar</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Lembrar-me
									  <input type="checkbox" checked disabled>
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Recuperar Senha</a>
									</div>
		            </div>
		          </form>
                            <div class="login-form-response" id="resposta"></div>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

