<?php error_reporting(E_ALL);
ini_set("display_errors", 1); ?>

<?php require_once '../autoload.php'; ?>


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
		
		
		<h1>Strona index</h1>

		<br><br>

		<h2><?php echo __('witaj', 'welcome') ?></h2>

		<?php 
			$head = 'przykładowy teskt w języku <strong>polskim</strong>';
			$head_en = 'przykładowy teskt w języku <strong>angielskim</strong>';
		?>

		<span><?php echo __($head, $head_en) ?></span><br>



		<?php 
			$msg = [
				'pl' => 'przykładowy teskt w języku <strong>polskim</strong>',
				'en' => 'przykładowy teskt w języku <strong>angielskim</strong>',
				'de' => 'przykładowy teskt w języku <strong>niemieckim</strong>',
			];
		?>

		<span><?php echo __($msg) ?></span><br>



		<?php 
		// $data = [
		// 	'nadawca_imie' => 'JA',
		// 	'odpowiedz' => 'kubusbbt@gmail.com',
		// 	'odpowiedz_imie' => 'juba',
		// 	'odbiorca' => 'jakub@brandwise.pl',
		// 	'odbiorca_imie' => 'kjhnkj',
		// 	'tytul' => 'kjhkjh',
		// 	'tresc' => 'witaj <b>Świecie</b>',
		// ];

		// $mail = New Mail;
		// $mail->smtp($data);
		 ?>
<br><br>


<?php 

$validate = new Validate;
// var_dump( $validate->pesel('87031604153', true) );

echo '<pre>';
print_r( $validate->pesel('87031604153', true) );
echo '</pre>';

echo '<pre>';
print_r( $validate->pesel('02271918666', true) );
echo '</pre>';

echo '<pre>';
var_dump( $validate->custom('04-218', '/^[0-9]{2}-[0-9]{3}$/') );
echo '</pre>';



$field = [
	'pesel' => $validate->pesel('87031604153'),
	'kod' => $validate->custom('04-218', '/^[0-9]{2}-[0-9]{3}$/')
];

var_dump( $validate->test($field) );

 ?>



<?php 
// data helpers
echo '<br>';

echo time_data_to_timestamp('10.02.2018');
echo '<br>';
echo time_data_to_timestamp('2018.02.10', 'Y.m.d');
echo '<br>';


echo time_format('10.02.2018', 'd.m.Y', 'Y.m.d');
echo '<br>';


echo time_add('10.02.2017', '+ 1 month');
echo '<br>';
echo time_add('2017.02.10', '+ 1 month', 'Y.m.d');
echo '<br>';
echo time_add('10.02.2017', '+ 1 month + 1 day');
echo '<br>';


echo time_difference('10.02.2017', '10.02.2013', '%y');






?>



		

	</body>
</html>