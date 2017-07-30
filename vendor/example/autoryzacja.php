<?php session_start(); require_once '../autoload.php'; ?>

<?php error_reporting(E_ALL);
ini_set("display_errors", 1); ?>

<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>

		<!-- podniesienie klasy -->
		<?php $auth = new Auth; ?>
		
		<h1>Auth</h1>

		<?php 

		if( !$auth->is_logged() ) {
			$auth->login_form(); 
		}
		else {
			echo 'ZALOGOWANY';
		}

		?>

		<!-- funkcja sprawdzająca czy użytkownik jest zalogowany -->
		<?php //echo $auth->is_logged(); ?>


		<!-- funkcja służąca do wylogowania -->
		<?php $auth->logout(true); ?>


	</body>
</html>