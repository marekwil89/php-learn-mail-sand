<?php


define('BASE_URL', '/helpers/');


/***************************/
/******** DATABASE  ********/
/***************************/

/** Nazwa bazy danych */
define('DB_NAME', 'rower');

/** Nazwa użytkownika bazy danych MySQL */
define('DB_USER', 'root');

/** Hasło użytkownika bazy danych MySQL */
define('DB_PASSWORD', '');

/** Nazwa hosta serwera MySQL */
define('DB_HOST', 'localhost');

/** Kodowanie bazy danych. */
define('DB_CHARSET', 'utf8mb4');



/***************************/
/******** PHPMailer  *******/
/***************************/

/** jeżeli trap = true - maile są wysyłane przez smtp mailtrap */
$trap = false;

/** 
* 0 = off (for production use)
* 1 = client messages
* 2 = client and server messages
*/
define('Mail_SMTPDebug', 0);


if ($trap != true)
{
	/** Host poczty SMTP */
	define('Mail_Host', '');

	/** Port poczty SMTP */
	define('Mail_Port', '');

	/** Nazwa użytkownika poczty SMTP */
	define('Mail_Username', '');

	/** Hasło użytkownika poczty SMTP */
	define('Mail_Password', '');
}
else{
	/** Host poczty SMTP */
	define('Mail_Host', 'mailtrap.io');

	/** Port poczty SMTP */
	define('Mail_Port', '465');

	/** Nazwa użytkownika poczty SMTP */
	define('Mail_Username', '4a079ef142aa27');

	/** Hasło użytkownika poczty SMTP */
	define('Mail_Password', '2331de45467925');
}




/***************************/
/******** LOGOWANIE  *******/
/***************************/


define('User_login', 'test');
define('User_password', '202cb962ac59075b964b07152d234b70'); //md5 = 123

/** defaultowe przekierowanie po wylogowaniu */
define('auth_default_redirect', 'index.php');

/** defaultowe przekierowanie plik główny */
define('auth_default_login_file', 'login.php');