<?php 

class Auth
{
	private $form_url;

	function __construct( $form_url = auth_default_login_file )
	{
		$this->form_url = $form_url;
	}


	public function is_logged()
	{
		if( isset($_SESSION['logged']) && $_SESSION['logged'] == 1 ){
			return true;
		}
		else{
			return false;
		}
	}


	public function login_form($redirect = auth_default_redirect, $form_file = auth_default_login_file)
	{
		echo('<script>location.href = "' . $form_file . '?redirect=' . $redirect . '"</script>');
	}


	public function login()
	{
		$login = isset($_POST['auth_login']) ? trim($_POST['auth_login']) : '';
		$pass = isset($_POST['auth_password']) ? trim($_POST['auth_password']) : '';

		// Sprawdzenie czy podano login i hasło
		if ( $_POST && !empty($login) && !empty($pass) )
		{
			// Sprawdzenie czy podano poprawny login i hasło 
			if ( $login == User_login && md5($pass) === User_password)
			{
				$_SESSION['logged'] = true;
			}else{
				$_SESSION['logged'] = false;
			}
		}
	}


	public function logout($btn = false, $redirect = auth_default_redirect, $element_class = '')
	{
		if( $redirect == false ){
			$redirect = auth_default_redirect;
		}

		if( $element_class != '' ){
			$element_class = 'class="' . $element_class . '"';
		}

		if( $btn == false )
		{
			@session_start();
			session_unset(); 
			session_destroy(); 
		}
		else{
			echo '<a ' . $element_class . ' href="'. $this->form_url .'?logout&redirect='. $redirect .'">Wyloguj</a>';
		}

	}

}