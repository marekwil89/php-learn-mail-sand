<?php 

session_start(); 
require_once '../autoload.php';

// Ścieżka do folderu ze stylami itp od formularza
$assets_dir = BASE_URL . 'auth/';





$auth = new Auth;

$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';


// wylogowywanie
if ( isset($_GET['logout']) )
{
	$auth->logout();
	exit( header('Location: ' . $redirect) );
}


// logowanie podczas przesłania formularza
$auth->login();


// sprawdzenie czy zalogowano
if ( $auth->is_logged() )
{
	header('Location: ' . $redirect);
}

?>



<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			body {
				padding-top: 0px;
				padding-bottom: 0px;

				background-image: url(<?php echo $assets_dir ?>img/bg.jpg);
			}
		</style>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<link rel="stylesheet" href="<?php echo $assets_dir ?>style/style.css">
	</head>
	<body>
	   
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 no-padding">
				   
					<form id="auth_form" method="POST" action="">
						<div class="form-inner">
							<h2>Logowanie</h2>
							<h3>Zaloguj się</h3>
							<div class="auth_form_form-group">
								<!-- <label for="auth_login">Login</label> -->
								<input type="text" class="auth_form_form-control" name="auth_login" id="auth_login" placeholder="login">
							</div>

							<div class="auth_form_form-group">
								<!-- <label for="auth_password">Hasło</label> -->
								<input type="password" class="auth_form_form-control" name="auth_password" id="auth_password" placeholder="hasło">
							</div>

							<div class="auth_form_form-group">
								<button type="submit" class="auth_form_btn"><span class="glyphicon glyphicon-log-in"></span>Zaloguj</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>


		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>       
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>
